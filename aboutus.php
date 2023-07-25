<?php
    require 'function.php';
    require_once 'loginconfirm.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Kilat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css/style.css">
</head>
<body>
    <?php require './head/navbar.php'; ?>
    <div class="content just flex">
        <div class="image h-full w-1/2 flex justify-center items-center">
            <img src="./img/aboutus.jpg" alt="aboutus">
        </div>
        <div class="desc flex flex-col justify-center items-start h-full w-1/2 px-10">
            <h4 class="title-about-us text-4xl font-bold py-5 ">About Us</h4>
            <h5 class="pr-14 text-justify text-xl mb-5">Selamat datang di Kilat Laundry! Kami adalah penyedia layanan laundry cepat dan berkualitas untuk memenuhi kebutuhan mencuci dan merawat pakaian Anda.</h5>
            <div class="box flex justify-start items-center w-full my-2">
            <a href="./order.php" class="btn-back text-white flex justify-center items-center w-fit px-10 h-10 border rounded-xl">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>