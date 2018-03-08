$( document ).ready(function() { 

    function details(id){
        window.location.href="DetailsRepresantUI.html?id="+id;
    }


    var id_user_connected = '';
    $.ajax({
        type: 'POST',
        async: false,
        url: "../../backend/Common/getUserConnected.php",
        data: "",
        success: function(data) {
            id_user_connected = data.id;
        }
    });

    var represant_connected = '';
    $.ajax({
        type: 'POST',
        async: false,
        url: "../../backend/Controllers/UserController/getRepresantById.php",
        data: {id : id_user_connected},
        success: function(data) {
            represant_connected = data;
        }
    });


    $("#clubDemands").html(represant_connected+' Demands');
    $("#represant").val(represant_connected);
    $("#represant_id_user").val(id_user_connected);

    $.post("../../backend/Controllers/DemandController/getRepresantDemands.php", {rep : represant_connected, id:id_user_connected} ,function( data ) {
            
        for(i=0;i<data.length;i++){
            
            var demand = data[i];
            
             if( demand['status'] == 'Not Answered'){
                 $('#notanswredDemands:last-child').append(
                    '<tr>'+
                    '<td>'+demand['id']+'</td>' +
                    '<td>'+demand['title']+'</td>' +
                    '<td>'+demand['date']+'</td>' +
                    '<td>'+
                    '<button type="button" class="btn  btn-info btn-sm details_btn" data-id="'+demand['id']+'">Details</button>'+
                    '</td>' +
                    '</tr>'
                 );
                 
                 
             }else if ( demand['status'] == 'Accepted'){
                 $('#answredDemands:last-child').append(
                     '<tr>' +
                    '<td>'+demand['id']+'</td>' +
                    '<td>'+demand['title']+'</td>' +
                    '<td>'+demand['date']+'</td>' +
                     '<td>'+demand['status']+'</td>' +
                    '<td>'+
                      '<button type="button" class="btn  btn-info btn-sm details_btn" data-id="'+demand['id']+'">Details</button>'+
                     '<button type="button" class="btn btn-sm data-id="'+demand['id']+'">Print</button>'+
                     '</td>'+
                     '<tr>'
                 );
             }
            else{
                $('#answredDemands:last-child').append(
                     '<tr>' +
                    '<td>'+demand['id']+'</td>' +
                    '<td>'+demand['title']+'</td>' +
                    '<td>'+demand['date']+'</td>' +
                     '<td>'+demand['status']+'</td>' +
                    '<td>'+
                    '<button type="button" class="btn  btn-info btn-sm details_btn" data-id="'+demand['id']+'">Details</button>'+
                     '</td>'+
                     '<tr>'
                 );
                
            }
        }
            $(".details_btn").on("click", function(){
            details($(this).data("id"));
        });

    
    });


});