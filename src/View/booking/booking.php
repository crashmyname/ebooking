<section class="section">
    <div class="section-header">
        <h1>Booking</h1>
    </div>

    <div class="section-body">
        <b>Booking Management</b>
    </div>
    <div class="card-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-futbol"></i></button>
        <?php if(\Support\Session::user()->role_id == 1): ?>
        <button class="btn btn-warning" data-toggle="modal" data-target="" id="modalupdatebooking">Update <i
                class="fas fa-user-edit"></i></button>
        <!-- <button class="btn btn-outline-success" data-toggle="modal"
            data-target="#exampleModalImport">Import Excel <i class="far fa-file-excel"></i></button> <button
            class="btn btn-success" type="submit" id="exportexcel">Export Excel <i
                class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i
                class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i
                class="far fa-file-pdf"></i></button> -->
        <?php endif; ?>
        <button class="btn btn-danger" type="submit" id="deletebooking">Delete <i class="fas fa-trash"></i></button> 
        <hr>
        <div class="col-3">
            <input type="date" name="tanggal" id="tanggal" class="form-control">
        </div>
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Lapangan</th>
                    <th>Booking Date</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Ket</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Lapangan</th>
                    <th>Booking Date</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Ket</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="formaddbooking" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Username</label>
                            <input type="text" name="users_id" id="users_id"
                                value="<?= \Support\Session::user()->name ?>" class="form-control" readonly>
                            <label for="">Booking Date</label>
                            <input type="date" name="booking_date" id="booking_date" class="form-control">
                            <label>Lapangan</label>
                            <select name="lapangan_id" id="lapangan_id" class="form-control">
                                <!-- <option value="" hidden disabled selected>--Pilih--</option>
                                <?php foreach($lapangan as $lap): ?>
                                <option value="<?= $lap->lapangan_id ?>"><?= $lap->jenis ?></option>
                                <?php endforeach; ?> -->
                            </select>
                            <label>Schedule</label>
                            <select name="schedule_id" id="schedule_id" class="form-control">
                                <!-- <?php foreach($schedule as $sch): ?>
                                    <option value="<?= $sch->schedule_id ?>"><?= $sch->day ?> | <?= $sch->start_time ?> | <?= $sch->end_time ?> | Session <?= $sch->session ?></option>
                                <?php endforeach; ?> -->
                            </select>
                            <label>Section</label>
                            <input type="text" name="description" id="description" class="form-control" value="<?= \Support\Session::user()->singkatan?>" readonly>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addbooking">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formupdatebooking" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <?= method('PUT') ?>
                            <label>Username</label>
                            <input type="text" name="users_id" id="uusers_id" class="form-control" readonly>
                            <label for="">Booking Date</label>
                            <input type="date" name="booking_date" id="ubooking_date" class="form-control" readonly>
                            <label>Lapangan</label>
                            <select name="lapangan_id" id="ulapangan_id" class="form-control">

                            </select>
                            <label>Schedule</label>
                            <select name="schedule_id" id="uschedule_id" class="form-control">

                            </select>
                            <label>Section</label>
                            <input type="text" name="description" id="udescription" class="form-control"  readonly>
                            <label for=""> Status </label>
                            <select name="status" id="status" class="form-control">

                            </select>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="updatebooking">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // Fungsi inisialisasi DataTables khusus untuk halaman ini
    function initDataTable() {
        if ($.fn.dataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().clear().destroy(); // Hancurkan DataTable yang sudah ada
        }
        var table = $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url() ?>/getbooking',
                type: 'GET',
                data: function(d) {
                    d.tanggal = $('#tanggal').val();
                },
            },
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            columns: [{
                    data: 'booking_id',
                    name: 'booking_id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'booking_date',
                    name: 'booking_date'
                },
                {
                    data: 'day',
                    name: 'day'
                },
                {
                    data: 'start_time',
                    name: 'start_time'
                },
                {
                    data: 'end_time',
                    name: 'end_time'
                },
                {
                    data: 'session',
                    name: 'session'
                },
                {
                    data: 'status',
                    name: 'status',
                    render:function(data,type,row){
                        if(data == 'Booked'){
                            return '<span class="badge badge-success">'+data+'</span>';
                        } else if(data == 'Cancel'){
                            return '<span class="badge badge-danger">'+data+'</span>';
                        } else {
                            return '<span class="badge badge-primary">'+data+'</span>';
                        }
                    }
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'code_booking',
                    name: 'action',
                    render:function(data, type, row){
                        var name = row.users_id;
                        switch(true){
                            case <?= \Support\Session::user()->users_id?> != name && <?= \Support\Session::user()->users_id?> != 1:
                                return '<span class="badge badge-danger">'+'Cek Booking'+'</span>';
                            break;
                            case <?= \Support\Session::user()->users_id?> == 1:
                                return '<a href="<?= base_url().'/cardbooking/'?>'+data+'" target="_blank" class="btn btn-warning">Card Booking</a>';
                                break;
                            case row.status == 'Cancel':
                                return '<span class="badge badge-danger">'+'Canceled Booking'+'</span>';
                            break;
                            default:
                                return '<a href="<?= base_url().'/cardbooking/'?>'+data+'" target="_blank" class="btn btn-warning">Card Booking</a>';
                            break;
                        }
                    }
                },
            ]
        });
        setTimeout(function() {
            $('#tanggal').trigger('change');
        }, 100);
        $('#tanggal').change(function() {
            table.ajax.reload();
        }
    );
    }

    function crudBooking() {
        var table = $('#datatable').DataTable();
        var socket = io('http://10.203.84.25:3001');
            socket.on('reload-datatable', function() {
                table.ajax.reload(null, false);
            })
        $('#addbooking').on('click', function(e) {
            e.preventDefault();
            var url = '<?= base_url() . '/booking' ?>';
            var formData = new FormData($('#formaddbooking')[0]);
            
            Swal.fire({
                    title: 'Submit',
                    icon: 'warning',
                    text: 'Apakah Data Sudah Benar?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Submit!!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        if($('#schedule_id,#lapangan_id').val() == "" || $('#schedule_id').val() == null){
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: 'schedule dan lapangan wajib diisi',
                            });
                            return;
                        }
                        $.ajax({
                            type: 'POST',
                            url: url,
                            processData: false,
                            contentType: false,
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                switch(true){
                                    case response.status === 201:
                                        $('#formaddbooking')[0].reset();
                                        Swal.fire({
                                            title: 'Success',
                                            icon: 'success',
                                            text: response.message,
                                        });
                                        table.ajax.reload(null, false);
                                        socket.emit('dashboard');
                                        socket.emit('new-user'); 
                                        break;
                                    case response.status === 400:
                                        Swal.fire({
                                            title: 'Info',
                                            icon: 'info',
                                            text: response.message,
                                        });
                                        break;
                                    case response.status === 422:
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: response.message,
                                        });
                                        break;
                                    case response.status === 500:
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: response.message,
                                        });
                                        break;
                                    default:
                                    var errorMessage = '';

                                    // Memastikan bahwa response.status adalah objek dan memiliki pesan error
                                    if (response.status && typeof response.status === 'object') {
                                        // Loop untuk setiap field dan pesan errornya
                                        for (var field in response.status) {
                                            if (response.status.hasOwnProperty(field)) {
                                                response.status[field].forEach(function(message) {
                                                    // Menambahkan pesan error untuk field tertentu
                                                    errorMessage += message +
                                                        '\n'; // Gabungkan pesan dengan enter
                                                });
                                            }
                                        }
                                    } else {
                                        errorMessage = "An unexpected error occurred.";
                                    }

                                    // Menampilkan pesan error di SweetAlert
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'error',
                                        text: errorMessage
                                            .trim(), // Menghapus spasi ekstra sebelum menampilkan
                                    });
                                }
                            }
                        })
                    }
                })
        })
        $('#modalupdatebooking').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            var username = $('#uusers_id');
            var bookingDate = $('#ubooking_date');
            var lapangan = $('#ulapangan_id');
            var schedule = $('#uschedule_id');
            var status = $('#status');
            var description = $('#udescription');
            if (selectedData.length > 0) {
                username.val(selectedData[0].name);
                bookingDate.val(selectedData[0].booking_date);
                lapangan.empty();
                lapangan.append('<option value="' + selectedData[0].lapangan_id + '">' + selectedData[0].jenis + '</option>');
                schedule.empty();
                schedule.append('<option value="' + selectedData[0].schedule_id + '">' + selectedData[0].day + ' | ' + selectedData[0].start_time + ' | ' + selectedData[0].end_time + ' | Session ' + selectedData[0].session + '</option>');
                status.empty();
                var getStatus = selectedData[0].status;
                if(getStatus == 'Booked'){
                    status.append('<option value="'+getStatus+'" selected>Booked</option>');
                    status.append('<option value="5">Canceled</option>');
                } else {
                    status.append('<option value="2">Booked</option>');
                    status.append('<option value="5" selected>Canceled</option>');
                }
                description.val(selectedData[0].description);
                $('#exampleModalEdit').modal('show');
            } else {
                $('#exampleModalEdit').modal('hide');
                Swal.fire({
                    title: 'info',
                    icon: 'info',
                    text: 'No data selected',
                });
            }
        });
        $('#updatebooking').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            if (selectedData.length == 0) {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'Tidak ada data yang dipilih!',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                return;
            }
            var row = selectedData[0];
            var uID = row.uuid;
            var updateBooking = "<?= base_url() . '/booking/' ?>" + uID;
            var formID = '#formupdatebooking';
            $('#modalwarning').modal('hide');
            if (selectedData.length > 0) {
                Swal.fire({
                    title: 'Update',
                    icon: 'warning',
                    text: 'Yakin data ingin diubah?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Ubah!!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formUpBooking = new FormData($(formID)[0]);
                        $.ajax({
                            type: 'POST',
                            url: updateBooking,
                            data: formUpBooking,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire({
                                        title: 'success',
                                        icon: 'success',
                                        text: 'Data berhasil diupdate',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                    table.ajax.reload(null, false);
                                    $('#formupdateuser')[0].reset();
                                } else {
                                    Swal.fire({
                                        title: 'error',
                                        icon: 'error',
                                        text: 'Data gagal diupdate',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                }
                            }
                        })
                    }
                })
            }
        })
        $('#deletebooking').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            if (selectedData.length == 0) {
                Swal.fire({
                    title: 'info',
                    icon: 'info',
                    text: 'No data selected',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                return;
            }
            if (selectedData.length > 0) {
                Swal.fire({
                    title: 'Delete',
                    icon: 'warning',
                    text: 'Yakin ingin dihapus?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        selectedData.each(function(data) {
                            const uuid = data.uuid;
                            const uid = data.users_id;
                            $.ajax({
                                type: 'DELETE',
                                url: "<?= base_url() . '/booking/' ?>" + uuid + '/' + uid,
                                success: function(response) {
                                    if (response.status == 200) {
                                        Swal.fire({
                                            title: 'Success',
                                            icon: 'success',
                                            text: 'Data Berhasil dihapus',
                                            timer: 1500,
                                            timerProgressBar: true,
                                        });
                                        socket.emit('dashboard');
                                        socket.emit('new-user'); 
                                        table.ajax.reload(null, false);
                                    } else if(response.status == 400){
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: response.message,
                                            timer: 1500,
                                            timerProgressBar: true,
                                        });
                                        table.ajax.reload(null, false);
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: 'Data Error',
                                            timer: 1500,
                                            timerProgressBar: true,
                                        });
                                        table.ajax.reload(null, false);
                                    }
                                }
                            })
                        })
                    }
                })

            }
        })
    }

    function getSchedule() {
        setTimeout(function() {
            $('#booking_date').trigger('change');
        }, 100);
        $('#booking_date').change(function(){
            var bookingdate = $(this).val();
            var url = '<?= base_url() . '/getday' ?>';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    booking_date: bookingdate
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '<?= csrfHeader() ?>'
                },
                success: function(response) {
                    var options = '';
                    options += '<option value="">-- Pilih --</option>';
                    response.forEach(function(data) {
                        options += '<option value="' + data.lapangan_id + '">' + data.jenis + '</option>';
                    });
                    $('#lapangan_id').html(options);
                }
            })
        })
        $('#lapangan_id,#booking_date').change(function() {
            var lapangan_id = $('#lapangan_id').val();
            var bookingdate = $('#booking_date').val();
            var url = '<?= base_url() . '/getscheduledata' ?>';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    lapangan_id: lapangan_id,
                    booking_date:bookingdate,
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '<?= csrfHeader() ?>'
                },
                success: function(response) {
                    var options = '';
                    response.forEach(function(data) {
                        if(data.is_booked){
                            options += '<option disabled style="color: grey;" value="' + data.schedule_id + '">' + data.day +
                            ' | ' + data.start_time + ' | ' + data.end_time +
                            ' | Session ' + data.session + '</option>';
                        } else {
                            options += '<option value="' + data.schedule_id + '">' + data.day +
                                ' | ' + data.start_time + ' | ' + data.end_time +
                                ' | Session ' + data.session + '</option>';
                        }
                    });
                    $('#schedule_id').html(options);
                }
            })
        })
    }

    function DateRange(){
        let today = new Date();
        let minDate = new Date();
        minDate.setDate(today.getDate() - 14);
        let maxDate = new Date();
        maxDate.setDate(today.getDate() + 30);

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        document.getElementById("booking_date").min = formatDate(minDate);
        document.getElementById("booking_date").max = formatDate(maxDate);
    }

    function getData() {
        // Pastikan kode hanya berjalan setelah DOM dimuat
        let tanggalInput = document.getElementById('tanggal');
        let bookingDate = document.getElementById('booking_date');

        if (tanggalInput && bookingDate) {
            // Ambil tanggal hari ini dan format ke 'YYYY-MM-DD'
            let today = new Date();
            let formattedDate = today.toISOString().split('T')[0];

            // Atur nilai default input tanggal
            tanggalInput.value = formattedDate;
            bookingDate.value = formattedDate;

            // Tambahkan event listener untuk memicu fungsi submit saat tanggal dipilih
            tanggalInput.addEventListener('change', function() {
                submit(); // Panggil fungsi submit saat tanggal berubah
            });

            // console.log("Tanggal default:", formattedDate);
        } else {
            console.error("Elemen dengan ID 'tanggal' atau 'booking_date' tidak ditemukan.");
        }
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        initDataTable();
        crudBooking();
        getSchedule();
        getData();
        DateRange();
    });
</script>
