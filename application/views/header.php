<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .text-yellow {
            color: #FFD700;
        }

        .bg-dark {
            background-color: #2C2C2C;
        }

        .navbar {
            background-color: #333;
        }

        .card {
            background-color: #333;
            border-radius: 10px;
        }

        .btn-warning {
            background-color: #FFD700;
            border-color: #FFD700;
            color: #2C2C2C;
        }
    </style>
</head>
<body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black position-fixed w-100" style="top: 0;">
        <a class="navbar-brand text-yellow" href="#">LeaveTrack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="home" id="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="applyLeave" id="applyLeave">Apply Leave</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-yellow" href="logout" id="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>