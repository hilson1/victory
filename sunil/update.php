<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM estate WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_name = $_POST['property_name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "UPDATE estate SET property_name='$property_name', location='$location', price='$price', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<form method="post">
    Property Name: <input type="text" name="property_name" value="<?= $row['property_name'] ?>" required><br>
    Location: <input type="text" name="location" value="<?= $row['location'] ?>" required><br>
    Price: <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required><br>
    Status:
    <select name="status">
        <option value="available" <?= $row['status'] == 'available' ? 'selected' : '' ?>>Available</option>
        <option value="sold" <?= $row['status'] == 'sold' ? 'selected' : '' ?>>Sold</option>
        <option value="rented" <?= $row['status'] == 'rented' ? 'selected' : '' ?>>Rented</option>
    </select><br>
    <input type="submit" value="Update Property">
</form>
