<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <?= csrfToken() ?>
    <title>EBooking</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/modules/fontawesome/css/all.min.css') ?>">
    <link rel="shortcut icon" href="<?= asset('ebudgeting.jpg') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= asset('ebudgeting.jpg') ?>" type="image/png">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/modules/chocolat/dist/css/chocolat.css') ?>">
    <!-- <link rel="stylesheet" href="<?= asset('stisla-1-2.2.0/dist/assets/modules/select2/dist/css/select2.min.css') ?>"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <style>
        .modal-lg {
        max-width: 1200px; /* Ubah ukuran sesuai kebutuhan */
        }

    </style>
    <!-- /END GA -->
    <?php $user = Support\Session::user(); ?>
</head>

<body class="sidebar">
<div id="loading-bar" style="position: fixed; top: 0; left: 0; width: 0; height: 10px; background:rgb(0, 47, 100); z-index: 9999; transition: width 0.3s ease;"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= asset('stisla-1-2.2.0/dist/assets/img/avatar/avatar-1.png') ?>"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= \Support\Session::user()->name?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="<?= base_url() . '/user/profile/' ?>"
                                class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="" id="logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form action="<?= base_url() . '/logout' ?>" id="formlogout" method="POST">
                                <?= csrf() ?>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?= base_url() . '/home' ?>">EBooking</a><br>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url() . '/home' ?>">E</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Starter Menu</li>
                        <?php if(\Support\Session::user()->role_id == 1): ?>
                        <li class=""><a class="nav-link" href="<?= base_url() . '/home' ?>"><i
                                    class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

                        <!-- Dropdown Master Data -->
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                <i class="fas fa-database"></i><span>Master Data</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url() . '/users' ?>">User</a></li>
                                <li><a class="nav-link" href="<?= base_url() . '/schedule' ?>">Schedule</a></li>
                                <li><a class="nav-link" href="<?= base_url() . '/lapangan' ?>">Lapangan</a></li>
                                <li><a class="nav-link" href="<?= base_url() . '/status' ?>">Status</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <!-- Menu di luar dropdown -->
                        <li><a class="nav-link" href="<?= base_url().'/schedule'?>"><i class="fas fa-tasks"></i><span>Schedule</span></a></li>
                        <li><a class="nav-link" href="<?= base_url().'/booking'?>"><i class="fas fa-money-check-alt"></i><span>Booking</span></a></li>
                        <li><a class="nav-link" href="<?= base_url().'/report'?>"><i class="fas fa-file-invoice-dollar"></i><span>Report</span></a></li>
                    </ul>

                </aside>
            </div>


            <!-- Main Content -->
            <div class="main-content">
                <?= $content ?>
            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    Develop By <div class="bullet"></div><a href="https://crashmyname.github.io/">Fadli Azka
                        Prayogi</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function showLoadingBar() {
                $('#loading-bar').css('width', '0').show().animate({ width: '100%' }, 800);
            }

            function hideLoadingBar() {
                $('#loading-bar').stop().css('width', '100%').fadeOut(300);
            }
            function setActiveMenu() {
                let currentPath = window.location.pathname; // Ambil URL path saat ini
                $('.sidebar-menu li').removeClass('active'); // Hapus semua class 'active'
                $('.sidebar-menu .nav-link').each(function() {
                    if ($(this).attr('href') === currentPath) {
                        $(this).parent('li').addClass(
                            'active'); // Tambahkan class 'active' ke <li> yang sesuai
                    }
                });
            }

            // Panggil fungsi untuk menetapkan menu aktif saat halaman pertama kali dimuat
            setActiveMenu();

            // Ketika item sidebar diklik
            $('.sidebar-menu .nav-link').on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href'); // Ambil URL dari href
                $('.sidebar-menu li').removeClass('active');

                // Tambahkan class "active" ke menu yang diklik
                $(this).parent('li').addClass('active');

                // Ubah URL di address bar menggunakan pushState tanpa reload halaman
                history.pushState({
                    path: url
                }, '', url);

                showLoadingBar();
                // Lakukan Ajax untuk mengambil konten dari URL tersebut
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        // Ambil hanya konten dari response dan perbarui bagian konten
                        let content = $(response).find('.main-content')
                            .html(); // Mengambil konten dari response
                        $('.main-content').html(content); // Update hanya bagian .main-content

                        // Jika ada JavaScript yang perlu dijalankan kembali, jalankan di sini
                        if (typeof initDataTable === 'function') {
                            initDataTable
                                (); // Jika ada fungsi DataTable yang perlu dipanggil, jalankan kembali
                        }
                    },
                    error: function(xhr) {
                        if(xhr.status === 401){
                            window.location.href = '<?=base_url()?>/login';
                        } else {
                            // Tampilkan pesan error jika bukan 401
                            $('.main-content').html('<br><br><h2>Coming soon</h2>');
                        }
                    },
                    complete: function () {
                        // Sembunyikan loading bar setelah Ajax selesai
                        hideLoadingBar();
                    }
                });
            });

            // Tangani perubahan URL melalui tombol browser kembali/maju
            window.onpopstate = function(event) {
                if (event.state && event.state.path) {
                    showLoadingBar();
                    // Lakukan Ajax untuk memuat konten sesuai URL
                    $.ajax({
                        url: event.state.path,
                        method: 'GET',
                        success: function(response) {
                            // Ambil konten yang sesuai dan perbarui halaman
                            let content = $(response).find('.main-content').html();
                            $('.main-content').html(content);

                            // Jika ada JavaScript yang perlu dijalankan kembali, jalankan di sini
                            if (typeof initDataTable === 'function') {
                                initDataTable(); // Reinitialize DataTable jika ada
                            }
                            setActiveMenu();
                        },
                        error: function() {
                            $('.main-content').html('<p>Error loading content</p>');
                        },
                        complete: function () {
                            hideLoadingBar();
                        }
                    });
                    let currentPath = event.state.path;
                    $('.sidebar-menu li').removeClass('active');
                    $('.sidebar-menu li').each(function() {
                        if ($(this).attr('href') === currentPath) {
                            $(this).parent('li').addClass('active');
                        }
                    });
                }
            };
        });
        document.getElementById('logout').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Logout!',
                icon: 'warning',
                text: 'Apakah yakin ingin Logout?',
                showCancelButton: true,
                confirmButtonText: 'Ya Logout!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formlogout').submit();
                }
            })
        })
    </script>

    <!-- General JS Scripts -->
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/jquery.min.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/popper.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/tooltip.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/moment.min.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/js/stisla.js') ?>"></script>
    <!-- <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/select2/dist/js/select2.full.min.js') ?>"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/select/2.1.0/js/select.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JS Libraies -->
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/prism/prism.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') ?>"></script>

    <!-- Page Specific JS File -->
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/js/page/bootstrap-modal.js') ?>"></script>
    <!-- JS Libraies -->
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template JS File -->
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/js/scripts.js') ?>"></script>
    <script src="<?= asset('stisla-1-2.2.0/dist/assets/js/custom.js') ?>"></script>
</body>

</html>
