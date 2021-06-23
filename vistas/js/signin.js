function onSigIn(googleUser)
{
    let profile = googleUser.getBasicProfile();
    auth( action= "login", profile);

}

function auth(action, profile=null)
{
    let data = {UserAction:action};

    if(profile){
        data={
            UserName: profile.getGivenName(),
            UserLastName: profile.getFamilyName(),
            UserEmail: profile.getEmail(),
            UserAction:action
        };

    }

    $.ajax(
        {
            type: "POST",
            url:"../controlador/user.php",
            data:data,
            success: function(data)
            {
                let user = JSON.parse(data);
                console.log(data); 
              
               console.log(user.logged);
               console.log(data.UserName);
                if(user.logged)
                {
                   //console.log($_SESSION['id_user'] );
                    
                    if(document.URL === "http://proyecto.com/vistas/login.php")
                    {
                        window.location.href = "../vistas/home_2.php";

                    }
                   
                }else
                {

                    alert("La cuenta no esta registrada");
                   // singOut()
                }
            }
        }
    )
}