<?php 
$host = 'mariadb';
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$response = '';

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    $response = "Connection failed".mysqli_connect_error().PHP_EOL;
}
$response = "Successfully database connection";
?>

<html>
<body>
    <h1>"<?php echo $response; ?>"</h1>
</body>
</html>