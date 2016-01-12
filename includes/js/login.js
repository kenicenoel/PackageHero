$(document).ready(function()
{

  // Ajax login
  $('#login-button').click(function()
  {
      var username = $('#username').val();
      var password = $('#password').val();
      var page = $('#page').val();
      

        $.ajax
        ({

            url: 'includes/authenticate.php',
            type: 'POST',
            data: "username="+username+"&password="+password,

            success: function(response)
            {

                if(response == 'success' && page == '')
                {

                  window.open('admin/dashboard.php', '_self');
                }

                else if(response == 'failure')
                {
                  $('#msg').html("<span class='fa fa-exclamation-triangle fa-fw'></span>Whoops! Your username or password is incorrect");
                  $("#form").effect( "shake" );
                }

                else if(response == 'success' && page != '')
                {

                  window.open(page, '_self');
                }

                else
                {
                  console.log(response);
                }


            }
          });
        return false;
  });

});
