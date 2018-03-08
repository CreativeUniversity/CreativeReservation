$( document ).ready(function() { 
    
    function details(id){
        window.location.href="DetailsUI.html?id="+id; 
    }


    $.get(
        "../../backend/Controllers/DemandController/getAllDemands.php", function( data ) {
            
        for(i=0;i<data.length;i++){
            
            var demand = data[i];
            
             if( demand['status'] == 'Not Answered'){
                 $('#notAnsweredDemands:last-child').append(
                    '<tr>'+
                    '<td>'+demand['id']+'</td>' +
                    '<td>'+demand['represant']+'</td>' +
                    '<td>'+demand['title']+'</td>' +
                    '<td>'+demand['date']+'</td>' +
                    '<td>'+
                    '<button type="button" class="btn  btn-info btn-sm details_btn" data-id="'+demand['id']+'">Details</button>'+
                    '</td>' +
                    '</tr>'
                 );
                 
                 
             }else if ( demand['status'] == 'Accepted'){
                 $('#answeredDemands:last-child').append(
                     '<tr>' +
                    '<td>'+demand['id']+'</td>' +
                     '<td>'+demand['represant']+'</td>' +
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
            else {
                $('#answeredDemands:last-child').append(
                     '<tr>' +
                    '<td>'+demand['id']+'</td>' +
                     '<td>'+demand['represant']+'</td>' +
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