<section class="section">
    <div class="section-header">
        <h1>Users</h1>
    </div>

    <div class="section-body">
        <b>User Management</b>
    </div>
    <div class="card-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-user-tag"></i></button>
        <button class="btn btn-warning" data-toggle="modal" data-target="" id="modalupdateuser">Update <i class="fas fa-user-edit"></i></button>
        <button class="btn btn-danger" type="submit" id="deleteuser">Delete <i class="fas fa-user-times"></i></button> <button class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalImport">Import Excel <i class="far fa-file-excel"></i></button> <button class="btn btn-success" type="submit" id="exportexcel">Export Excel <i class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i class="far fa-file-pdf"></i></button>
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Alias Section</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Alias Section</th>
                    <th>Level</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="formadduser" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                            <label>Name</label>
                            <!-- <input type="text" name="name" id="name" class="form-control"> -->
                             <select name="name" id="name" class="form-control">
                                
                             </select>
                            <label>Section</label>
                            <select name="section" id="section" class="form-control">
                            
                            </select>
                            <label>Singkatan Section</label>
                            <select name="alias_section" id="alias_section" class="form-control">
                            
                            </select>
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <label>Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <?php foreach($role as $level):?>
                                    <option value="<?= $level->role_id?>"><?= $level->role?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" name="role_id" id="role_id" class="form-control"> -->
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="adduser">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formupdateuser" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal User</h5>
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
                            <input type="text" name="username" id="uusername" class="form-control" readonly>
                            <label>Name</label>
                            <input type="text" name="name" id="uname" class="form-control">
                            <label>Section</label>
                            <input type="text" name="section" id="usection" class="form-control">
                            <label>Alias Section</label>
                            <input type="text" name="alias_sect" id="ualias_sect" class="form-control">
                            <label>Password</label>
                            <input type="password" name="password" id="upassword" class="form-control">
                            <label>Role</label>
                            <input type="text" name="role_id" id="urole_id" class="form-control" readonly>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="updateuser">Save changes</button>
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
            ajax: '<?= base_url() ?>/getusers',
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            columns: [{
                    data: 'uuid',
                    name: 'uuid',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'singkatan',
                    name: 'singkatan'
                },
                {
                    data: 'role',
                    name: 'role'
                },
            ]
        });
    }

    function crudUser() {
        var table = $('#datatable').DataTable();
        $('#adduser').on('click', function(e) {
            e.preventDefault();
            var url = '<?= base_url() . '/users' ?>';
            var formData = new FormData($('#formadduser')[0]);
            $.ajax({
                type: 'POST',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 201) {
                        $('#formadduser')[0].reset();
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'User Added',
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
        $('#modalupdateuser').on('click', function(e) {
            e.preventDefault();
            var selectedData = table.rows({
                selected: true
            }).data();
            var username = $('#uusername');
            var name = $('#uname');
            var sect = $('#usection');
            var alias = $('#ualias_sect');
            var password = $('#upassword');
            var role_id = $('#urole_id');
            if (selectedData.length > 0) {
                username.val(selectedData[0].username);
                name.val(selectedData[0].name);
                sect.val(selectedData[0].section);
                alias.val(selectedData[0].singkatan);
                // password.val(selectedData[0].password);
                role_id.val(selectedData[0].role_id == 1 ? 'Administrator' : 'User');
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
        $('#updateuser').on('click', function(e) {
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
            var updateUser = "<?= base_url() . '/uusers/' ?>" + uID;
            var formID = '#formupdateuser';
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
                        var formUpUser = new FormData($(formID)[0]);
                        $.ajax({
                            type: 'POST',
                            url: updateUser,
                            data: formUpUser,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire({
                                        title: 'success',
                                        icon: 'success',
                                        text: response.message,
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
        $('#deleteuser').on('click', function(e) {
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
                            $.ajax({
                                type: 'DELETE',
                                url: "<?= base_url() . '/users/' ?>" + uuid,
                                success: function(response) {
                                    if (response.status == 200) {
                                        Swal.fire({
                                            title: 'Success',
                                            icon: 'success',
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
                                    }
                                }
                            })
                        })
                    }
                })

            }
        })
    }

    function getEmployee(){
        $('#username').change(function(){
            var username = $('#username').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?= base_url()?>/testlo',
                headers: {
                    'X-CSRF-Token': '<?= csrfHeader() ?>'
                },
                data: {
                    nik: username,
                },
                success:function(data){
                    // console.log(data);
                    var options = '';
                    var optionsdept = '';
                    var optionssect = '';
                    var optionsalias = '';
                    var optionsemail = '';
                    options += "<option value='" + data.nama + "'>" + data.nama + "</option>";
                    optionsdept += "<option value='" + data.dept + "'>" + data.dept + "</option>";
                    optionssect += "<option value='" + data.kode_section + "'>" + data.kode_section + "</option>";
                    optionsalias += "<option value='" + data.singkatan + "'>" + data.singkatan + "</option>";
                    optionsemail += "<option value='" + data.work_email + "'>" + data.work_email + "</option>";
                    $('#name').html(options);
                    $('#departement').html(optionsdept);
                    $('#section').html(optionssect);
                    $('#alias_section').html(optionsalias);
                    $('#email').html(optionsemail);
                }
            })
        })
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        initDataTable();
        crudUser();
        getEmployee();
    });
</script>
