$(document).ready(function() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var Id = url.searchParams.get("id");
    //alert(id);


    $.get(
        "../../backend/Controllers/DemandController/getDemandDetail.php", {id:Id},function( data ) {
            if(data['status'] == 'Not Answered'){
                $("#FormSubmitButtons").show();
            }
            $("#Did").val(data['id']);
            $("#Dtitle").val(data['title']);
            $("#Ddate").val(data['date']);
            $("#Ddescription").html(data['description']);

            var startDate = data['start_date'].split(" ");

            $("#eventStartDate").val(startDate[0]);
            $("#eventStartTime").val(startDate[1]);

            var endDate = data['end_date'].split(" ");
            $("#eventEndDate").val(endDate[0]);
            $("#eventEndTime").val(endDate[1]);

            $("#Drequirements").html(data['requirements']);

            if (data['file']==""){
                $("#Dfile").html("There is no file uploaded");
            }else{
                $("#Dfile").html("<a href=../assets/uploads/"+data['file']+" target='_blank'>"+data['file']+"</a>");
            }

            $("#DStatus").val(data['status']);
            $("#Dcauses").val(data['causes']);

        });



    $("#acceptBtn").click(function(){
        $.post("../../backend/Controllers/DemandController/acceptDemand.php", {id:Id},function( data ) {
            $("#message-content").html("this demand is accepted");
            $("#FormSubmitButtons").hide();
            $("#message").show()

            //modificvation demand details
            $.post("../../backend/Controllers/DemandController/updateDetails.php",
                {
                    id:Id,
                    StartDate : $("#eventStartDate").val()+' '+ $("#eventStartTime").val(),
                    EndDate : $("#eventEndDate").val()+' '+ $("#eventEndTime").val(),
                    requirements : $("#Drequirements").val()
                },
                function( data ) {
                    //traitement
                });

            setTimeout(function(){ window.location.href = "GeneralDemandsUI.html"; }, 3000);

        });
    });



    $( "#refuseForm" ).submit(function( event ) {
        event.preventDefault();

        var Cause = $("#refuseCauses").val();
        $.post("../../backend/Controllers/DemandController/refuseDemand.php", {id:Id, cause : Cause},function( data ) {
            $("#message-content").html("this demand is refused");
            $("#FormSubmitButtons").hide();
            $('#myModal').modal('toggle');
            $("#message").show()
            setTimeout(function(){ window.location.href = "GeneralDemandsUI.html"; }, 3000);

        });

    });

});