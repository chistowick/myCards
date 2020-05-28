<?php

//FRONT CONTROLLER
session_start();

/*
 * General settings. Note: only for development period and if this 
 * is not configured by default in php.ini
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connecting the main view
define('ROOT', __DIR__);
include_once (ROOT . '/views/main_view.php');

// Authentication
if (isset($_POST['login'], $_POST['password'])
        AND ( !isset($_SESSION['access']) OR $_SESSION['access'] != 'allowed')) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    // Connecting a components
    require_once (ROOT . '/components/Database.php');
    require_once (ROOT . '/components/Authentication.php');

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
}

// If access is allowed
if (isset($_SESSION['access']) AND $_SESSION['access'] == "allowed") {

    if (isset($_SESSION['login'])) {
        $tablename = $_SESSION['login'];
    } else {
        exit('Не существует $_SESSION["login"]');
    }

    // Connecting a components
    require_once (ROOT . '/components/Database.php');
    require_once (ROOT . '/components/Librarian.php');

    // Create database handler
    $dbh = Database::getConnection();

    if (isset($_POST['action'])) {

        $librarian = new Librarian($dbh, $tablename);

        switch ($_POST['action']) {
            // If the JS client requests cards
            case 'getCards':

                // Getting cards from the database
                $cards = $librarian->getCards();

                // Converts the array to JSON and returns it to js-client
                echo json_encode($cards);

                break;

            case 'rewriteCard':

                // Rewriting a card in the database
                $librarian->rewriteCard($id);

                // Getting the updated card
                $updated_card = $librarian->getOneCard($id);

                // Converts the array to JSON and returns it to js-client
                echo json_encode($updated_card);

                break;

            case 'deleteCard':

                // Deleting a card from the database
                $number_of_deleted = $librarian->deleteCard($id);

                // Return status of delete completion to js-client
                echo $number_of_deleted;

                break;

            case 'addCard':

                if (!isset($_POST['original'], $_POST['translation'], $_POST['comment'], $_POST['stack'])) {
                    exit('Не заполнены поля карточки/пустой $_POST');
                }

                $original = $_POST['original'];
                $translation = $_POST['translation'];
                $comment = $_POST['comment'];
                $stack = $_POST['stack'];

                // Adding a card to database
                $librarian->addCard($original, $translation, $comment, $stack);

                // Getting the last card from database
                $last_card = $librarian->getLastCard();

                // Converts the array to JSON and returns it to js-client
                echo json_encode($last_card);

                break;

            default:
                break;
        }
    }
}