<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        eReview Journal
    </title>
</head>

<body>
    <h1>Selamat Datang di eReview.</h1>
    <p>
        Silakan klik link
        <?php echo anchor('AccountCtl/login', 'Masuk'); ?>
        untuk masuk ke dalam sistem atau
        <?php echo anchor('AccountCtl/createaccount', 'Daftar'); ?>
        untuk mendaftar.
    </p>
</body>

</html>