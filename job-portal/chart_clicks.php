<?php
require_once "database.php";

$vacancy_ref = $_GET['vacancy_ref'] ?? '';

if (empty($vacancy_ref)) {
    echo json_encode(['error' => 'vacancy_ref parameter is missing']);
    exit;
}

$query = "SELECT DATE(click_date) AS date, COUNT(*) AS clicks FROM advert_clicks WHERE vacancy_ref = ? GROUP BY date";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['error' => 'Database statement preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("s", $vacancy_ref);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
