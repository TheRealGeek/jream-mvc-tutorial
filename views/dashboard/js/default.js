$(function(){

    $.get('dashboard/xhrGetListings', function(o){
    
        for(var i=0;i < o.length; i++){
            // let id2 = o[i].id; 
                $('#listInsert').append('<div id="list_' + o[i].id + '">' + '<a class="del" data-list-id="' + o[i].id + '" href="#">X</a>' + '&nbsp' + o[i].text + '</div>');
        }
            $('.del').live('click', function () { //this used to be "$('.del').click(,function () {", changed it to "$('.del').live('click',function () {" to make it apply to new items without having to refresh the page.
                // delItem = $(this);
                var id = $(this).data('list-id');
                console.log('Removed item: ' + id + ' from DOM.')
                $.post('dashboard/xhrDeleteListing', {'id': id}, function (o) {
                   // $('#listInsert').append('<div>' + o.text + '<a class="del" rel="' + o.id + '" href="#">X</a>' + '</div>');
                    $('#list_' + id).remove();

                }, 'json');
                return false;
            });

    }, 'json')
    
    // $('#listInserts');
     
    $('#randomInsert').submit(function(){
        let url = $(this).attr('action') //this the value of the action attr from the form in views/dashboard/index.php
        let data = $(this).serialize();// he used var instead let
      
        $.post(url, data, function(o){
             $('#listInsert').append('<div id="list_' + o.id + '">' + '<a class="del" data-list-id="' + o.id + '" href="#">X</a>' + o.text + '</div>');
        }, 'json');

        return false; //if it were true, it would refresh the page. We don't want that
    });
});