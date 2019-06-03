$(function(){

    $.get('dashboard/xhrGetListings', function(o){
    
        for(var i=0;i < o.length; i++){
            // let id2 = o[i].id;
                $('#listInsert').append('<div id="list_'+ o[i].id + '">' + o[i].text + '<a class="del" data-list-id="' + o[i].id + '" href="#">X</a>' + '</div>');
        }
            $('.del').click(function () {
                // delItem = $(this);
                var id = $(this).data('list-id');
                console.log('Removed item:' + id + ' from DOM.')
                $.post('dashboard/xhrDeleteListing', {'id': id}, function (o) {
                   // $('#listInsert').append('<div>' + o.text + '<a class="del" rel="' + o.id + '" href="#">X</a>' + '</div>');
                    $('#list_' + id).remove();

                }, 'json');
                return false;
            });

    }, 'json')
    
    // $('#listInserts');
    //data-
     
    $('#randomInsert').submit(function(){
        let url = $(this).attr('action') //this the value of the action attr from the form in views/dashboard/index.php
        let data = $(this).serialize();// he used var instead let
      
        $.post(url, data, function(o){
             $('#listInsert').append('<div>' + o.text + '<a class="del" data-list-id="' + o.id + '" href="#">X</a>' + '</div>');
        }, 'json');

        return false; //if it were true, it would refresh the page. We don't want that
    });
});