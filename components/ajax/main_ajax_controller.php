<?php

session_start();

$_SESSION['access'] = "allowed"; // Временно!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$_SESSION['login'] = "chistowick"; // Временно!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

/*
 * General settings. Note: only for development period and if this 
 * is not configured by default in php.ini
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// If access is allowed
if (isset($_SESSION['access']) AND $_SESSION['access'] == "allowed") {

    // Connecting a components
    require_once ('../Database.php');
    require_once ('../Librarian.php');
    
    $tablename = "dictionary";

    // Create database handler
    $dbh = Database::getConnection();

    if (isset($_POST['action'])) {

        $librarian = new Librarian($dbh, $tablename);

        switch ($_POST['action']) {
            // If the JS client requests cards
            case 'getCards':

                // Getting cards from the database
//                $cards = $librarian->getCards();
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
} else {
    $_SESSION['access'] = 'denied';
    return FALSE;
}