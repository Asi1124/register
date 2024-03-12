<?php
// подключение функций-хелперов
require_once __DIR__.'/../helpers.php';


//вынос данных из формы в переменные

$name = $_POST['name']?? null;
$email = $_POST['email']?? null;
$password = $_POST['password']?? null;
$passwordConfirmation = $_POST['passwordConfirmation'] ?? null;
$avatar = $_FILES['avatar'] ?? null;

//
$avatarPath = null;

//добавляем значения из формы в массив old, чтобы вывести их в формы в случае, если валидация не пройдена
addOldValue('name',$name);
addOldValue('email',$email);

// validation
//проверка поля имени на пустоту
if(empty($name)){
    addValidationError('name','Неверное имя');
}
//фильтрация email по константе,
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    addValidationError('email','Неверный email');
}
// проверка пароля
if(empty($password)){
    addValidationError('password','Пароль пустой');
}
// проверка совпадения паролей
if($password !== $passwordConfirmation){
    addValidationError('password','Пароли не совпадаю');
}

if (!empty($avatar)){
    $types = ['image/jpeg','image/png'];

    if (!in_array($avatar['type'], $types)){
       addValidationError('avatar', 'Изображение профиля имеет неверный формат');
    }

    if (($avatar['size']/1000000)>= 1){
        addValidationError('avatar', 'Должно быть меньше 1мб');
    }
}


// проверка прохождения валидации и перенаправления страницы
if (!empty($_SESSION['validation'])){
    redirect('register.php');
}


if (!empty($avatar)){
    $avatarPath = uploadFile($avatar, 'avatar');
}

$pdo = getPDO();

$query = "INSERT INTO users (name, email, avatar, password) VALUES (:name, :email, :avatar, :password)";

$params = [
    'name' => $name,
    'email' => $email,
    'avatar' => $avatarPath,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('');