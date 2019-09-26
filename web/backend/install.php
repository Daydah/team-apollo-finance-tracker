<?php
$servername = "localhost";
$username   = "root";
$password   = "";

$conn = new mysqli($servername, $username, $password);
// Check if connected
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE tracker";
if ($conn->query($sql) === true) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();
$conn = new mysqli($servername, $username, $password, "tracker");
// Check if connected
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//create the user table
$sql = "CREATE TABLE users (
`id` int(11) NOT NULL AUTO_INCREMENT,
        `fullname` varchar(128) NOT NULL,
        `password` varchar(128) NOT NULL,
        `email` varchar(128) NOT NULL,
        `time` varchar(128) NOT NULL,
        PRIMARY KEY (id)
)";
/*i intensionally used varchar as datatype of time so we save the return value of time() function by doing this we will be able to manipulate as needed

*/
if ($conn->query($sql) === true) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//create the expense table
$sql = "CREATE TABLE expense (
`id` int(11) NOT NULL AUTO_INCREMENT,
`userId` int(11) NOT NULL,
`time` varchar(128) NOT NULL,
`item` varchar(200)  NOT NULL,
`cost` DECIMAL(19,2)  NOT NULL,
`details` varchar(225),
PRIMARY KEY (id)
)";
if ($conn->query($sql) === true) {
    echo "Table expense created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "ALTER TABLE `expense` ADD FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
if ($conn->query($sql) === true) {
    echo "Tables altered successfully";
} else {
    echo "Error Altering table: " . $conn->error;
}

echo "All is set now";
$conn->close();