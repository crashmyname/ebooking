<section class="section">
    <div class="section-header">
        <h1>Schedule</h1>
    </div>

    <div class="section-body">
        <b>Schedule Management</b>
    </div>
    <div class="card-body">
        <?= \Support\Session::user()->role_id == '1' ? '<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-user-tag"></i></button>
        <button class="btn btn-warning" data-toggle="modal" data-target="" id="modalupdateschedule">Update <i class="fas fa-user-edit"></i></button>
        <button class="btn btn-danger" type="submit" id="deleteschedule">Delete <i class="fas fa-user-times"></i></button> <button class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalImport">Import Excel <i class="far fa-file-excel"></i></button> <button class="btn btn-success" type="submit" id="exportexcel">Export Excel <i class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i class="far fa-file-pdf"></i></button>' : '<button class="btn btn-success" type="submit" id="exportexcel">Export Excel <i class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i class="far fa-file-pdf"></i></button>' ?>
         
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lapangan</th>
                    <th>Hari</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Lapangan</th>
                    <th>Hari</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="formaddschedule" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Lapangan</label>
                             <select name="lapangan_id" id="lapangan_id" class="form-control">
                                <?php foreach($lapangan as $data):?>
                                    <option value="<?= $data->lapangan_id?>"><?= $data->jenis?></option>
                                <?php endforeach;?>
                             </select>
                            <label>Hari</label>
                            <select name="day" id="day" class="form-control" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                             </select>
                            <label>Start Time</label>
                             <input type="time" name="start_time" id="start_time" class="form-control" required>
                            <label>End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" required>
                            <label>Session</label>
                            <select name="session" id="session" class="form-control">
                                <option value="I">Session I</option>
                                <option value="II">Session II</option>
                                <option value="III">Session III</option>
                                <option value="IV">Session IV</option>
                                <option value="V">Session V</option>
                                <option value="VI">Session VI</option>
                            </select>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addschedule">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formupdateschedule" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <?= method('PUT') ?>
                            <label>Lapangan</label>
                            <input type="text" name="lapangan_id" id="ulapangan_id" class="form-control" readonly>
                            <label>Hari</label>
                            <input type="text" name="day" id="uday" class="form-control">
                            <label>Start Time</label>
                            <input type="time" name="start_time" id="ustart_time" class="form-control">
                            <label>End Time</label>
                            <input type="time" name="end_time" id="uend_time" class="form-control">
                            <label>Session</label>
                            <input type="text" name="session" id="usession" class="form-control">
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="updateschedule">Save changes</button>
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
        $('#datatable').DataTable({
            ajax: '<?= base_url() ?>/getschedule',
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            columns: [{
                    data: 'schedule_id',
                    name: 'schedule_id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'jenis',
                    name: 'jenis'
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
            ]
        });
    }

    function crudSchedule() {
        var table = $('#datatable').DataTable();
        $('#addschedule').on('click', function(e) {
            e.preventDefault();
            var url = '<?= base_url() . '/schedule' ?>';
            var formData = new FormData($('#formaddschedule')[0]);
            $.ajax({
                type: 'POST',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 201) {
                        $('#formaddschedule')[0].reset();
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Schedule Added',
                        });
                        table.ajax.reload();
                    } else {
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
        })
        $('#modalupdateschedule').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            var lapangan_id = $('#ulapangan_id');
            var day = $('#uday');
            var start_time = $('#ustart_time');
            var end_time = $('#uend_time');
            var session = $('#usession');
            if (selectedData.length > 0) {
                lapangan_id.val(selectedData[0].lapangan_id);
                day.val(selectedData[0].day);
                start_time.val(selectedData[0].start_time);
                end_time.val(selectedData[0].end_time);
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
        $('#updateschedule').on('click', function(e) {
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
            var uID = row.schedule_id;
            var updateSchedule = "<?= base_url() . '/uschedule/' ?>" + uID;
            var formID = '#formupdateschedule';
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
                        var formUpSchedule = new FormData($(formID)[0]);
                        $.ajax({
                            type: 'POST',
                            url: updateSchedule,
                            data: formUpSchedule,
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
                                    $('#formupdateschedule')[0].reset();
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
        $('#deleteschedule').on('click', function(e) {
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
                            const uuid = data.schedule_id;
                            $.ajax({
                                type: 'DELETE',
                                url: "<?= base_url() . '/schedule/' ?>" + uuid,
                                success: function(response) {
                                    if (response.status == 200) {
                                        Swal.fire({
                                            title: 'Success',
                                            icon: 'success',
                                            text: 'Data Berhasil dihapus',
                                            timer: 1500,
                                            timerProgressBar: true,
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: 'Data Error',
                                            timer: 1500,
                                            timerProgressBar: true,
                                        });
                                    }
                                }
                            })
                        })
                    }
                })

            }
        })
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        initDataTable();
        crudSchedule();
    });
</script>
