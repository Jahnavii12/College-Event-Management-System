<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest Admin Panel</title>
    <style>
        .bgImage {
            background-image: url(images/event.jpg);
            background-size: cover;
            background-position: center center;
            height: 600px;
            margin-bottom: 29px;
        }
    </style>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
<header class="bgImage">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand">TechFest Admin Panel</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="adminPage.php"><strong>Home</strong></a></li>
                <li><a href="Stu_details.php"><strong>Student Details</strong></a></li>
                <li><a href="Stu_cordinator.php"><strong>Student Co-ordinator</strong></a></li>
                <li><a href="Staff_coordinator.php"><strong>Staff-Co-ordinator</strong></a></li>
                <li><a href="admin_event_results.php"><strong>Results</strong></a></li>
                <li class="btnlogout"><a class="btn btn-default navbar-btn" href="index.php">Logout <span
                            class="glyphicon glyphicon-log-out"></span></a></li>
            </ul>
        </div>
    </nav>
    <!-- <div class="col-md-12">
        <div class="container">
            <div class="jumbotron">
                <h1>Welcome to TechFest Admin Panel</h1>
                <p>Manage various aspects of the TechFest here.</p>
            </div>
        </div>
    </div> -->
</header>
</body>
</html>
