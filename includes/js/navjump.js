$(document).ready(function()
{
// When the user clicks on the Save button on the initial package scan page do this
$('body').on('click', '#savescan', function(e)
{

  // Get the username, password, country and Account type
  var t = $('#tnum').val();
  var s = $('#carrier').val();

  if(t == "" || s == null)
  {

    $('#errorMessage').html("<i class='fa fa-exclamation-triangle'></i> You must enter a tracking number and choose the shipping carrier.</br>");
  }

  else
  {
    e.preventDefault();
    var formData = new FormData($(this).parents('form')[0]);

    $('#savescan').val("Saving...");

    $.ajax({
        url: '../includes/initpkgscan.php',
        type: 'POST',
        xhr: function()
        {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        success: function (response)
        {

          console.log(response);
          $('#errorMessage').html("<p style='font-size:1.1em; background-color:#27ae60; color:#ffffff; margin:5px 0px 5px 5px'><i class='fa fa-check-circle'></i> DONE! Feel free to scan another package!</p>");
          $('#initialscan')[0].reset();
          $('#tnum').focus();
          $('#savescan').val("Save");

        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
  }

});


// When user clicks on the link that says "New Issue in the navigation, run this task
    $('#newissue').click(function()
    {

        var url='../includes/addpackage.php';

      $.ajax
      (
        {

          url:url,
          success: function(response)
          {
            $('#data').html(response);
            $('.titleheading').html("<i class='fa fa-bug fa-fw'></i>New issue creation ");

          }
        });

      });



      // When user clicks on the link that says "Add user in the navigation, run this task
            $('#adduser').click(function()
            {

                var url='../includes/adduser.php';

              $.ajax
              (
                {

                  url:url,
                  success: function(response)
                  {
                    $('#data').html(response); // use the returned html to replace the contents of the div with id 'data'
                    $('.titleheading').html("<i class='fa fa-user-plus fa-fw'></i>Create a new user");

                  }
                });

              });


              // When user clicks on the link that says "Initial PKG SCAN" in the navigation, run this task
                    $('#initialPackageScan').click(function()
                    {

                        var url='../includes/initpkgscan.php';

                      $.ajax
                      (
                        {

                          url:url,
                          success: function(response)
                          {
                            $('#data').html(response);
                            $('.titleheading').html("<i class='fa fa-barcode fa-fw'></i>Scan packages into the system ");
                            $('#tnum').focus();
                          }
                        });

                      });




      // When clicked. Load viewAllPackages
      $('#viewAllPackages').click(function()
      {

          var url='../includes/allpackages.php';

        $.ajax
        (
          {

            url:url,
            success: function(response)
            {
              $('#data').html(response);

            }
          });

        });




        $('.full-details').click(function()
        {
            var link = $(this).data('url');

          $.ajax
          (
            {

              url:link,
              success: function(response)
              {
                $('#data').html(response);

              }
            });

          });





});
