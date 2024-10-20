<?php
require "connect.php";

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-5 mb-5 mx-4'>";
        echo "<div class='card overflow-hidden hover-img'>";
        echo "<div class='position-relative'>";

        echo "<img src='" . $row['photo'] . "' class='card-img-top' alt='" . $row['event_name'] . "' style='height: 350px; object-fit: cover;'>";

        echo "<div class='position-absolute top-0 start-0 bg-dark rounded-bottom text-white p-1' style='font-weight: bold; font-size: 1rem;'>";
        echo "" . ucfirst($row['status']);  // Capitalize first letter
        echo "</div>";

        echo "</div>";
        echo "<div class='card-body p-4'>";
        echo "<div class='d-flex align-items-center gap-4'>";

        echo "<div class='d-flex align-items-center gap-2'>";
        echo "<h2 class='fw-bold' style='font-size: 1.5rem; text-transform: uppercase;'>" . $row['event_name'] . "</h2>";
        echo "</div>";

        $dateTime = new DateTime($row['date_time']);
        $formattedDateTime = $dateTime->format('Y-m-d / H:i'); 
        
        echo "<div class='d-flex align-items-center fs-2 ms-auto'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-calendar-event'>";
        echo "<path stroke='none' d='M0 0h24v24H0z' fill='none'/>";
        echo "<path d='M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z' />";
        echo "<path d='M16 3l0 4' />";
        echo "<path d='M8 3l0 4' />";
        echo "<path d='M4 11l16 0' />";
        echo "<path d='M8 15h2v2h-2z' />";
        echo "</svg> " . $formattedDateTime . " WIB"; 
        echo "</div>";
        echo "</div>"; 

        
        echo "<p>";
        echo "<span class='short-desc' id='short-desc-" . $row['id_events'] . "'>";
        echo substr($row['description'], 0, 100); // Display first 100 characters
        echo (strlen($row['description']) > 100) ? "..." : "";
        echo "</span>";
        echo "<span class='full-desc' id='full-desc-" . $row['id_events'] . "' style='display: none;'>";
        echo $row['description'];
        echo "</span>";
        echo "<button class='btn text-primary p-0' onclick='toggleDescription(" . $row['id_events'] . ")' id='toggle-btn-" . $row['id_events'] . "'>";
        echo (strlen($row['description']) > 100) ? "Read More" : "";
        echo "</button>";
        echo "</p>"; 

        echo "<div class='d-flex align-items-center gap-4'>";
        echo "<div class='d-flex align-items-center gap-2'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-map-pin'>";
        echo "<path stroke='none' d='M0 0h24v24H0z' fill='none'/>";
        echo "<path d='M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0' />";
        echo "<path d='M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z' />";
        echo "</svg>" . $row['location'];
        echo "</div>";

        echo "<div class='d-flex align-items-center fs-2 ms-auto'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-user'>";
        echo "<path stroke='none' d='M0 0h24v24H0z' fill='none'/>";
        echo "<path d='M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0' />";
        echo "<path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' />";
        echo "</svg>" . $row['max_capacity'];
        echo "</div>";
        echo "</div>";

        echo "</div>"; 
        echo "</div>"; 
        echo "</div>"; 
    }
} else {
    echo "<p class='text-center'>No events found.</p>";
}

$conn->close();
?>

<script>
function toggleDescription(id) {
    const shortDesc = document.getElementById('short-desc-' + id);
    const fullDesc = document.getElementById('full-desc-' + id);
    const toggleBtn = document.getElementById('toggle-btn-' + id);

    if (fullDesc.style.display === 'none') {
        fullDesc.style.display = 'inline';
        shortDesc.style.display = 'none';
        toggleBtn.textContent = 'Read Less';
    } else {
        fullDesc.style.display = 'none';
        shortDesc.style.display = 'inline';
        toggleBtn.textContent = 'Read More';
    }
}
</script>
