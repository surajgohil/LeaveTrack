<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <a class="navbar-brand text-yellow" href="dashboard.html">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="dashboard.html">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="apply_leave.html">Apply Leave</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="leave_reports.html">Leave Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-yellow text-center mb-4">Admin Panel</h2>

        <!-- Manage Leave Types -->
        <div class="mb-4">
            <h4 class="text-yellow">Manage Leave Types</h4>
            <div class="d-flex">
                <input type="text" id="leaveTypeInput" class="form-control" placeholder="Add Leave Type">
                <button class="btn btn-yellow ml-2" id="addLeaveType">Add</button>
            </div>
            <ul class="list-group mt-3 bg-black" id="leaveTypeList">
                <li class="list-group-item bg-black text-yellow">Sick Leave</li>
                <li class="list-group-item bg-black text-yellow">Casual Leave</li>
                <li class="list-group-item bg-black text-yellow">Annual Leave</li>
            </ul>
        </div>

        <!-- Manage Holidays -->
        <div class="mb-4">
            <h4 class="text-yellow">Manage Holidays</h4>
            <div class="d-flex">
                <input type="text" id="holidayNameInput" class="form-control" placeholder="Holiday Name">
                <input type="date" id="holidayDateInput" class="form-control ml-2">
                <button class="btn btn-yellow ml-2" id="addHoliday">Add</button>
            </div>
            <ul class="list-group mt-3 bg-black" id="holidayList">
                <li class="list-group-item bg-black text-yellow">New Year - January 1</li>
                <li class="list-group-item bg-black text-yellow">Republic Day - January 26</li>
            </ul>
        </div>

        <!-- View Employee Records -->
        <div class="mb-4">
            <h4 class="text-yellow">View Employee Records</h4>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Employee Code</th>
                        <th>Leave Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="employeeRecords">
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>EMP001</td>
                        <td>18</td>
                        <td><button class="btn btn-sm btn-yellow">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>EMP002</td>
                        <td>12</td>
                        <td><button class="btn btn-sm btn-yellow">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add Leave Type
            $('#addLeaveType').click(function () {
                const leaveType = $('#leaveTypeInput').val().trim();
                if (leaveType) {
                    $('#leaveTypeList').append(`<li class="list-group-item bg-black text-yellow">${leaveType}</li>`);
                    $('#leaveTypeInput').val('');
                }
            });

            // Add Holiday
            $('#addHoliday').click(function () {
                const holidayName = $('#holidayNameInput').val().trim();
                const holidayDate = $('#holidayDateInput').val().trim();
                if (holidayName && holidayDate) {
                    $('#holidayList').append(`<li class="list-group-item bg-black text-yellow">${holidayName} - ${holidayDate}</li>`);
                    $('#holidayNameInput').val('');
                    $('#holidayDateInput').val('');
                }
            });

            // Example: View employee records dynamically (AJAX can replace this example)
            const employeeData = [
                { id: 1, name: 'John Doe', code: 'EMP001', balance: 18 },
                { id: 2, name: 'Jane Smith', code: 'EMP002', balance: 12 },
            ];

            const employeeTable = $('#employeeRecords');
            employeeData.forEach(employee => {
                employeeTable.append(`
                    <tr>
                        <td>${employee.id}</td>
                        <td>${employee.name}</td>
                        <td>${employee.code}</td>
                        <td>${employee.balance}</td>
                        <td><button class="btn btn-sm btn-yellow">View</button></td>
                    </tr>
                `);
            });
        });
    </script>
</body>
</html>
