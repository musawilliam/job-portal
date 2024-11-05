<?php
session_start();
require_once "database.php";

if (isset($_SESSION["user"]) && !empty($_GET['vacancy_ref'])) {
    $user_id = $_SESSION["user"];
    $vacancy_ref = htmlspecialchars(trim($_GET['vacancy_ref']));  // Sanitize vacancy_ref input

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO advert_clicks (user_id, vacancy_ref ) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("is", $user_id, $vacancy_ref);
        if ($stmt->execute()) {
            // Redirect to the actual application URL
            header("Location: https://webapp.placementpartner.com/wi/application_form.php?id=parallel&vacancy_ref=" . urlencode($vacancy_ref) . "&source=assessment");
            exit();
        } else {
            error_log("Database error: " . $stmt->error);  // Log error details for troubleshooting
            echo "An error occurred while recording your click. Please try again later.";
        }
        $stmt->close();
    } else {
        error_log("Prepared statement error: " . $conn->error);  // Log error details for troubleshooting
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Invalid session or missing vacancy reference.";
}
exit();
