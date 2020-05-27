<?php

//FRONT CONTROLLER

/*
 * General settings. Note: only for development period and if this 
 * is not configured by default in php.ini
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Authentication
if (isset($_POST['login'], $_POST['password'])) {

    $login =    $_POST['login'];
    $password = $_POST['password'];

    // Connecting a components
    define('ROOT', __DIR__);
    require_once (ROOT . '/components/Database.php');
    require_once (ROOT . '/components/Authentication.php');
    
    // Create database handler
    $dbh = Database::getConnection();

    // Run login and password authentication
    $access = Authentication::check($dbh, $login, $password);

    // Return access status to js-client
    echo $access;
    
    // The end
    exit();
}