<?php
$servername = "localhost";
$username = "root";
$password = "lolno"; // change to your db password
$dbname = "steam"; // change to your db name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully <br />";

// Select all from table users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "User Email: " . $row["email"]. " - Password: " . $row["pass"]. "<br>";
    }
} else {
    echo "0 results";
}

// Select all from table games
$sql = "SELECT * FROM games";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "App ID: " . $row["appID"]. " - Game Title: " . $row["title"] . " - Genre: " . $row["genre"] . "<br>";
    }
} else {
    echo "0 results <br />";
}

/*******
// Prepared insert into table users
// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (email, pass) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $pass);

// set parameters and execute
$email = "john@example.com";
$pass = "mynameisjohndoe";
$stmt->execute();

$email = "mary@example.com";
$pass = "mynameismarymoe";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
********/

/*******
// Prepared insert into games users
// prepare and bind
$stmt = $conn->prepare("INSERT INTO games (appID, title, genre) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $appID, $title, $genre);

// set parameters and execute
$appID = 570;
$title = "Dota 2";
$genre = "Strategy";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
********/

$conn->close();
?>