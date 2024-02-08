<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Month Dates</title>
    
</head>
<body>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            align-items: center;
        }
        .booked-date {
            cursor: pointer;
            background-image: url('../images/assets/indicators/rg.png'); /* Replace with the path to your background image */
            background-size: 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        .booked-date:hover {
            background-color:rgba(0, 0, 0, 0.63);
            color: white; /* Darker Red on hover */
        }

        .booking-info {
            margin-top: 10px;
            color: white;
        }
       
    </style>
    <div class="navigation-buttons">
        <button id="prev-month">PREVIOUS</button>
        <h2 id="month-year">Month Dates</h2>
        <button id="next-month">NEXT</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>SUN</th>
                <th>MON</th>
                <th>TUE</th>
                <th>WED</th>
                <th>THU</th>
                <th>FRI</th>
                <th>SAT</th>
            </tr>
        </thead>
        <tbody id="calendar-body">
        </tbody>
    </table>

    <div id="display-booking" class="booking-info">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarBody = document.getElementById('calendar-body');
            const monthYearHeader = document.getElementById('month-year');
            const prevMonthButton = document.getElementById('prev-month');
            const nextMonthButton = document.getElementById('next-month');
            const displayBooking = document.getElementById('display-booking');

            const today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();
            const monthNames = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];

            function updateCalendar() {
                monthYearHeader.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
                const startingDay = firstDayOfMonth.getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                let date = 1 - startingDay;

                calendarBody.innerHTML = ''; 

                for (let week = 0; week < 6; week++) {
                    const row = document.createElement('tr');

                    for (let day = 0; day < 7; day++) {
                        const cell = document.createElement('td');

                        if (date > 0 && date <= daysInMonth) {
                            cell.textContent = date;
                            cell.dataset.date = formatDate(currentYear, currentMonth + 1, date);

                            fetchBookings(cell);

                            cell.addEventListener('click', function () {
                                displayBookingInfo(cell.dataset.date);
                            });
                        }

                        row.appendChild(cell);
                        date++;
                    }

                    calendarBody.appendChild(row);
                }
            }

            function fetchBookings(cell) {
            const cellDate = new Date(cell.dataset.date);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (cellDate >= today) {
                const apiUrl = `../php/fetch_bookings.php?date=${cell.dataset.date}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(bookings => {
                        if (bookings.length > 0) {
                            cell.classList.add('booked-date');
                            const hasMaritalBooking = bookings.some(booking => booking.reason === 'marital');
                            const hasLastRites = bookings.some(booking => booking.reason === 'lastrites');
                            const hasOther = bookings.some(booking => booking.reason === 'other');
                        }
                    })
                    .catch(error => console.error('Error fetching bookings:', error));
            }
        }


            function displayBookingInfo(selectedDate) {
            const selectedDateObj = new Date(selectedDate);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0

            if (selectedDateObj >= today) {
                const apiUrl = `../php/fetch_bookings.php?date=${selectedDate}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(bookings => {
                        const bookingInfoHTML = bookings.map(booking => {
                            let reasonText;

                            if (booking.reason === 'marital') {
                                reasonText = 'ಮದುವೆ/ಆರತಕ್ಷತೆ/ನಿಶ್ಚಿತಾರ್ಥ';
                            } else if (booking.reason === 'lastrites') {
                                reasonText = 'ಉತ್ತರಕ್ರಿಯೆ';
                            } else {
                                reasonText = 'ಇತರ';
                            }

                            return `<p id='displaydetails'><strong>${booking.bookingName}</strong> - ${reasonText} → ${booking.bookingFromTime} - ${booking.bookingToTime}</p>`;
                        }).join('');

                        displayBooking.innerHTML = bookingInfoHTML;
                    })
                    .catch(error => console.error('Error fetching bookings:', error));
            } else {
                // Clear booking info for past dates
                displayBooking.innerHTML = '';
            }
        }



        function formatDate(year, month, day) {
            return `${year}-${formatNumber(month)}-${formatNumber(day)}`;
        }

        function formatNumber(number) {
            return number < 10 ? `0${number}` : number;
        }

        updateCalendar();

        prevMonthButton.addEventListener('click', function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            updateCalendar();
        });

        nextMonthButton.addEventListener('click', function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendar();
        });
    });
    </script>

</body>
</html>
