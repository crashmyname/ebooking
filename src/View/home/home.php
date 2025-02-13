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
                <!-- <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url(<?= asset('images/Stanley_Cikupa.jpg')?>);"> -->
                  <div class="hero-inner">
                    <h2>Hi, <?php echo \Support\Session::user()->name ?>!</h2>
                    <p class="lead">Welcome to PT Indonesia Stanley Electric's E-booking System.
                        <br>Streamline your bookings with ease and enjoy a convenient booking solution at your fingertips.</p>
                  </div>
                <!-- </div> -->
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