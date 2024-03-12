<?php
require_once __DIR__.'/source/helpers.php';
checkGuest();
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
    <form action="source/actions/login.php" method="post">
        <?php if(hasMessage('error')): ?>
            <div class="notice error"><?php echo getMessage('error') ?></div>
        <?php endif; ?>
        <label>
            Email
            <input
                type="text"
                name="email"
                value="<?php echo old('email')?>"
                <?php hasValidationAttr('email');?>
            >
            <?php if (hasValidationError('email')):?>
                <small><?php validationErrorMessage('email')?></small>
            <?php endif; ?>
        </label>
        <label>
            Password
            <input
                    type= "password"
                    name="password"

            >

        </label>
        <button type="submit" name="Login">Login</button>
        <a href="register.php">У меня нет аккаунта</a>
    </form>
</body>
</html>