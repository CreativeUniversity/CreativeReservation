$( document ).ready(function() {

    function removeParam(parameter)
    {
        var url=document.location.href;
        var urlparts= url.split('?');

        if (urlparts.length>=2)
        {
            var urlBase=urlparts.shift();
            var queryString=urlparts.join("?");

            var prefix = encodeURIComponent(parameter)+'=';
            var pars = queryString.split(/[&;]/g);
            for (var i= pars.length; i-->0;)
                if (pars[i].lastIndexOf(prefix, 0)!==-1)
                    pars.splice(i, 1);
            url = urlBase+'?'+pars.join('&');
            window.history.pushState('',document.title,url); // added this line to push the new url directly to url bar .

        }
        return url;
    }


    var url_string = window.location.href;
    var url = new URL(url_string);
    var msg = url.searchParams.get("msg");
    if(msg != undefined){
        if(msg == "accept"){
            $("#message-content").html("the accept mail has been sent");
            $("#message").show();
            setTimeout(function() {
                $("#message").fadeOut("slow");
            }, 5000);
            window.history.replaceState({}, document.title, "MembersUI.html");
        }

        if(msg == "refuse"){
            $("#message-content").html("the refus mail has been sent");
            $("#message").show();
            setTimeout(function() {
                $("#message").fadeOut("slow");
            }, 5000);

            window.history.replaceState({}, document.title, "MembersUI.html");
        }

        if(msg == "infos"){
            $("#message-content").html("the infomrmations mail has been sent");
            $("#message").show();
            setTimeout(function() {
                $("#message").fadeOut("slow");
            }, 5000);
            window.history.replaceState({}, document.title, "MembersUI.html");
        }
    }



     function accept(id){
        $.get( "../../backend/Controllers/UserController/confirmUserAction.php", {Id: id},function( data ) {
            location.href = location.href+"?msg=accept";


        });
    }
    
    function refus(id){
        $.get( "../../backend/Controllers/UserController/refuseUserAction.php", {Id: id} ,function( data ) {
            location.href = location.href+"?msg=refuse";


        });
    }

    function details(id){
        $.get( "../../backend/Controllers/UserController/getDetailsAction.php", {Id: id} ,function( data ) {
            location.href = location.href+"?msg=infos";


        });
    }


   
    
    $.get("../../backend/Controllers/UserController/getAllUsersAction.php", function( data ) {
        for(i=0;i<data.length;i++){
            var user = data[i];
        
            if (user['status'] == 'Passif'){
                
                $('#passifmember:last-child').append(
                    '<tr>' +
                    '<td>'+user['id']+'</td>' +
                    '<td>'+user['fullname']+'</td>' +
                    '<td>'+user['login']+'</td>' +
                    '<td>'+user['email']+'</td>' + //mail
                    '<td>'+user['phone']+'</td>' +
                    '<td>'+user['represant']+'</td>' +
                    '<td>'+
                    '<button type="button" class="btn btn-success btn-sm accept_btn" data-id="'+user['id']+'">Accept</button>'+
                    '<button type="button" class="btn btn-danger btn-sm decline_btn" data-id="'+user['id']+'">Decline</button>'+
                    '</td>' +
                    '</tr>'
                );
                
                
            }else{
                $('#actifmember:last-child').append(
                    '<tr>' +
                    '<td>'+user['id']+'</td>' +
                    '<td>'+user['fullname']+'</td>' +
                    '<td>'+user['login']+'</td>' +
                     '<td>'+user['email']+'</td>' + //mail
                    '<td>'+user['phone']+'</td>' +
                    '<td>'+user['represant']+'</td>' +
                    '<td>'+
                    '<button type="button" class="btn btn-warning btn-sm details_btn" data-id="'+user['id']+'">Send Informations</button>'+
                    '</td>' +
                    '</tr>'
                );
            }      
        }

        $(".accept_btn").on("click", function(){
            accept($(this).data("id"));
        });

        $(".decline_btn").on("click", function(){
            refus($(this).data("id"));
        });

        $(".details_btn").on("click", function(){
            details($(this).data("id"));
        });

        
    });
        
        
});