<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $property_name = $_POST['property_name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO estate (user_id, property_name, location, price, status) VALUES ('$user_id', '$property_name', '$location', '$price', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="post">
    User ID: <input type="number" name="user_id" required><br>
    Property Name: <input type="text" name="property_name" required><br>
    Location: <input type="text" name="location" required><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    Status: 
    <select name="status">
        <option value="available">Available</option>
        <option value="sold">Sold</option>
        <option value="rented">Rented</option>
    </select><br>
    <input type="submit" value="Add Property">
</form>
