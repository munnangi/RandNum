/**
 * Created by munna on 8/2/2017.
 */
'use strict';
$(document).ready(function() {
    if($('#form_countguess').val() >=3) {
        checkValidate();
    }


    $('#start-again,#start-again1,#start-again2').on('click',function(){

        window.location.href ='/randnum/';
    });
});

function checkValidate()
{
    $('#btnGuess').prop('disabled', true);
}