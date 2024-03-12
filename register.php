<?php
require_once __DIR__.'/source/helpers.php';
checkGuest();
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/register.css">
    <link
            rel="stylesheet"
            href="pico-main/css/pico.min.css"
    />
    <link rel="stylesheet" href="src/register.css">
    <title>Document</title>
</head>
<body>
    <form class="card " action="source/actions/register.php" method="post" enctype="multipart/form-data">
        <fieldset class="grid">
            <label for="username">
                Username
                <input type="text" name="name" pattern="[a-zA-Z0-9]+"
                    value="<?php echo old('name')?>"
                    <?php hasValidationAttr('name');?>
                    >
                    <?php if (hasValidationError('name')):?>
                    <small><?php validationErrorMessage('name')?></small>
                    <?php endif; ?>
            </label>

            <label for="email">
                E-mail
                    <input type="email" name="email"
                           value="<?php echo old('email')?>"
                            <?php hasValidationAttr('email');?>
                        >
                    <?php if (hasValidationError('email')):?>
                        <small><?php validationErrorMessage('email')?></small>
                    <?php endif; ?>
            </label>
        </fieldset>
            <label for="avatar">
                Изображение профиля
                <input
                    type="file"
                    name="avatar"
                    <?php hasValidationAttr('avatar');?>
                >
                <?php if (hasValidationError('avatar')):?>
                    <small><?php validationErrorMessage('avatar')?></small>
                <?php endif; ?>
        </label>
        <fieldset class="grid">
            <label for="password">
                Password
                <input type= "password" name="password"
                    <?php hasValidationAttr('password');?>
                    >
                <?php if (hasValidationError('password')):?>
                    <small><?php validationErrorMessage('password')?></small>
                <?php endif; ?>
            </label>

            <label for="passwordConfirmation">
                Password confirmation
                <input type="password" name="passwordConfirmation">
            </label>
        </fieldset>

        <button type="submit" name="register" value="register">Register</button>
        <a href="index.php">У меня уже есть аккаунт</a>
    </form>
</body>
</html>