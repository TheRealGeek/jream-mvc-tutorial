$(function(){
    $('#randomInsert').submit(function(){
        let url = $(this).attr('action') //this the value of the action attr from the form in views/dashboard/index.php
        let data = $(this).serialize();// he used var instead let
        // console.log(data); this works
        $.post(url, data, function(o){
            alert(2);
        })

        return false; //if it were true, it would refresh the page. We don't want that
    });
});