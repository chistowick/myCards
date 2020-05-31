<!DOCTYPE html>
<html>
    <head>
        <title>MyCards</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Styles and favicon-->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <!--    <link rel="shortcut icon" href="https://mrbooks.ru/favicon.png" type="image/png">-->
        <!--End Styles-->
    </head>
    <body>
        <div id="header">
            <?php
            if (isset($_SESSION['login'], $_SESSION['access'])
                    AND $_SESSION['access'] == 'allowed'):
                ?>
                <div id="authentication-allowed">
                    <p>Привет, <?= $_SESSION['login'] ?> </p>
                </div>
            <?php else : ?>
                <div id="authentication-denied">
                    <label for="login">login: </label>
                    <input type="text" id="login" name="login" 
                           placeholder="maxlength = 16" maxlength="16" >
                    <label for="login">password: </label>
                    <input type="password" id="password" name="password" 
                           placeholder="maxlength = 16" maxlength="16" >
                    <button class="sign-in" id="sign-in" type="button" value="Sign-in">
                        Sign-in</button>
                </div>  
            <?php endif; ?>
        </div>
        <div id="wrapper">
            <div id="leftArea">
                <div id="stack_1" class="cards"><p>stack_1</p></div>
                <div id="stack_2" class="cards"><p>stack_2</p></div>
                <div id="stack_3" class="cards"><p>stack_3</p></div>
            </div>
            <div id="rightArea">
                <div id="menuOptions">
                    <div id="search" class="top_menu">
                        <select id="search_select" size="1" name="word">
                            <option value="Карточка_1">Карточка_1</option>
                            <option value="Карточка_2">Карточка_2</option>
                            <option value="Карточка_3">Карточка_3</option>
                            <option value="Карточка_4">Карточка_4</option>
                        </select>
                    </div>
                    <div id="front_side" class="top_menu"><p>front side</p></div>
                    <div id="back_side" class="top_menu"><p>back side</p></div>
                    <div id="addCard" class="top_menu"><p>add</p></div>
                    <div id="rewriteCard" class="top_menu"><p>edit</p></div>
                    <div id="deleteCard" class="top_menu"><p>delete</p></div>
                </div>
                <div id="workArea">
                    <div id="active_card" class="cards"></div>
                </div>
            </div>
        </div>
        <div id="footer"><p id="copy">&copy; 2020 Анатолий Чиняев</p></div>

        <script src='js/getCards.js'></script>
    </body>
</html>
