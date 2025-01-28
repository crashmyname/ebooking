<section class="section">
    <div class="section-header">
        <h1>Lapangan</h1>
    </div>

    <div class="section-body">
        <b>Lapangan Management</b>
    </div>
    <div class="card-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-user-tag"></i></button>
        <button class="btn btn-warning" data-toggle="modal" data-target="" id="modalupdatelapangan">Update <i class="fas fa-user-edit"></i></button>
        <button class="btn btn-danger" type="submit" id="deletelapangan">Delete <i class="fas fa-user-times"></i></button> <button class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalImport">Import Excel <i class="far fa-file-excel"></i></button> <button class="btn btn-success" type="submit" id="exportexcel">Export Excel <i class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i class="far fa-file-pdf"></i></button>
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lapangan</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Lapangan</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="formaddlapangan" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Lapangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Lapangan</label>
                            <input type="text" name="lapangan" id="lapangan" class="form-control">
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addlapangan">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formupdatelapangan" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Lapangan</h5>
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
                            <input type="text" name="lapangan" id="ulapangan" class="form-control" readonly>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="updatelapangan">Save changes</button>
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
            ajax: '<?= base_url() ?>/getlapangan',
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            columns: [{
                    data: 'lapangan_id',
                    name: 'lapangan_id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
            ]
        });
    }

    function crudLapangan() {
        var table = $('#datatable').DataTable();
        $('#addlapangan').on('click', function(e) {
            e.preventDefault();
            var url = '<?= base_url() . '/lapangan' ?>';
            var formData = new FormData($('#formaddlapangan')[0]);
            $.ajax({
                type: 'POST',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 201) {
                        $('#formaddlapangan')[0].reset();
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Lapangan Added',
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
        $('#modalupdatelapangan').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            var lapangan = $('#ulapangan');
            if (selectedData.length > 0) {
                lapangan.val(selectedData[0].lapangan);
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
        $('#updatelapangan').on('click', function(e) {
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
            var uID = row.lapangan_id;
            var updateLapangan = "<?= base_url() . '/ulapangan/' ?>" + uID;
            var formID = '#formupdatelapangan';
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
                        var formUpLapangan = new FormData($(formID)[0]);
                        $.ajax({
                            type: 'POST',
                            url: updateLapangan,
                            data: formUpLapangan,
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
                                    $('#formupdatelapangan')[0].reset();
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
        $('#deletelapangan').on('click', function(e) {
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
                            const uuid = data.lapangan_id;
                            $.ajax({
                                type: 'DELETE',
                                url: "<?= base_url() . '/lapangan/' ?>" + uuid,
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
        crudLapangan();
    });
</script>
