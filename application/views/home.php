<div id="home" class="container page" style="margin-top: 10%;">
     
    <div class="text-center mb-4">
        <h1 class="text-yellow">Welcome, <?= $this->session->userdata('employee_name') ?> !</h1>
        <p class="text-light">Your leave balance: <span id="leaveBalance" class="text-yellow">0</span></p>
    </div>
    <div class="container my-5">
    
        <div class="mb-5">
            <h4 class="text-yellow">Leave Usage Chart</h4>
            <canvas id="leaveChart"></canvas>
        </div>

        <div>
            <h4 class="text-yellow">Leave History</h4>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Number of Days</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody id="leaveHistory">

                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {

        $.ajax({
            url: '<?= base_url("Leave/getLeaveHistory") ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 1) {
                    const leaveHistoryData = response.data;

                    const historyTable = $('#leaveHistory');
                    leaveHistoryData.forEach((leave, index) => {
                        historyTable.append(`
                            <tr>
                                <td>${leave.leave_name}</td>
                                <td>${leave.from_date}</td>
                                <td>${leave.to_date}</td>
                                <td>${leave.number_of_day || 'N/A'}</td>
                                <td>${leave.comments || 'No comments'}</td>
                            </tr>
                        `);
                    });
                    $('#leaveBalance').html(response.data.length);
                } else {
                    alert(response.message || 'No leave history found.');
                }
            },
            error: function () {
                alert('An error occurred while fetching leave history.');
            }
        });

        function initializeChart(leaveData) {
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
        }

        $.ajax({
            url: '<?= base_url("Leave/leaveListing") ?>',
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 1) {
                    const leaveData = {
                        labels: response.data.labels,
                        datasets: [{
                            label: response.data.datasets.label,
                            data: response.data.datasets.data,
                            backgroundColor: response.data.datasets.backgroundColor,
                        }]
                    };

                    initializeChart(leaveData);
                } else {
                    alert('No leave data found.');
                }
            },
            error: function () {
                alert('An error occurred while fetching leave data.');
            }
        });
    });

</script>