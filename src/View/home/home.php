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
                            <?= $user?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-basketball-ball"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sports</h4>
                        </div>
                        <div class="card-body">
                            <?= $sport?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-running"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Booking Today</h4>
                        </div>
                        <div class="card-body">
                            <?= $booking?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            <?= $online?>
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
    document.addEventListener('DOMContentLoaded', function(){
        function countData(){
            fetch('<?= base_url().'/countdata'?>')
                .then(response => response.json())
                .then(data =>{
                    if(document.getElementById('user')){
                        document.getElementById('user').innerHTML = data.user;
                    }
                    if(document.getElementById('sport')){
                        document.getElementById('sport').innerHTML = data.sport;
                    }
                    if(document.getElementById('booking')){
                        document.getElementById('booking').innerHTML = data.booking;
                    }
                    if(document.getElementById('online')){
                        document.getElementById('online').innerHTML = data.online;
                    }
                })
                .catch(error => console.error(error));
        }
        var socket = io('http://10.203.84.25:3001');
        countData();
        socket.on('reload-data', function(){
            countData();
            console.log('Count berhasil direload');
        })
        socket.emit('dashboard');
    })
</script>
