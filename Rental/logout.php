<?php
include 'partials/_dbconnect.php';
include 'partials/navbar.php';

session_start();
session_unset();
session_destroy();

header('loaction:login.php');

?>











<?php
include 'partials/footer.php';
?>