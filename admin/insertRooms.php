<?php
require '../config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomNumber = $_POST['roomNumber'];
    $roomType = $_POST['roomType'] ;
    $roomDescription = $_POST['roomDescription'];
    $roomBedType = $_POST['roomBedType'];
    $roomSize = $_POST['roomSize'];
    $floorNumber = $_POST['floorNumber'];
    $adultsCapacity = $_POST['adultsCapacity'];
    $childrenCapacity = $_POST['childrenCapacity'];
    $rPricePerDay = $_POST['rPricePerDay'];
    $isAvailable = isset($_POST['isAvailable']) ? 1 : 0;
    $features = isset($_POST['features']) ? $_POST['features'] : [];

    $targetDir = "../uploads/";
    $imageName = basename($_FILES["roomImage"]["name"]);
    $targetFile = $targetDir . $imageName;

    if (move_uploaded_file($_FILES["roomImage"]["tmp_name"], $targetFile)) {
        // Insert room into `rooms` table
        $stmt = $conn->prepare("INSERT INTO rooms (roomNumber, roomType, roomDescription, adultsCapacity, childrenCapacity,
         roomBedType, roomSize, floorNumber, rPricePerDay, isAvailable, roomImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiisiidis", $roomNumber, $roomType, $roomDescription, $adultsCapacity, $childrenCapacity,
         $roomBedType, $roomSize, $floorNumber, $rPricePerDay, $isAvailable, $imageName);
        
        if ($stmt->execute()) {
            $room_id = $stmt->insert_id;

            // Insert selected features into `room_feature_map`
            foreach ($features as $feature_id) {
                $conn->query("INSERT INTO room_feature_map (roomID, featureID) VALUES ($room_id, $feature_id)");
            }

            echo "Room and features inserted successfully.";
        } else {
            echo "DB Error: " . $stmt->error;
        }
    } else {
        echo "Image upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>


<form action="insertRooms.php" method="POST" enctype="multipart/form-data">
  <h2>Add New Room</h2>

  <label>Room Number:</label>
  <input type="text" name="roomNumber" required><br>

  <label>Room Type:</label>
  <input type="text" name="roomType" required><br>

  <label>Description:</label>
  <textarea name="roomDescription" required></textarea><br>

  <label>Bed Type:</label>
  <input type="text" name="roomBedType" required><br>

  <label>Room Size (e.g., 300sqft):</label>
  <input type="text" name="roomSize" required><br>

  <label>Floor Number:</label>
  <input type="number" name="floorNumber" required><br>

  <label>Adults Capacity:</label>
  <input type="number" name="adultsCapacity" required><br>

  <label>Children Capacity:</label>
  <input type="number" name="childrenCapacity" required><br>

  <label>Price per Day (LKR):</label>
  <input type="number" step="0.01" name="rPricePerDay" required><br>

  <label>Is Available:</label>
  <input type="checkbox" name="isAvailable"><br>

  <h3>Select Features:</h3>
        <?php
        // Show all features dynamically from DB
        $result = $conn->query("SELECT * FROM room_features");
        while ($row = $result->fetch_assoc()) {
            echo '<label><input type="checkbox" name="features[]" value="' . $row['featureID'] . '"> ' . $row['fName'] . '</label><br>';
        }
        ?>
  <!-- Add more features as needed -->

  <label>Room Image:</label>
  <input type="file" name="roomImage" accept="image/*" required><br><br>

  <button type="submit">Add Room</button>
</form>

    <div class="admin-navigation">
        <a href="viewAllRooms.php">View All Rooms</a>
        <a href="insertRooms.php">Insert Room</a>
        <a href="deleteRooms.php">Delete Room</a>
        <a href="updateRooms.php">Update Room</a>
    </div>
    
</body>
</html>

