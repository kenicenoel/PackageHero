$(document).ready(function()
{

  // Ajax login
  $('#login-button').click(function()
  {
      var username = $('#username').val();
      var password = $('#password').val();

        $.ajax
        ({

            url: 'includes/authenticate.php',
            type: 'POST',
            data: "username="+username+"&password="+password,
            success: function(response)
            {
                console.log(response);
                if(response == 'true')
                {
                  console.log("good Login");
                  window.open('admin/dashboard.php', '_self');
                }
                else
                {
                  $('#msg').text(" You've entered an incorrect username address or password.");
                  console.log("Bad login");

                }


            }
          });
        return false;
  });

});
