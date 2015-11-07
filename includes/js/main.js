/* global $ */

//Load FancyBox

$(document).ready(function()
  {
    $(".fancybox").fancybox();


        // Ajax add package

        $('body').on('click', '#upload', function(e)
        {
              e.preventDefault();
              var formData = new FormData($(this).parents('form')[0]);

              $('#upload').val("Adding package...");

              $.ajax({
                  url: '../includes/addpackage.php',
                  type: 'POST',
                  xhr: function()
                  {
                      var myXhr = $.ajaxSettings.xhr();
                      return myXhr;
                  },
                  success: function (response)
                  {
                    console.log(response);
                    var p = document.getElementById('errorMessage');
                    p.innerHTML = response;
                    $('#upload').val("Add");
                  },
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false
              });
              return false;
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

                  }
                });

              });



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

        // This function allows one to switch from Grid layout to List Layout and vice versa

        $('#list').click(function()
        {
          $('#result-cards').css('display', 'none');
          $('#table-results').css('display', 'block');
        });

        $('#grid').click(function()
        {
          $('#result-cards').css('display', 'block');
          $('#table-results').css('display', 'none');
        });



        // The jquery/ajax function below is responsible for the tracking number search function
        $('body').on('click', '#lookupButton', function(e)

        {

          e.preventDefault();


          $('#lookupButton').replaceWith("<span id='loader' class='fa fa-refresh fa-spin'></span>");

          $.ajax
          ({
              url: '../includes/packagelookup.php',
              type: 'POST',
              data: $('form').serialize(),
              // datatype: 'text',
              success: function (response)
              {
                console.log(response);
                console.log(data);
                $('#lookupResults').html(response);
                $('#loader').replaceWith('<input id="lookupButton" type = "submit" value="lookup">');




              },

          });

              return false;
        });


        // Add note
        $('#saveNote').click(function()
        {
            var note = $('#note').val();

              $.ajax
              ({

                  url: 'save-note.php',
                  type: 'POST',
                  data: "note="+note,
                  success: function(response)
                  {
                      console.log(response+"/"+note);
                      if(response == 'Done')
                      {
                        location.reload();

                      }


                  }
                });
              return false;
        });


        // Run this code when the "RESOLVE" button is clicked
        $('#resolve').click(function()
        {
            // var user = "<?php echo $_SESSION['username'] ?>";
            // var tnumber = "<?php echo $_SESSION['trackingnumber'] ?>";
            // console.log(tnumber);
            // var news = "marked issue"+tnumber+" as RESOLVED.";
              $.ajax
              ({

                  url: 'resolve-issue.php',
                  type: 'POST',
                  // data: "news="+news,
                  success: function(response)
                  {
                      // console.log(response+"/"+note);
                      if(response == 'Done')
                      {
                        window.open('allpackages.php', '_self');

                      }

                  }

                });
              return false;
        });




        // Run this code when the "HIDE" button is clicked
        $('#hide').click(function()
        {

            // var news = "marked issue"+tnumber+" as RESOLVED.";
              $.ajax
              ({

                  url: 'hide-issue.php',
                  type: 'POST',
                  // data: "news="+news,
                  success: function(response)
                  {
                      console.log(response);
                      if(response == 'Done')
                      {
                        window.open('allpackages.php', '_self');

                      }

                  }

                });
              return false;
        });



});
