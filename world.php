<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check whether the user requested cities.
if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities'){

// Retrieve the user and their country information.
$stmt = $conn->query("SELECT cities.name, cities.district, cities.population From cities 
INNER JOIN countries On cities.country_code = countries.code ORDER BY cities.name");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
  <thead>
    <tr>
      <th>City Name</th>
      <th>District</th>
      <th>Population</th>
</thead>
<tbody>
  <?php foreach ($results as $row): ?>
  <tr>
  <td><?= htmlspecialchars($row['name']);?></td>
  <td><?= htmlspecialchars($row['district']);?></td>
  <td><?= htmlspecialchars((string)$row['population']);?></td>
  </tr>
  <?php endforeach;?>
</tbody>
</table>
<?php
exit;

}

// Otherwise perform the the country lookup.

$country = $_GET['country'] ?? '';

// Prepare the SQL query.
$stmt = $conn->prepare("Select * From countries WHERE name LIKE :country");

// Ad  wildcard characters for partial searches.
$stmt->execute(['country' => '%' . $country . '%']);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
    <tr>
      <th>Country Name</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
</tr>
</thead>
<tbody>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']); ?></td>
      <td><?= htmlspecialchars($row['continent']); ?></td>
      <td><?= htmlspecialchars((string)($row['independence_year'] ?? 'N/A')); ?></td>
      <td><?= htmlspecialchars($row['head_of_state'] ?? 'Unknown'); ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
  </table>



