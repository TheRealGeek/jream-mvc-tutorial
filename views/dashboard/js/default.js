$(function(){

    $.get('dashboard/xhrGetListings', function(o){
    
        for(let i=0;i < o.length; i++){
                $('#listInsert').append('<div>' + o[i].text + '<a class="del" rel="' + o[i].id + '" href="#">X</a>' + '</div>');
        }
            $('.del').click(function () {
                let id = $(this).attr('rel');
                console.log(id);
                return false;
            });

    }, 'json')
    
    // $('#listInserts');
    
    $('#randomInsert').submit(function(){

        let url = $(this).attr('action') //this the value of the action attr from the form in views/dashboard/index.php
        let data = $(this).serialize();// he used var instead let
      
        $.post(url, data, function(o){
             $('#listInsert').append('<div>' + o.text + '<a class="del" rel="'+ o.id + '" href="#">X</a>' + '</div>');
        }, 'json');

        return false; //if it were true, it would refresh the page. We don't want that
    });
});