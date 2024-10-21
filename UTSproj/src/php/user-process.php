<?php
if (!isset($_SESSION['user_id'])) {
    die('Please log in first.');
}

$user_id = $_SESSION['user_id'];
require "connect.php";

if (!isset($conn)) {
    die("Database connection failed.");
}

$sql = "SELECT u.user_id, u.username, u.email, e.event_name
        FROM users u 
        LEFT JOIN events e ON u.id_events = e.id_events 
        WHERE u.role = 'user'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';

        $event_name = !empty($row['event_name']) ? htmlspecialchars($row['event_name']) : 'No event registered';
        echo '<td>' . $event_name . '</td>'; 

        echo "<td>";
        echo "<a class='btn btn-danger btn-sm rounded-3' data-bs-toggle='modal' data-bs-target='#deleteUserModal' data-user-id='" . htmlspecialchars($row['user_id']) . "'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icon-tabler-trash'>";
        echo "<path stroke='none' d='M0 0h24v24H0z' fill='none'/>";
        echo "<path d='M4 7l16 0' />";
        echo "<path d='M10 11l0 6' />";
        echo "<path d='M14 11l0 6' />";
        echo "<path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' />";
        echo "<path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' />";
        echo "</svg></a>";
        echo "</td>";
        
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4" class="text-center">No users found.</td></tr>';
}

$stmt->close();
$conn->close();
?>
