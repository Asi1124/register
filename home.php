<?php
require_once __DIR__.'/source/helpers.php';
checkAuth();
$user = currentUser();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="pico-main/css/pico.min.css"
    />
    <link rel="stylesheet" href="src/register.css">
    <title>Document</title>
</head>
<body>
<div class="card home">
    <img
        class="avatar"
        src="<?php echo $user['avatar'] ?>"
        alt="<?php echo $user['name'] ?>"
    >
    <h1>Привет, <?php echo $user['name'] ?>!</h1>
    <form action="source/actions/logout.php" method="post">
        <button role="button">Выйти из аккаунта</button>
    </form>
</div>
</body>
</html>