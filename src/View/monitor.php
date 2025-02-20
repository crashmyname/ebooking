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
    <link rel="shortcut icon" href="<?= asset('iconebooking1.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= asset('iconebooking1.png') ?>" type="image/png">

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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.0.1/dist/fullcalendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.0.1/dist/fullcalendar.min.css" rel="stylesheet" />
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
            max-width: 1200px;
            /* Ubah ukuran sesuai kebutuhan */
        }
    </style>
    <!-- /END GA -->
    <?php $user = Support\Session::user(); ?>
</head>

<body class="sidebar mini sidebar-mini">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                </nav> -->
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Monitoring Booking</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <!-- <h2 class="section-title">Data Booking</h2> -->

                            <div class="row col-12 ">
                                <?php foreach($booking as $book): ?>
                                <div class="col-12 col-md-12 col-lg-3">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4><?=$book->jenis ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td width="25%">Name</td>
                                                    <td width="2%"></td>
                                                    <td width="1000px"><?=$book->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Section</td>
                                                    <td></td>
                                                    <td><?=$book->singkatan ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Session</td>
                                                    <td></td>
                                                    <td><?= 'Session '.$book->session ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Start</td>
                                                    <td></td>
                                                    <td><?=$book->start_time ?></td>
                                                </tr>
                                                <tr>
                                                    <td>End</td>
                                                    <td></td>
                                                    <td><?=$book->end_time ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td></td>
                                                    <td><?php if($book->status_id == 2): ?>
                                                        <button class="btn btn-disabled btn-success">Booking</button>
                                                        <?php elseif($book->status_id == 3): ?>
                                                        <button class="btn btn-disabled btn-primary">Now Playing</button>
                                                        <?php else: ?>
                                                        <button class="btn btn-disabled btn-danger">Cancel</button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

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
