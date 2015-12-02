$(document).ready(function()
{

  $('#relogin').click(function()
  {

      var url='index.php';

    $.ajax
    (
      {

        url:url,
        success: function(response)
        {
          $('body').load(response);


        }
      });

    });


        // When the forget password text is clicked do this
        $('#forgot-password').click(function()
        {

            var url='resetpassword.php';

          $.ajax
          (
            {

              url:url,
              success: function(response)
              {
                $('#bottom').html(response);


              }
            });

          });


          // Ajax reset password

          $('body').on('click', '#reset-button', function(e)
          {
                // Get the trackingnumber and image
                var username = $('#username').val();
                var email = $('#emailaddress').val();

                if(username == "" || email == "")
                {
                  $('#errorMessage').html("<i class='fa fa-exclamation-triangle'></i> Please enter your username AND password.");
                }

                else
                {
                  e.preventDefault();
                  var formData = new FormData($(this).parents('form')[0]);


                  $.ajax({
                      url: 'reset.php',
                      type: 'POST',
                      xhr: function()
                      {
                          var myXhr = $.ajaxSettings.xhr();
                          return myXhr;
                      },
                      success: function (response)
                      {

                        if(response == "Try again")
                        {
                          $('#msg').text("Sorry. Could not find a user with these details.");
                          $('form#password').effect("shake");
                        }

                        else
                        {
                          var form =
                          '<form id="password"><header>Your new password.</header><br><p class="text">Please copy your new password.</p><p id="result"></p><input id="relogin" type="submit" value="click to login" /></form>';
                          $('#password').html(form);
                          $('#result').text(response);

                        }


                      },
                      data: formData,
                      cache: false,
                      contentType: false,
                      processData: false
                  });
                  return false;


                }

          });



});
