<?php
// open connection
$conn = mysqli_connect("localhost", "root", "", "project6");
if (!$conn) {
	die('cannot connecto to server');
}
