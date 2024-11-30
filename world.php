<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
  // echo "check country";
  $country = htmlspecialchars($_GET['country']);
  // echo $country;

  if (isset($_GET['lookup'])) {

    try {

      // echo "rached here";
      // Prepare the SQL statement with a placeholder for the country name
      $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
      // Use '%' wildcards for partial matching, and bind the country name to the placeholder
      $country = "%$country%";
      // echo $country;
      $stmt->bindParam(':country', $country, PDO::PARAM_STR);
      // Execute the prepared statement
      $stmt->execute();
      // Fetch the results
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // if (empty($results)) {
      //   echo "No results found for the given country.";
      // } else {
      //   print_r($results); // Debug: Print the results
      // }
    } catch (PDOException $e) {
      echo "SQL Error: " . $e->getMessage();
    }


    // echo "after sql";
    // echo $results;


    echo '<table>
  <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </tr>';
    foreach ($results as $row) {
      echo '<tr>
      <td>' . $row['name'] . '</td>
      <td>' . $row['district'] . '</td>
      <td>' . $row['population'] . '</td>
    </tr>';
    }
    echo '</table>';

    exit();
  }

  // Prepare the SQL statement with a placeholder for the country name
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  // Use '%' wildcards for partial matching, and bind the country name to the placeholder
  $country = "%$country%";
  $stmt->bindParam(':country', $country, PDO::PARAM_STR);
  // Execute the prepared statement
  $stmt->execute();
  // Fetch the results
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  // If 'country' GET variable is not set, select all countries
  $stmt = $conn->query("SELECT * FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<table>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>



<!-- <ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul> -->