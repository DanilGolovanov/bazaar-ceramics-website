<?php 
require_once('../../../private/initialize.php');

requireLogin();

logOutMember();

redirectTo(urlFor('/index.php'));
?>