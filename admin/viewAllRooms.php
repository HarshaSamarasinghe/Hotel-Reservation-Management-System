<?php
require '../config.php';
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Adults</th><th>Children</th><th>Count</th><th>Price</th><th>Available</th><th>Image</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['roomID']}</td>
        <td>{$row['roomName']}</td>
        <td>{$row['adultsCapacity']}</td>
        <td>{$row['childrenCapacity']}</td>
        <td>{$row['roomCount']}</td>
        <td>{$row['rPricePerDay']}</td>
        <td>" . ($row['isAvailable'] ? 'Yes' : 'No') . "</td>
        <td><img src='uploads/{$row['roomImage']}' width='100'></td>
        <td>
            <form action='deleteRoom.php' method='post' style='display:inline'>
                <input type='hidden' name='roomID' value='{$row['roomID']}'>
                <input type='submit' value='Delete'>
            </form>
        </td>
    </tr>";
}
echo "</table>";
?>
