<?php
session_start();
$_SESSION = []; // kosongkan dulu semua data session
session_destroy();

header("Location: ../index.php"); // sesuaikan path karena file ini ada di Controller/
exit;