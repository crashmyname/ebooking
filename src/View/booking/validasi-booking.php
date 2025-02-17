<section class="section">
    <div class="section-header">
        <h1>Validation Booking</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Barcode</h4>
                        <div class="card-header-action">
                            <form action="" method="post" id="formcheckbooking">
                                <?= csrf()?>
                                <input type="text" class="form-control" name="code_booking" id="code_booking">
                                <button type="submit" class="btn btn-success form-control" id="checkbooking">Check Booking</button>
                            </form>
                        </div>
                    </div>
                    <center>
                        <div class="card-body">
                            <div class="mb-2 text-muted">Code : <span id="code_bookings"></span>
                            </div>
                            <div class="chocolat-parent">
                                <a href="" id="booking-link"
                                    class="chocolat-image" title="Just an example">
                                    <div data-crop-image="">
                                        <img alt="image"
                                            src=""
                                            class="img-fluid" width="360px">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Barcode</h4>
                        <div class="card-header-action">
                            <a href="" id="download-booking"
                                class="btn btn-primary">Download Booking</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Username</label>
                                <input type="text" class="form-control" value=""
                                    name="username" id="username" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Section</label>
                                <input type="text" class="form-control" id="section"
                                    name="section" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Alias Section</label>
                                <input type="text" class="form-control" id="alias_sect"
                                    name="alias_sect" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Sport</label>
                                <input type="text" class="form-control" name="jenis" id="jenis"
                                    readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Session</label>
                                <input type="text" class="form-control" name="session"
                                id="session" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Start Date</label>
                                <input type="text" class="form-control" name="start_date"
                                id="start_date" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>End Date</label>
                                <input type="text" class="form-control" name="end_date"
                                id="end_date" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <a href="" id="confirm" class="btn btn-primary" style="display:none">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function CheckBooking() {
        $('#checkbooking').on('click', function(e) {
            e.preventDefault();
            var url = '<?= base_url() . '/check' ?>';
            var formData = new FormData($('#formcheckbooking')[0]);
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
                    $.ajax({
                        type: 'POST',
                        url: url,
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == 200){
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: response.message,
                                });
                                $('#username').val(response.data.username);
                                $('#name').val(response.data.name);
                                $('#section').val(response.data.section);
                                $('#alias_sect').val(response.data.singkatan);
                                $('#jenis').val(response.data.jenis);
                                $('#session').val(response.data.session);
                                $('#start_date').val(response.data.start_time);
                                $('#end_date').val(response.data.end_time);
                                $('#code_bookings').html(response.data.code_booking);
                                $('#booking-link').attr('href', '<?= asset('cardbooking/') ?>' + response.data.code_booking + '.png');
                                $('#booking-link img').attr('src', '<?= asset('cardbooking/') ?>' + response.data.code_booking + '.png');
                                $('#download-booking').attr('href', '<?= base_url().'/card/' ?>' + response.data.code_booking);
                                console.log(response.data.status);
                                if(response.data.status == 'Booked'){
                                    $('#confirm').show();
                                    $('#confirm').attr('href', '<?= base_url().'/validasi/' ?>' + response.data.code_booking);
                                }else{
                                    $('#confirm').hide();
                                }
                            }else{
                                Swal.fire({
                                    title: 'Failed',
                                    icon: 'error',
                                    text: response.message,
                                });
                            }
                        }
                    })
                }
            })
        })
        $('#confirm').on('click', function(e) {
            e.preventDefault();
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
                    $.ajax({
                        type: 'GET',
                        url: $(this).attr('href'),
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == 200){
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: response.message,
                                });
                            }else{
                                Swal.fire({
                                    title: 'Failed',
                                    icon: 'error',
                                    text: response.message,
                                });
                            }
                        }
                    })
                }
            })
        })
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        CheckBooking();
    });
</script>
