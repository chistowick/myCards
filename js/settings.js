"use strict";

// На кнопки id="front_side_activation и id="back_side_activation навешиваем обработчик
$(document).ready(function () {
    $('.set_active_side').click(function () {

        // Определяем идентификатор переключателя, по которому был клик
        let id = $(this).attr('id');
        
        // Устанавливаем значения переменных, определяющих 
        // какая сторона карточки считается активной
        if (id == 'front_side_activation') {
            
            activeSideId = '#original_side';
            inactiveSideId = '#translation_side';
            
            $('#original_side').css({'display' : 'block'});
            $('#translation_side').css({'display' : 'none'});
            
            $('#front_side_activation').css({'background-color': '#29de29'});
            $('#back_side_activation').css({'background-color': 'lightgray'});
        } else {
            activeSideId = '#translation_side';
            inactiveSideId = '#original_side';
            
            $('#original_side').css({'display' : 'none'});
            $('#translation_side').css({'display' : 'block'});
            
            $('#front_side_activation').css({'background-color': 'lightgray'});
            $('#back_side_activation').css({'background-color': '#29de29'});
        }
    });
});