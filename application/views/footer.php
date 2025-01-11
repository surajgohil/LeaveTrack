<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Example: Load leave balance dynamically
        const leaveBalance = 15; // Fetch this value from the backend
        $('#leaveBalance').text(leaveBalance);

        // Generate leave graph
        const ctx = document.getElementById('leaveGraph').getContext('2d');
        const leaveData = {
            labels: ['Total Leaves', 'Leaves Taken', 'Leaves Remaining'],
            datasets: [{
                data: [30, 15, leaveBalance], // Example data
                backgroundColor: ['#FFD700', '#F39C12', '#2C2C2C'],
                borderColor: ['#FFD700', '#F39C12', '#2C2C2C'],
            }]
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: leaveData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#FFD700'
                        }
                    }
                }
            }
        });
    });


    $(document).on('submit', '#leaveForm', function (e) {
        e.preventDefault();

        // Collect form data
        let form = new FormData(this);

        $.ajax({
            url: '<?= base_url("Leave/applyLeave") ?>', // Backend controller method
            type: 'POST',
            data: form,
            contentType: false, // Necessary for FormData
            processData: false, // Necessary for FormData
            dataType: 'json',
            success: function (response) {
                $('.displayError').remove(); // Clear previous error messages

                if (response.status === 3) {
                    // Display validation errors
                    $.each(response.data, function (key, value) {
                        $(`[name="${key}"]`).after(`<span class="displayError text-danger">${value}</span>`);
                    });
                }

                if (response.status === 1) {
                    // Handle success
                    alert(response.message);
                    $('#leaveForm')[0].reset(); // Reset the form
                    if (response.data.redirectUrl) {
                        window.location.href = response.data.redirectUrl; // Redirect if URL is provided
                    }
                }

                if (response.status === 2) {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Something went wrong. Please try again.');
            }
        });
    });
</script>
</body>
</html>