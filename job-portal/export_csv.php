<?php
require_once "database.php";


header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=advert_clicks.csv");
header("Pragma: no-cache");
header("Expires: 0");


$output = fopen("php://output", "w");


fputcsv($output, ["Vacancy Ref", "Date", "Clicks"]);


$query = "SELECT a.vacancy_ref, DATE(c.click_date) AS click_date, COUNT(c.id) AS clicks 
          FROM advert_clicks AS a 
          LEFT JOIN advert_clicks AS c ON a.vacancy_ref = c.vacancy_ref 
          GROUP BY a.vacancy_ref, DATE(c.click_date) 
          ORDER BY a.vacancy_ref, click_date 
          LIMIT 0, 25";

if ($result = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, [$row['vacancy_ref'], $row['click_date'], $row['clicks']]);
        }
    } else {
        
        fputcsv($output, ["No data available for the specified criteria."]);
    }
    mysqli_free_result($result);
} else {
    
    fputcsv($output, ["Error fetching data. Please check the table names and try again."]);
    error_log("Database query error: " . mysqli_error($conn));  
}


fclose($output);
exit();
