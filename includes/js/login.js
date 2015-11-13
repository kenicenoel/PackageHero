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
                
                if(response == 'true')
                {

                  window.open('admin/dashboard.php', '_self');
                }
                else
                {
                  $('#msg').html("<span class='fa fa-exclamation-triangle fa-fw'></span>Whoops! Either your username or password is incorrect");


                }


            }
          });
        return false;
  });

});
