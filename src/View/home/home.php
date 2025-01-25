<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 mb-4">
                <!-- <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url(<?= asset('images/Stanley_Cikupa.jpg')?>);"> -->
                  <div class="hero-inner">
                    <h2>Welcome Back, <?php echo 'Admin' ?>!</h2>
                    <p class="lead">This page is a place to manage dashboard and more. <?= $hari?></p>
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