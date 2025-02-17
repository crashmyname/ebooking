<section class="section">
    <div class="section-header">
        <h1>Login Activity</h1>
    </div>

    <div class="section-body">
        <b>Login Activity</b>
    </div>
    <div class="card-body">
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Login Time</th>
                    <th>IP Address</th>
                    <th>Hostname</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Login Time</th>
                    <th>IP Address</th>
                    <th>Hostname</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<script>
    // Fungsi inisialisasi DataTables khusus untuk halaman ini
    function initDataTable() {
        if ($.fn.dataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().clear().destroy(); // Hancurkan DataTable yang sudah ada
        }
        $('#datatable').DataTable({
            ajax: '<?= base_url() ?>/getactivity',
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            columns: [{
                    data: 'login_activity_id',
                    name: 'login_activity_id',
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
                    data: 'login_time',
                    name: 'login_time'
                },
                {
                    data: 'ip_address',
                    name: 'ip_address'
                },
                {
                    data: 'hostname',
                    name: 'hostname'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ]
        });
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        initDataTable();
    });
</script>
