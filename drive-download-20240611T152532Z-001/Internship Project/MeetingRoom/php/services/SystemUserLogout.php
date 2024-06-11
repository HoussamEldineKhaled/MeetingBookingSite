<?php
session_start();
$_SESSION = array();
session_destroy();
$response = array("message" => "Logout successful");
echo json_encode($response);
?>
