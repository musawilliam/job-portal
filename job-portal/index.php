<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";
$sel = "SELECT * FROM users";
$query = mysqli_query($conn, $sel);
$resul = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Job Portal</title>
</head>
<body>
    <div class="container">
        <div class="button-group mb-3">
            <a href="index.php" class="btn btn-primary">Refresh Page</a>
            <button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>
        </div>

        <h1>Welcome, <?php echo htmlspecialchars($resul["full_name"]); ?> to the Job Portal</h1>
<br>
       
        <h2 class="mt-4">Click Statistics</h2>
        <canvas id="clickChart" width="250" height="100"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="script.js"></script>

         <script>
            const advertData = <?php echo json_encode($advert_list); ?>;
        </script>
        <div class="d-flex justify-content-center">
    <a href="export_csv.php" class="btn btn-primary">Export to CSV</a>
</div>
    </div>
</body>
</html>