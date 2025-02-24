<?php
include 'connection.php';

$sql = "SELECT * FROM estate";
$result = $conn->query($sql);
?>

<a href="create.php">Add New Property</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Property Name</th>
        <th>Location</th>
        <th>Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['property_name'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="update.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
