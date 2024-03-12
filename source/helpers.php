<?php

session_start();
//проверка, есть ли ошибка в указаном поле
require_once __DIR__.'/config.php';
function hasValidationError(string $fieldName) : bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

//функция перенаправления
function redirect(string $path)
{
    header("Location: ../../$path ");
    die();
}
//функция для определения вывода формы на странице
function hasValidationAttr(string $fieldName)
{
    echo isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}
// функция вывода ошибки формы
function validationErrorMessage (string $fieldName)
{
    $message =  $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    echo $message;
}
// функция для формиования ошибки
function addValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}
// функция сохранения старых значений
 function addOldValue(string $key, mixed $value):void
 {
     $_SESSION['old'][$key] = $value;
 }
//фуннкция вывода старых значений
 function old(string $key)
 {
     return $_SESSION['old'][$key]?? '';
 }

function uploadFile(array $file, string $prefix=""): string
{
    $uploadsPath = __DIR__ . '/../uploads';


    if (!is_dir($uploadsPath)) {
        mkdir($uploadsPath, 077, true);
    }
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";


    if (!move_uploaded_file($file['tmp_name'], "$uploadsPath/$fileName")) {
        die('Ошибка загрузки файла');
    }
    return "uploads/$fileName";
}

function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function setMessage(string $key, string $message):void
{
    $_SESSION['message'][$key] = $message;
}

function getMessage(string $key):string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function hasMessage(string $key):bool
{
    return isset($_SESSION['message'][$key]);
}


function currentUser():array|false
{
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('index.php');
}
function checkAuth(): void{
    if (!isset($_SESSION['user']['id'])){
        redirect('');
    }
}

function checkGuest()
{
    if (isset($_SESSION['user']['id'])){
        redirect('/register/home.php');
    }
}