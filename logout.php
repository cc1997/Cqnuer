<?php
session_start();
unset($_SESSION["logined"]);
echo "<script>window.location.href = 'index.html'; </script>";
?>
