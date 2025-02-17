<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <?php if (\Support\Session::hasFlash('success')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "<?= \Support\Session::flash('success') ?>",
            showConfirmButton: false,
            timer: 1000
        });
    </script>
    <?php endif; ?>
    <div class="section-body">
        <div class="row">
            <div class="col-12 mb-4">
                <!-- <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url(<?= asset('images/Stanley_Cikupa.jpg') ?>);"> -->
                <div class="hero-inner">
                    <h2>Hi, <?php echo \Support\Session::user()->name; ?>!</h2>
                    <p class="lead">Welcome to PT Indonesia Stanley Electric's E-booking System.
                        <br>Streamline your bookings with ease and enjoy a convenient booking solution at your
                        fingertips.
                    </p>
                </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sports</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Booking Today</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            47
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <button id="notifyBtn">Tampilkan Notifikasi</button> -->
<script>
    if (Notification.permission === 'default') {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                console.log('Notifikasi diizinkan');
            } else {
                console.log('Notifikasi ditolak');
            }
        });
    }
</script>
