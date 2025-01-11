<div class="container my-5">
    <h2 class="text-yellow text-center mb-4">Dashboard</h2>

    <!-- Leave Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-black text-yellow">
                <div class="card-body text-center">
                    <h5>Total Leaves</h5>
                    <h3 id="totalLeaves">30</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-black text-yellow">
                <div class="card-body text-center">
                    <h5>Leaves Taken</h5>
                    <h3 id="leavesTaken">12</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-black text-yellow">
                <div class="card-body text-center">
                    <h5>Remaining Balance</h5>
                    <h3 id="remainingBalance">18</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Holidays -->
    <div class="mb-4">
        <h4 class="text-yellow">Upcoming Holidays</h4>
        <ul class="list-group bg-black" id="upcomingHolidays">
            <li class="list-group-item bg-black text-yellow">New Year - January 1</li>
            <li class="list-group-item bg-black text-yellow">Republic Day - January 26</li>
            <li class="list-group-item bg-black text-yellow">Independence Day - August 15</li>
        </ul>
    </div>

    <!-- Recent Leave Requests -->
    <div>
        <h4 class="text-yellow">Recent Leave Requests</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Leave Type</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="recentLeaveRequests">
                <!-- Example Rows -->
                <tr>
                    <td>1</td>
                    <td>Sick Leave</td>
                    <td>2024-12-15</td>
                    <td>2024-12-16</td>
                    <td>Approved</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Casual Leave</td>
                    <td>2024-11-20</td>
                    <td>2024-11-21</td>
                    <td>Pending</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Example data
        const leaveSummary = {
            totalLeaves: 30,
            leavesTaken: 12,
            remainingBalance: 18
        };

        // Populate leave summary
        $('#totalLeaves').text(leaveSummary.totalLeaves);
        $('#leavesTaken').text(leaveSummary.leavesTaken);
        $('#remainingBalance').text(leaveSummary.remainingBalance);

        // Example: Fetch recent leave requests dynamically
        // Replace this with an AJAX call to fetch data from the backend
        const recentRequests = [
            { id: 1, type: 'Sick Leave', from: '2024-12-15', to: '2024-12-16', status: 'Approved' },
            { id: 2, type: 'Casual Leave', from: '2024-11-20', to: '2024-11-21', status: 'Pending' }
        ];

        const recentLeaveTable = $('#recentLeaveRequests');
        recentRequests.forEach(request => {
            recentLeaveTable.append(`
                <tr>
                    <td>${request.id}</td>
                    <td>${request.type}</td>
                    <td>${request.from}</td>
                    <td>${request.to}</td>
                    <td>${request.status}</td>
                </tr>
            `);
        });

        // Populate upcoming holidays dynamically if needed
        // Example: Replace static list with backend data
    });
</script>