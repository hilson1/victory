<?php
include 'connection.php';

// Create (Insert)
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    
    // Image Upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO lands (name, image, description, location, price) 
            VALUES ('$name', '$image', '$description', '$location', '$price')";
    mysqli_query($conn, $sql);
}

// Read (Fetch Data)
$result = mysqli_query($conn, "SELECT * FROM lands");

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM lands WHERE id=$id");
    header("Location: land.php");
}

// Update (Fetch data for update)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $record = mysqli_query($conn, "SELECT * FROM lands WHERE id=$id");
    $data = mysqli_fetch_array($record);
}

// Update (Submit Changes)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image_query = ", image='$image'";
    } else {
        $image_query = "";
    }

    $sql = "UPDATE lands SET name='$name', description='$description', location='$location', price='$price' $image_query WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: land.php");
}
?>
<button id="closeBtn" style="position: absolute; top: 20px; right: 20px; padding: 10px 15px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Close</button>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>land Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">

<h2 class="text-center mb-4">LANDS</h2>

<!-- Add / Update Form -->
<form method="POST" enctype="multipart/form-data" class="border p-4 shadow-sm bg-light rounded">
    <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
    
    <div class="mb-3">
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" required value="<?= isset($data['name']) ? $data['name'] : '' ?>">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Image:</label>
        <input type="file" name="image" class="form-control" <?= isset($data['id']) ? '' : 'required' ?>>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea name="description" class="form-control" required><?= isset($data['description']) ? $data['description'] : '' ?></textarea>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Location:</label>
        <input type="text" name="location" class="form-control" required value="<?= isset($data['location']) ? $data['location'] : '' ?>">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Price:</label>
        <input type="number" step="0.01" name="price" class="form-control" required value="<?= isset($data['price']) ? $data['price'] : '' ?>">
    </div>
    
    <button type="submit" name="<?= isset($data['id']) ? 'update' : 'add' ?>" class="btn btn-primary">
        <?= isset($data['id']) ? 'Update' : 'Add' ?>
    </button>
</form>

<!-- Data Display Table -->
<table class="table table-bordered table-striped mt-4">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Location</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><img src="uploads/<?= $row['image'] ?>" class="img-thumbnail" width="100"></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['location'] ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td>
                <a href="land.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="land.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<script>
        document.getElementById("closeBtn").addEventListener("click", function() {
            window.location.href = "admin.php";
        });
    </script>
</body>
</html>