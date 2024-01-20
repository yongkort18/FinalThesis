<?php
require 'code_login.php';


session_unset();
session_destroy();
header("Location: index.php");
?>