<?php require_once 'function.php'; ?>
<?php if (isset($_SESSION['login']) && isset($_SESSION['admin'])) : ?>
		<script>window.location='order.php'</script>
<?php endif ?> 
<?php 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi,"SELECT * FROM admin WHERE username = '$username'");

    if (mysqli_num_rows($data) > 0) {
        $hasil = mysqli_fetch_assoc($data);

        if (password_verify($password, $hasil['password'])) {
            $_SESSION['admin'] = $username;
            $_SESSION['login'] = true; ?>
                <script>window.location="order.php";</script>
        <?php 
        }
        else {?>
            <script>alert("Password Salah")</script>
        <?php 
        }
    }
    else{?>
        <script>alert("Username dan Password Salah")</script>
    <?php 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Kilat</title>
    <link rel="stylesheet" href="./style.css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="navbar flex justify-center items-center h-screen">
    <div class="box-login flex flex-row border w-3/4 h-4/5 rounded-3xl bg-white">
        <div class="login-form flex flex-col justify-center items-center h-full w-1/2 px-5">
            <h3 class="text-xl font-medium mb-3">Login</h3>
            <form action="" method="post" class="flex flex-col w-full px-11">
                <input required class="border-b-4 h-10 py-6 px-4 mb-4 focus:outline-none" placeholder="Username" type="text" name="username" id="username">
                <input required class="border-b-4 h-10 py-6 px-4 focus:outline-none" type="password" placeholder="Password" name="password" id="password">
                <button type="submit" name="login" class="btn-login mt-6 border mb-20 py-2 rounded-lg bg-orange-300 text-white hover:bg-orange-500">Login</button>
            </form>
        </div>
        <div class="login-img flex justify-center items-center h-full w-1/2">
            <img src="./img/laundry.png" alt="laundry" class="object-cover h-full rounded-e-3xl">
        </div>
    </div>
</body>
</html>