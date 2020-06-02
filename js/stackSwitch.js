"use strict";

$(document).ready(function () {
    $('.stack_switch').click(function () {

        let id = $(this).attr('id');

        if (id === 'stack_1') {

            activeStack = stack[1];
            $('#active_stack').css({'background-color': "red"});
            $('#stack_1').css({'background-color': "lightgray"});
            $('#stack_2').css({'background-color': "yellow"});
            $('#stack_3').css({'background-color': "darkgreen"});

        } else if (id === 'stack_2') {
            
            activeStack = stack[2];
            $('#active_stack').css({'background-color': "yellow"});
            $('#stack_1').css({'background-color': "red"});
            $('#stack_2').css({'background-color': "lightgray"});
            $('#stack_3').css({'background-color': "darkgreen"});
            
        } else {
            
            activeStack = stack[3];
            $('#active_stack').css({'background-color': "darkgreen"});
            $('#stack_1').css({'background-color': "red"});
            $('#stack_2').css({'background-color': "yellow"});
            $('#stack_3').css({'background-color': "lightgray"});
            
        }
//        console.log(activeStack);

    });
});
