<section class="section">
    <div class="section-header">
        <h1>Login Activity</h1>
    </div>

    <div class="section-body">
        <b>Login Activity</b>
    </div>
    <div class="card-body">
    </div>
    <hr>
    <div class="row">
        <div class="col-3">
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>
        <div class="col-3">
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
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
    function formatDate(date) {
            let year = date.getFullYear();
            let month = ('0' + (date.getMonth() + 1)).slice(-2); // +1 karena bulan dimulai dari 0
            let day = ('0' + date.getDate()).slice(-2);
            return `${year}-${month}-${day}`;
    }
    function getDate(){
            let today = new Date();
            var startdate = document.getElementById('start_date');
            var enddate = document.getElementById('end_date');
            let defaultDate = today;
            let formattedDate = formatDate(defaultDate);
            startdate.value = formattedDate;
            enddate.value = formattedDate;
    }
    // Fungsi inisialisasi DataTables khusus untuk halaman ini
    function initDataTable() {
        if ($.fn.dataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().clear().destroy(); // Hancurkan DataTable yang sudah ada
        }
        var table = $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url() ?>/getactivity',
                type: 'GET',
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
            },
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
            ],
            order: [0, 'desc'],
        });
        setTimeout(function() {
            $('#start_date,#end_date').trigger('change');
        }, 100);
        $('#start_date,#end_date').change(function() {
            table.ajax.reload();
        });
    }

    // Panggil initDataTable saat halaman Products dimuat
    $(document).ready(function() {
        initDataTable();
        getDate();
    });
</script>
