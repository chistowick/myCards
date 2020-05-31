<?php

session_start();

/*
 * General settings. Note: only for development period and if this 
 * is not configured by default in php.ini
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', __DIR__);

// Authentication
if (isset($_POST['login'], $_POST['password'])
        AND ( !isset($_SESSION['access']) OR $_SESSION['access'] != 'allowed')) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    // Connecting a components
    require_once (ROOT . '../Database.php');
    require_once (ROOT . '../Authentication.php');

    // Create database handler
    $dbh = Database::getConnection();

    // Run login and password authentication
    $access = Authentication::check($dbh, $login, $password);

    // Set value $_SESSION['login'] and value $_SESSION['access']
    $_SESSION['login'] = $login;
    $_SESSION['access'] = $access;

    // Return access status to js-client
    echo $access;

    // The end
    exit();
} else {
    $_SESSION['access'] = 'denied';
    return FALSE;
}