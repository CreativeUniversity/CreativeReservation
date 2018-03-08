/**
 * Created by MhamdiRayen on 01/02/2018.
 */
$( document ).ready(function() {


    $( "#form" ).submit(function(event) {
        event.preventDefault();

        $.post("../../backend/Controllers/UserController/existAction.php",
            { login: $("#login").val() , pwd: $("#pwd").val()},
            function(data){
                if(data == 1){

                    $("#error-message").show();
                    setTimeout(function() {
                        window.location.href = "connectionUI.html";
                    }, 5000);
                }else{
                    obj = $("#form").serialize();

                    $.post("../../backend/Controllers/UserController/subscribeAction.php", obj, function(data){
                        $("#success-message").show();
                        $("#form")[0].reset();
                    });
                    setTimeout(function() {
                        window.location.href = "connectionUI.html";
                    }, 5000);
                }
            });


    });


    $( "#cpwd" ).change(function() {
        password = $("#pwd").val();
        cpassword = $("#cpwd").val();

        if(password != cpassword) {
            $("#group-password").addClass("has-error");
            $("#group-cpassword").addClass("has-error");
        }else{
            $("#group-password").addClass("has-success");
            $("#group-cpassword").addClass("has-success");
            $("#group-password").removeClass("has-error");
            $("#group-cpassword").removeClass("has-error");
        }
    });


});