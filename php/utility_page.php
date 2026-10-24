<?php
include 'db_connect.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$utility_name = "drill"; // This could be dynamic, e.g., passed via GET parameter
$query = "SELECT description, remaining_amount FROM tblutilities WHERE utility_name = ?";

// Prepare the statement and check for errors
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $utility_name);
$stmt->execute();
$result = $stmt->get_result();

$description = "Description not found.";
$remaining_amount = 0;

if ($row = $result->fetch_assoc()) {
    $description = $row['description'];
    $remaining_amount = $row['remaining_amount'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utility - Ladder</title>
    <link rel="stylesheet" href="../css/utility_page.css">
</head>
<body>
    <div class="container">
        <header>
            <button class="back-btn" onclick="window.location.href='../html/utilities_page.html'">←</button>
            <img src="../pictures/Group\ 12" alt="Logo" class="logo">
        </header>
        <main>
            <h1><?php echo htmlspecialchars($utility_name); ?></h1>
            <p><?php echo htmlspecialchars($description); ?></p>
            <div class="controls">
                <div class="quantity">
                    <span>QUANTITY</span>
                    <button class="decrement">-</button>
                    <span class="quantity-value">1</span>
                    <button class="increment">+</button>
                </div>
                <div class="availability">
                    <span>AVAILABLE</span>
                    <span class="remaining"><?php echo htmlspecialchars($remaining_amount); ?></span>
                </div>
            </div>
            <div class="actions">
                <button class="add-to-list">Add to list</button>
                <button class="proceed">Proceed</button>
            </div>
        </main>
    </div>
    <script src="../js/utility_page.js"></script>
</body>
</html>