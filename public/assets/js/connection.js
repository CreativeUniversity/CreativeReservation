/**
 * Created by Mhamdi. R on 22/01/2018.
 */
$( document ).ready(function() {

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("msg");

    if(c != null){
        $("#message-content").html(c);
        $("#message").show();

        setTimeout(function() {
            $("#message").fadeOut("slow");
        }, 4000);

    }


});



