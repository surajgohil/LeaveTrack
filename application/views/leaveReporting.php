<div class="container my-5">
    <!-- Leave Balance Summary -->
    <div class="mb-5">
        <h4 class="text-yellow">Leave Summary</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Total Leaves</th>
                    <th>Leaves Taken</th>
                    <th>Remaining Balance</th>
                </tr>
            </thead>
            <tbody id="leaveSummary">
                <!-- Example Rows -->
                <tr>
                    <td>Sick Leave</td>
                    <td>10</td>
                    <td>4</td>
                    <td>6</td>
                </tr>
                <tr>
                    <td>Casual Leave</td>
                    <td>8</td>
                    <td>2</td>
                    <td>6</td>
                </tr>
                <tr>
                    <td>Annual Leave</td>
                    <td>12</td>
                    <td>5</td>
                    <td>7</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Graph Section -->
    <div class="mb-5">
        <h4 class="text-yellow">Leave Usage Chart</h4>
        <canvas id="leaveChart"></canvas>
    </div>

    <!-- Leave History -->
    <div>
        <h4 class="text-yellow">Leave History</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Leave Type</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Number of Days</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody id="leaveHistory">
                <!-- Example Rows -->
                <tr>
                    <td>1</td>
                    <td>Sick Leave</td>
                    <td>2024-12-01</td>
                    <td>2024-12-02</td>
                    <td>2</td>
                    <td>Medical appointment</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Casual Leave</td>
                    <td>2024-11-20</td>
                    <td>2024-11-21</td>
                    <td>2</td>
                    <td>Family event</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Example data for graph
        const leaveData = {
            labels: ['Sick Leave', 'Casual Leave', 'Annual Leave'],
            datasets: [{
                label: 'Leaves Taken',
                data: [4, 2, 5], // Example: Replace with dynamic data
                backgroundColor: ['#FFD700', '#F39C12', '#2C2C2C'],
            }]
        };

        const ctx = document.getElementById('leaveChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: leaveData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#FFD700'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#FFD700'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#FFD700'
                        }
                    }
                }
            }
        });

        // Example: Populate leave history table dynamically
        // Replace this with an AJAX call to fetch data from the backend
        const leaveHistoryData = [
            { id: 1, type: 'Sick Leave', from: '2024-12-01', to: '2024-12-02', days: 2, comments: 'Medical appointment' },
            { id: 2, type: 'Casual Leave', from: '2024-11-20', to: '2024-11-21', days: 2, comments: 'Family event' }
        ];

        const historyTable = $('#leaveHistory');
        leaveHistoryData.forEach((leave, index) => {
            historyTable.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${leave.type}</td>
                    <td>${leave.from}</td>
                    <td>${leave.to}</td>
                    <td>${leave.days}</td>
                    <td>${leave.comments}</td>
                </tr>
            `);
        });
    });
</script>