<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
		body {
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .text-yellow {
            color: #FFD700;
        }
        .bg-dark {
            background-color: #2C2C2C;
        }
        .btn-warning {
            background-color: #FFD700;
            border-color: #FFD700;
            color: #2C2C2C;
        }
        .card {
            background-color: #333;
            border-radius: 10px;
        }
        input, select, textarea {
            border-radius: 5px;
        }
	</style>
</head>
<body class="bg-dark text-light">
    <!-- Login Page -->
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-4">
                <div class="card p-4">
                    <h3 class="text-center pb-3">Sign In</h3>
                    <form id="signInForm">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="identifier" name="identifier" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">Login</button>
                        </br>
                        <div class="d-flex justify-content-center align-items-center">Redirect to <a class="text-yellow ml-1" href="signUp" id="logout">Sign Up</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#signInForm').on('submit', function(e){
                e.preventDefault();

                let form = new FormData(this);

                $.ajax({
                    url  : '<?= base_url("UserAuthentication/signIn") ?>',
                    type : 'POST',
                    data : form,
                    contentType : false,
                    processData : false,
                    dataType : 'json',
                    success : function(response) {
                        if(response.status === 3) {
                            $('.displayError').remove();
                            $.each(response.data, function(key, value) {
                                $(`[name="${key}"]`).after(`<span class="displayError text-danger">${value}</span>`);
                            });
                        }
                        if(response.status === 1) {
                            $('#signInForm')[0].reset();
                            window.location.href = response.data.redirectUrl;
                        }
                    }
                });
            });
        });

    </script>
</body>
</html>
