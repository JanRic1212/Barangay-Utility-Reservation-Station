<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $reservation_date = $_POST['reservation_date'];
    $duration = $_POST['duration'];

    // Handle document upload
    $document_name = $_FILES['documents']['name'];
    $document_tmp = $_FILES['documents']['tmp_name'];
    $upload_path = 'uploads/' . basename($document_name);

    if (move_uploaded_file($document_tmp, $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO tbl_reservation (full_name, address, contact_number, email_address, documents, reservation_date, duration) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $full_name, $address, $contact_number, $email_address, $document_name, $reservation_date, $duration);

        if ($stmt->execute()) {
            echo "<script>alert('Reservation submitted successfully!');</script>";
        } else {
            echo "<script>alert('Database error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('File upload failed!');</script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Utility Reservation</title>
    <link rel="stylesheet" href="../css/Reservation_Form.css">
</head>
<body>
    <form class="container" action="Reservation_Form.php" method="POST" enctype="multipart/form-data">
        <img src="../pictures/banner.png" alt="Banner" style="width: 100%; border-radius: 20px;">
        
        <div class="title-box">
            <h2>UTILITY RESERVATION</h2>
            <p>Reserve your utilities now!</p>
        </div>

        <label>Last name, First name :</label>
        <input type="text" name="full_name" required>

        <label>Address :</label>
        <input type="text" name="address" required>

        <label>Contact Number :</label>
        <input type="text" name="contact_number" required>

        <label>Email :</label>
        <input type="email" name="email_address" required>

        <label>Date of Reservation :</label>
        <input type="date" name="reservation_date" required>

        <label>Duration of Reservation (days):</label>
        <input type="number" name="duration" required>

        <label>Attach your documents here :</label>
        <input type="file" name="documents" required>

        <div class="terms">
            <h3>Terms and Conditions</h3>
            <p>
                By reserving utility services within Barangay Punta Princesa, customers agree to abide by the terms set forth...
            </p>
            <input type="checkbox" required> Yes, I agree
            <input type="checkbox"> No, I decline
        </div>

        <div class="buttons">
            <button type="submit">SUBMIT</button>
            <button type="reset">RETURN</button>
        </div>
    </form>
</body>
</html>
