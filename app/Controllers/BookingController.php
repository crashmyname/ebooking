<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Schedule;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use setasign\Fpdi\Fpdi;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\DB;
use Support\Request;
use Support\Response;
use Support\Session;
use Support\UUID;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class BookingController extends BaseController
{
    // Controller logic here
    public function getBooking(Request $request)
    {
        if (Request::isAjax()) {
            if($request->tanggal){
                $booking = Booking::query()
                ->select('booking_id','booking.uuid','lapangan.jenis','users.name','booking_date','schedule.start_time','schedule.end_time','schedule.session','status.status','booking.description','schedule.day','users.users_id')
                ->leftJoin('lapangan','lapangan.lapangan_id','=','booking.lapangan_id')
                ->leftJoin('schedule','schedule.schedule_id','=','booking.schedule_id')
                ->leftJoin('users','users.users_id','=','booking.users_id')
                ->leftJoin('status','status.status_id','=','booking.status_id')
                ->where('booking_date','=',$request->tanggal)
                ->get();
                return DataTables::of($booking)->make(true);
            } else {
                return DataTables::of([])->make(true);
            }
        }
    }

    public function getScheduleData(Request $request)
    {
        $getday = Date::DayName($request->booking_date);
        $schedule = Schedule::query()->where('lapangan_id','=',$request->lapangan_id)->where('day','=',$getday)->get();
        $ceksch = DB::query('
                        SELECT schedule.schedule_id, schedule.day, schedule.start_time, schedule.end_time, 
                            booking.booking_id, schedule.lapangan_id, booking.booking_date, schedule.session,
                            CASE 
                                WHEN booking.schedule_id IS NOT NULL THEN TRUE 
                                ELSE FALSE 
                            END AS is_booked
                        FROM schedule
                        LEFT JOIN booking ON schedule.schedule_id = booking.schedule_id AND booking.booking_date = :booking_date
                        WHERE schedule.lapangan_id = :lapangan_id AND schedule.day = :day

                        UNION

                        SELECT schedule.schedule_id, schedule.day, schedule.start_time, schedule.end_time, 
                            booking.booking_id, schedule.lapangan_id, booking.booking_date, schedule.session,
                            CASE 
                                WHEN booking.schedule_id IS NOT NULL THEN TRUE 
                                ELSE FALSE 
                            END AS is_booked
                        FROM schedule
                        RIGHT JOIN booking ON schedule.schedule_id = booking.schedule_id AND booking.booking_date = :booking_date
                        WHERE schedule.lapangan_id = :lapangan_id AND schedule.day = :day
                    ', [
                        'lapangan_id' => $request->lapangan_id,
                        'day' => $getday,
                        'booking_date' => $request->booking_date
                    ])->fetchAll();
        return Response::json($ceksch);
    }

    public function getDay(Request $request)
    {
        $getday = Date::DayName($request->booking_date);
        $lapangan = Schedule::query()->distinct()->select('lapangan.lapangan_id', 'lapangan.jenis', 'MIN(schedule.start_time) AS start_time')->leftJoin('lapangan','lapangan.lapangan_id','=','schedule.lapangan_id')->where('schedule.day','=',$getday)->groupBy('lapangan.lapangan_id')->get();
        return Response::json($lapangan);
    }

    public function index(Request $request)
    {
        $lapangan = Lapangan::all();
        $schedule = Schedule::all();
        return view('booking/booking',['title' => 'booking','lapangan'=>$lapangan,'schedule'=>$schedule],'layout/app');
    }

    public function create(Request $request)
    {
        $cekbooking = Booking::query()->where('lapangan_id','=',$request->lapangan_id)->where('schedule_id','=',$request->schedule_id)->where('booking_date','=',$request->booking_date)->first();
        if($cekbooking){
            return Response::json(['status'=>500,'message'=>'Lapangan sudah di booking']);
        }
        // Validasi jika pengguna sudah booking pada lapangan yang sama, tapi di sesi berbeda
        $cekUserBooking = Booking::query()
        ->where('lapangan_id', '=', $request->lapangan_id)
        ->where('booking_date', '=', $request->booking_date)
        ->where('users_id', '=', Session::user()->users_id)
        ->first();

        if ($cekUserBooking) {
            return Response::json(['status' => 500, 'message' => 'Anda sudah melakukan booking lapangan yang sama di sesi lain']);
        }
        $bookingdate = $request->booking_date;
        if(Date::isValidDateRange($bookingdate,14,30)){
            DB::beginTransaction();
            try{
                $booking = Booking::create([
                    'uuid' => UUID::generateUuid(),
                    'users_id' => Session::user()->users_id,
                    'lapangan_id' => $request->lapangan_id,
                    'booking_date' => $request->booking_date,
                    'schedule_id' => $request->schedule_id,
                    'description' => $request->description,
                    'status_id' => 2,
                    'created_at' => Date::Now(),
                    'updated_at' => Date::Now(),
                ]);
                DB::commit();
                if($booking){
                    return Response::json(['status'=>201,'message'=>'Booking berhasil']);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return Response::json(['status'=>500,'message'=>$e->getMessage()]);
            }
        } else {
            return Response::json(['status'=>400,'message'=>'Tanggal yang dipilih tidak boleh lebih dari 14 hari']);
        }
    }

    public function update(Request $request,$id)
    {
        $booking = Booking::query()->where('lapangan_id',$id)->first();
        $booking->nama_lapangan = $request->nama_lapangan;
        $booking->harga = $request->harga;
        $booking->updated_at = Date::Now();
        $booking->save();
        if($booking){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil diupdate']);
        }
    }

    public function delete(Request $request,$id,$uid)
    {
        // $booking = Booking::query()->where('uuid','=',$id)->where('users_id','=',$uid)->first();
        $booking = Booking::query()->where('uuid','=',$id)->first();
        if(Session::user()->role_id != 1){
            if($booking->users_id != Session::user()->users_id){
                return Response::json(['status'=>400,'message'=>'Hanya bisa menghapus booking milik sendiri']);
            }
        }
        $booking->delete();
        if($booking){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil dihapus']);
        }
    }

    public function getcalenderData(Request $request)
    {
        // var_dump($request);
        $booking = Booking::query()->leftJoin('schedule','schedule.schedule_id','=','booking.schedule_id')->leftJoin('lapangan','lapangan.lapangan_id','=','booking.lapangan_id')->whereMonth('booking_date',$request->month)->whereYear('booking_date',$request->year)->get();
        // vd($booking);
        return Response::json(['status'=>200,'data'=>$booking]);
    }

    public function generateCard(Request $request, $id)
    {
        $booking = Booking::query()->select('booking.uuid','users.username','users.name','users.section','users.singkatan','lapangan.jenis','schedule.session','schedule.start_time','schedule.end_time')->leftJoin('users','users.users_id','=','booking.users_id')->leftJoin('lapangan','lapangan.lapangan_id','=','booking.lapangan_id')->leftJoin('schedule','schedule.schedule_id','=','booking.schedule_id')->where('booking.uuid','=',$id)->first();
        // vd($booking);
        $barcode = $booking->uuid;
        $options = new QROptions([
            'version'      => 5, // QR Code version (1-40, lebih besar = lebih banyak data)
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG, // Output sebagai PNG
            'eccLevel'     => QRCode::ECC_L, // Tingkat koreksi kesalahan
            'scale'        => 10, // Ukuran QR Code
            'imageBase64'  => false, // Jangan menggunakan base64
            'quietzoneSize'=> 4, // Ukuran margin (quiet zone) di sekitar QR Code
        ]);

        // Buat objek QRCode dengan opsi
        $qrcode = new QRCode($options);
        
        $directory = __DIR__ . '/../../public/cardbooking';
        

        // Periksa apakah folder barcode ada, jika tidak buat foldernya
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filepath = $directory . '/' . $barcode.'.png';
        
        $qrcode->render($barcode, $filepath);
        return view('booking/check-booking',['booking'=>$booking]);
    }

    public function cardBooking(Request $request, $id)
    {
        $booking = Booking::query()->select('booking.uuid','users.username','users.name','users.section','users.singkatan','lapangan.jenis','schedule.session','schedule.start_time','schedule.end_time')->leftJoin('users','users.users_id','=','booking.users_id')->leftJoin('lapangan','lapangan.lapangan_id','=','booking.lapangan_id')->leftJoin('schedule','schedule.schedule_id','=','booking.schedule_id')->where('booking.uuid','=',$id)->first();
        // Membuat instance FPDI
        $pdf = new FPDI;
        $target = storage_path('card-booking.pdf');
        // $target = "http://localhost/ebooking/public/card-booking.pdf";
        // Import halaman template
        $source = $pdf->setSourceFile($target);

        // Tambahkan data ke dalam PDF
        $pdf->SetTitle($booking->uuid);
        for ($i=1; $i<=$source; $i++) {
            $template = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($template);
            $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
            $pdf->useTemplate($template);
            $pdf->SetFont('Arial', 'B', 8); // Pastikan font tersedia
            $pdf->Text(8.5, 55, $booking->name);
            $pdf->SetFont('Arial', '', 10); // Pastikan font tersedia
            $pdf->Text(8.5, 59, $booking->username);
            $pdf->SetFont('Arial', '', 6); // Pastikan font tersedia
            $pdf->Text(19, 62.8, $booking->section);
            $pdf->Text(19, 66.5, $booking->singkatan);
            $pdf->Text(19, 70.5, $booking->jenis);
            $pdf->Text(19, 74.1, $booking->session);
            $pdf->Text(19, 77.8, $booking->start_time . ' - ' . $booking->end_time);
            $targetpdf = storage_path('cardbooking/');
            $pdf->Image($targetpdf.$booking->uuid.'.png',11,23,28,28);
        }

        // Output PDF
        $pdf->Output('I', 'id_card.pdf');
    }
}
