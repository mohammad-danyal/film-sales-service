<?php

session_start();

// Current user session is closed.
session_destroy();

echo "<script>window.open('index.php','_self')</script>";

?>