<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signUpContainer{
            width: 50%;
            background: #2C2C2C;
            padding: 30px;
            margin: 6% 0%;
            border-radius: 10px;
        }

        .text-yellow {
            color: #FFD700; /* Yellow */
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

        .form-group label {
            color:rgb(255, 255, 255);
        }

        input, select, textarea {
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-dark text-light">
    <div class="signUpContainer">
        <h2 class="text-center my-4">Employee Registration</h2>
        <form id="signUpForm">
            <!-- Employee Code -->
            <div class="form-group">
                <label for="employee_code">Employee Code</label>
                <input type="text" class="form-control" id="employee_code" name="employee_code" placeholder="Enter Employee Code" required>
            </div>

            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Choose a Username" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address"></textarea>
            </div>

            <!-- Country -->
            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country" required>
                    <!-- Populated dynamically using jQuery and AJAX -->
                </select>
            </div>

            <!-- State -->
            <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state" required>
                    <option value="">Select Country First</option>
                </select>
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="">Select State First</option>
                </select>
            </div>

            <!-- ZIP Code -->
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter ZIP Code" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-warning btn-block">Sign Up</button>
            </br>
            <div class="d-flex justify-content-center align-items-center">Have an account? <a class="text-yellow ml-1" href="signIn" id="logout">Sign In</a></div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {

            // Start : fetch Countries, state, city by API
            function fetchCountries() {
                $.ajax({
                    url: 'https://countriesnow.space/api/v0.1/countries/positions',
                    type: 'GET',
                    success: function (response) {
                        let countries = response.data;
                        let options = '<option value="">Select Country</option>';
                        countries.forEach(function (country) {
                            options += `<option value="${country.name}">${country.name}</option>`;
                        });
                        $('#country').html(options);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching countries:', error);
                        alert('Failed to fetch countries.');
                    }
                });
            }

            function fetchStates(country) {
                $.ajax({
                    url: 'https://countriesnow.space/api/v0.1/countries/states',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ country: country }),
                    success: function (response) {
                        let states = response.data.states;
                        let options = '<option value="">Select State</option>';
                        states.forEach(function (state) {
                            options += `<option value="${state.name}">${state.name}</option>`;
                        });
                        $('#state').html(options);
                        $('#city').html('<option value="">Select State First</option>');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching states:', error);
                        alert('Failed to fetch states.');
                    }
                });
            }

            function fetchCities(country, state) {
                $.ajax({
                    url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ country: country, state: state }),
                    success: function (response) {
                        let cities = response.data;
                        let options = '<option value="">Select City</option>';
                        cities.forEach(function (city) {
                            options += `<option value="${city}">${city}</option>`;
                        });
                        $('#city').html(options);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching cities:', error);
                        alert('Failed to fetch cities.');
                    }
                });
            }

            $('#country').on('change', function () {
                let selectedCountry = $(this).val();
                if (selectedCountry) {
                    fetchStates(selectedCountry);
                } else {
                    $('#state').html('<option value="">Select Country First</option>');
                    $('#city').html('<option value="">Select State First</option>');
                }
            });

            $('#state').on('change', function () {
                let selectedState = $(this).val();
                let selectedCountry = $('#country').val();
                if (selectedState && selectedCountry) {
                    fetchCities(selectedCountry, selectedState);
                } else {
                    $('#city').html('<option value="">Select State First</option>');
                }
            });

            fetchCountries();
            // End : fetch Countries, state, city by API


            $('#signUpForm').on('submit', function(e){
                e.preventDefault();

                let form = new FormData(this);

                $.ajax({
                    url  : '<?= base_url("UserAuthentication/signUp") ?>',
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
                            $('#signUpForm')[0].reset();
                            window.location.href = response.data.redirectUrl;
                        }
                    }
                });
            });
        });
    </script>
    
</body>
</html>
