/**
 * Created by Mhamdi. R on 22/01/2018.
 */
$( document ).ready(function() {

    $(".tableusers").hide();

    $.post( "../../backend/Common/getUserConnected.php", function( data ) {
        $( "#greeting" ).html( "Hello "+data['name'] );
    });


    $( "#getusers" ).click(function() {
        $("#getusers").hide();

        $.post( "../../backend/Controllers/UserController/getUsersAction.php", function( data ) {
            for(i=0 ; i<data.length; i++){
                var user= data[i];
                $('#tableContent:last-child').append(
                    '<tr>' +
                    '<td>'+user['id']+'</td>' +
                    '<td>'+user['firstname']+'</td>' +
                    '<td>'+user['lastname']+'</td>' +
                    '<td>'+user['login']+'</td>' +
                    '</tr>'
                );
            }

        });

        $(".tableusers").show();

    });

});



