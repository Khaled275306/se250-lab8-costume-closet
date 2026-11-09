<?php
$conn = mysqli_connect("localhost", "root", "", "costume_closet");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>