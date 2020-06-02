"use strict";

// По клику на активном стеке
$(document).ready(function () {
    $('#active_stack').click(function showActiveCard() {

    // Добавляем к существующему номеру текущего элемента массива активных 
    // карточек единицу, таким образом определяем номер новой карточки
    curentNumberActiveCard = curentNumberActiveCard + 1;

    // Если номер достиг величины массива, пререходим к началу массива - 
    // т.е. к первой карточке
    if (!(curentNumberActiveCard < activeCardsArray.length))
    {
        curentNumberActiveCard = 0;
    }

    let k = curentNumberActiveCard;

    // Задаем переменные, ссылающиеся на соответствующие данные в объектах-карточках
    let original = activeCardsArray[k].original;
    let translation = activeCardsArray[k].translation;
    let comment = activeCardsArray[k].comment;

    // Очищаем данные предыдущей карточки
    document.querySelector('#original').innerHTML = ``;
    document.querySelector('#translation').innerHTML = ``;
    document.querySelector('#comment').innerHTML = ``;

    // Выводим данные новой карточки
    document.querySelector('#original').insertAdjacentHTML("afterBegin", original);
    document.querySelector('#translation').insertAdjacentHTML("afterBegin", translation);
    document.querySelector('#comment').insertAdjacentHTML("afterBegin", comment);

});
});