<style>
    .calendar-container {
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    .calendar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .calendar-table th,
    .calendar-table td {
        border: 1px solid #ddd;
        width: 14.2%;
        height: 100px;
        vertical-align: top;
        position: relative;
    }

    .calendar-table td:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .booking {
        background-color: #007bff;
        color: white;
        font-size: 12px;
        padding: 5px;
        border-radius: 5px;
        display: block;
        margin-top: 5px;
    }

    .date-number {
        font-weight: bold;
        position: absolute;
        top: 5px;
        left: 5px;
    }

    .calendar-table th {
        height: 40px;
        /* Sesuaikan tinggi sesuai kebutuhan */
        padding: 5px;
        /* Mengurangi padding agar tidak terlalu tinggi */
        font-size: 14px;
        /* Sesuaikan ukuran font agar tetap terlihat proporsional */
    }

    .today {
        background-color: #ffeeba !important;
        /* Warna kuning muda */
        font-weight: bold;
    }
</style>
<section class="section">
    <div class="section-header">
        <h2 id="currentMonth"></h2>
    </div>
</section>
<button class="btn btn-secondary btn-sm" onclick="prevMonth()" style="float:left">❮ Sebelumnya</button>
<button class="btn btn-secondary btn-sm" onclick="nextMonth()" style="float:right">Berikutnya ❯</button>
<div class="calendar-container mt-4">
    <table class="calendar-table mt-3">
        <thead>
            <tr>
                <th>Minggu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
                <th>Sabtu</th>
            </tr>
        </thead>
        <tbody id="calendarBody">
            <!-- Kalender akan di-generate di sini -->
        </tbody>
    </table>
</div>

<!-- Modal Input Booking -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Daftar Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Sport</th>
                            <th>Session</th>
                            <th>Start</th>
                            <th>End</th>
                        </tr>
                    </thead>
                    <tbody id="bookingList">
                        <!-- Data booking akan dimuat di sini -->
                    </tbody>
                </table>

                <hr>
            </div>

        </div>
    </div>
</div>
<script>
    function initDataTable() {
        if ($.fn.dataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().clear().destroy(); // Hancurkan DataTable yang sudah ada
        }
    }

    function fetchBookings(month, year) {
        $.ajax({
            url: "<?= base_url() ?>/testbooking",
            method: "GET",
            data: { month: month + 1, year }, // Kirim parameter bulan dan tahun
            dataType: "json",
            success: function(response) {
                if (response.status === 200) {
                    // console.log(response.data);
                    bookings[`${year}-${month}`] = {}; // Reset data untuk bulan tertentu

                    response.data.forEach(booking => {
                        let date = booking.booking_date;
                        if (!bookings[`${year}-${month}`][date]) {
                            bookings[`${year}-${month}`][date] = [];
                        }
                        bookings[`${year}-${month}`][date].push({
                            title: booking.jenis,
                            time: booking.description,
                            session: booking.session,
                            start_time: booking.start_time,
                            end_time: booking.end_time,
                        });
                    });

                    generateCalendar(month, year);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching bookings:", error);
            }
        });
    }

    function generateCalendar(month, year) {
        const calendarBody = document.getElementById("calendarBody");
        const currentMonthText = document.getElementById("currentMonth");

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];
        currentMonthText.innerText = `${monthNames[month]} ${year}`;

        calendarBody.innerHTML = "";

        let firstDay = new Date(year, month, 1).getDay();
        let totalDays = new Date(year, month + 1, 0).getDate();

        let today = new Date();
        let todayDate = today.getDate();
        let todayMonth = today.getMonth();
        let todayYear = today.getFullYear();

        let date = 1;
        for (let i = 0; i < 6; i++) {
            let row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");

                if (i === 0 && j < firstDay) {
                    row.appendChild(cell);
                } else if (date > totalDays) {
                    break;
                } else {
                    let formattedMonth = (month + 1).toString().padStart(2, '0');
                    let formattedDate = date.toString().padStart(2, '0');
                    let cellDate = `${year}-${formattedMonth}-${formattedDate}`;

                    cell.innerHTML = `<span class="date-number">${date}</span>`;
                    cell.dataset.date = cellDate;
                    cell.onclick = function() {
                        openBookingModal(cellDate);
                    };

                    // Tandai tanggal hari ini
                    if (date === todayDate && month === todayMonth && year === todayYear) {
                        cell.classList.add("today");
                    }

                    // Tampilkan booking yang sudah ada
                    if (bookings[`${year}-${month}`] && bookings[`${year}-${month}`][cell.dataset.date]) {
                        cell.classList.add("booked"); // Tambahkan warna biru
                        bookings[`${year}-${month}`][cell.dataset.date].forEach(event => {
                            let eventDiv = document.createElement("div");
                            eventDiv.classList.add("booking");
                            eventDiv.innerText = `${event.time} - ${event.title}`;
                            cell.appendChild(eventDiv);
                        });
                    }

                    row.appendChild(cell);
                    date++;
                }
            }
            calendarBody.appendChild(row);
        }
    }

    function prevMonth() {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }

        // Cek apakah data bulan sudah ada di cache
        if (bookings[`${currentYear}-${currentMonth}`]) {
            generateCalendar(currentMonth, currentYear);
        } else {
            fetchBookings(currentMonth, currentYear); // Load data baru jika belum ada
        }
    }

    function nextMonth() {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }

        // Cek apakah data bulan sudah ada di cache
        if (bookings[`${currentYear}-${currentMonth}`]) {
            generateCalendar(currentMonth, currentYear);
        } else {
            fetchBookings(currentMonth, currentYear); // Load data baru jika belum ada
        }
    }

    function openBookingModal(date) {
        $("#selectedDate").val(date);

        let bookingList = $("#bookingList");
        bookingList.empty(); // Kosongkan tabel sebelum mengisi data baru

        // Ubah untuk menggunakan kunci kombinasi year dan month
        let [year, month, day] = date.split("-");
        let monthKey = parseInt(month) - 1;

        if (bookings[`${year}-${monthKey}`] && bookings[`${year}-${monthKey}`][date]) {
            bookings[`${year}-${monthKey}`][date].forEach(event => {
                bookingList.append(`
                    <tr>
                        <td>${event.time}</td>
                        <td>${event.title}</td>
                        <td>${event.session}</td>
                        <td>${event.start_time}</td>
                        <td>${event.end_time}</td>
                    </tr>
                `);
            });
        } else {
            bookingList.append(`<tr><td colspan="5" class="text-center">Belum ada booking</td></tr>`);
        }

        $("#bookingModal").modal("show");
    }



    $("#bookingForm").submit(function(event) {
        event.preventDefault();

        let date = $("#selectedDate").val();
        let title = $("#eventTitle").val();
        let time = $("#eventTime").val();

        if (!bookings[date]) bookings[date] = [];
        bookings[date].push({
            title,
            time
        });

        $("#bookingModal").modal("hide");
        generateCalendar(currentMonth, currentYear);
    });

    $(document).ready(function() {
        fetchBookings(currentMonth, currentYear);
        initDataTable();
    });
</script>
