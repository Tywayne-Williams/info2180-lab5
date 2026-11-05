<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country name from the URL.
$country = $_GET['country'] ?? '';

// Prepare the SQL query.
$stmt = $conn->prepare("Select * From countries WHERE name LIKE :country");

// Ad  wildcard characters for partial searches.
$stmt->execute(['country' => '%' . $country . '%']);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li>
    <?= htmlspecialchars($row['name']) . ' is ruled by ' . htmlspecialchars($row['head_of_state'] ?? 'Unknown'); ?>
  </li>
<?php endforeach; ?>
</ul>
