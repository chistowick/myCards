"use strict";

// Set an event listener for each element. (selector, event, action)
window.onload = getCards();

// Request all cards from the table
function getCards() {

    let url = 'components/ajax/main_ajax_controller.php';
    let action = 'getCards';
    
    // Create POST request data
    let postData = new FormData();
    postData.append('action', action);

    // Create a connection
    let request = new XMLHttpRequest();
    
    // Request setting
    request.open('POST', url);
    request.responseType = 'json';

    // Sending request
    request.send(postData);

    // If connection error
    request.onerror = function () {
        alert(`Ошибка соединения`);
    };
    // When the server response will be received
    request.onload = function () {

        // Analysis of HTTP response status
        if (request.status != 200) {
            // Print error status and error description
            alert(`Ошибка ${request.status}: ${request.statusText}`);

        } else { // if all OK

            // Writing the result to a variable
            let responseObj = request.response;
            
            console.log(responseObj);

        }
    };

}
