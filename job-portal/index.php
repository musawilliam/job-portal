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


$wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
$username = 'parallel';
$password = 'parallel';

$soap_options = array(
    'exceptions' => true,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'soap_version' => SOAP_1_1,
    'trace' => 1,
);

try {
    
    $client = new SoapClient($wsdl, $soap_options);

    
    $session_id = $client->login($username, $password);

    
    $filter = array();

    
    $adverts = $client->getAdverts($session_id, $filter);

    
    if (isset($adverts[0]) && is_object($adverts[0])) {
        $advert_list = $adverts; 
    } else {
        $advert_list = []; 
    }

    
    $client->logout($session_id);

} catch (Exception $e) {
    echo "<div class='alert alert-danger mt-4'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    $advert_list = []; 
}
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .card {
            margin: 15px 0;
            padding: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
            width: 100%;
        }
        .card h2 {
            margin: 0 0 8px;
            font-size: 1.25em;
            color: #333;
            text-align: center;
        }
        .card p {
            margin: 4px 0;
            color: #030303;
        }
        .card .description {
            font-size: 0.9em;
            color: #030303;
            text-align: center; 
        }
        .card .button {
            margin-top: 8px;
            display: inline-block;
            padding: 8px 16px;
            background-color: #008529;
            color: #030303;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            width: 100%;
        }
        .card .button:hover {
            background-color: #008529;
        }
        .desc{
            text-align: center;
            font-weight: bold;
            padding-top: 8px;
            padding-bottom: 8px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="button-group mb-3">
            <a href="index.php" class="btn btn-primary">Refresh Page</a>
            <button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>
        </div>

        <h1>Welcome, <?php echo htmlspecialchars($resul["full_name"]); ?> to the Job Portal</h1>

        <h2 class="mt-4">Available Job Adverts</h2>

        <?php if (empty($advert_list)): ?>
            <p>No job adverts found.</p>
        <?php else: ?>
            <?php foreach ($advert_list as $advert): ?>
                <?php if (is_object($advert)): ?>
                    <div class="card">
                        <h2><?php echo htmlspecialchars($advert->job_title); ?> - <?php echo htmlspecialchars($advert->town); ?></h2>
                        <p><strong>Vacancy Ref:</strong> <?php echo htmlspecialchars($advert->vacancy_ref); ?></p>
                        <p><strong>Company:</strong> <?php echo htmlspecialchars($advert->company_ref); ?></p>
                        <p><strong>Region:</strong> <?php echo htmlspecialchars($advert->region); ?></p>
                        <p><strong>Sector:</strong> <?php echo htmlspecialchars($advert->sector); ?></p>
                        <p><strong>Salary:</strong> <?php echo ($advert->market_related ? "Market Related" : "Negotiable"); ?></p>
                        <p><strong>Posted by:</strong> <?php echo htmlspecialchars($advert->consultant_name); ?></p>
                        <p><strong>Start Date and End Date:</strong> <?php echo htmlspecialchars($advert->start_date); ?> - <?php echo htmlspecialchars($advert->expiry_date); ?></p>
                        <p ><strong>Brief Description:</strong> <?php echo ($advert->brief_description); ?></p>
                        <p><strong>Detail Description:</strong> <?php echo ($advert->detail_description); ?></p>
                        
                    </div>
                <?php else: ?>
                    <p class="text-danger">Invalid job advert data format.</p>
                <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>       

            
         <table id="jobTable" class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>Company Ref</th>
                    <th>Vacancy Reference</th>
                    <th>Job Title</th>
                    <th>Apply Link</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>

         
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