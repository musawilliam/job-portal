<?php
require_once "database.php";

// Set headers to force download as CSV
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=advert_clicks.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Open output stream for CSV
$output = fopen("php://output", "w");

// Add column headers to CSV file
fputcsv($output, ["Vacancy Ref", "Date", "Clicks"]);

// Prepare the SQL query to get vacancy references, dates, and click counts
$query = "SELECT a.vacancy_ref, DATE(c.click_date) AS click_date, COUNT(c.id) AS clicks 
          FROM advert_clicks AS a 
          LEFT JOIN advert_clicks AS c ON a.vacancy_ref = c.vacancy_ref 
          GROUP BY a.vacancy_ref, DATE(c.click_date) 
          ORDER BY a.vacancy_ref, click_date 
          LIMIT 0, 25";

if ($result = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($result) > 0) {
        // Fetch and output each row of data as CSV
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, [$row['vacancy_ref'], $row['click_date'], $row['clicks']]);
        }
    } else {
        // Output a row with "No data available" if no rows were returned
        fputcsv($output, ["No data available for the specified criteria."]);
    }
    mysqli_free_result($result);
} else {
    // Output an error message if the query fails
    fputcsv($output, ["Error fetching data. Please check the table names and try again."]);
    error_log("Database query error: " . mysqli_error($conn));  // Log query error
}

// Close the file handle and terminate the script
fclose($output);
exit();
