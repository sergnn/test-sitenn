$(function () {
    $('[name="city"]').kladr({
        token: '563a31060a69decd268b4591',
        type: $.kladr.type.city
    });

    $('[name="street"]').kladr({
        token: '563a31060a69decd268b4591',
        parentInput: '#regf',
        type: $.kladr.type.street
    });
    $('#regf').keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

