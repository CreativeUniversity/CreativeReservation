$(document).ready(function() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var Id = url.searchParams.get("id");
    //alert(id);
      $.get(
        "../../backend/Controllers/DemandController/getDemandDetail.php", {id:Id},function( data ) {
            $("#Did").html(data['id']);
           $("#Dtitle").html(data['title']);
            $("#Ddate").html(data['date']);
            $("#Ddescription").html(data['description']);
            $("#Dstartdate").html(data['start_date']);
            $("#Denddate").html(data['end_date']);
            $("#Drequirements").html(data['requirements']);

            if (data['file']==""){
              $("#Dfile").html("There is no file uploaded");
            }else{
              $("#Dfile").html("<a href=../assets/uploads/"+data['file']+" target='_blank'>"+data['file']+"</a>");
            }

            $("#Dstatus").html(data['status']);
            $("#Dcauses").html(data['causes']);
            
        });


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

    $("#represant").val(represant_connected);
    $("#represant_id_user").val(id_user_connected);


});