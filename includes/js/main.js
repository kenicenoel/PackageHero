/* global $ */

//Load FancyBox

$(document).ready(function()
  {
    $(".fancybox").fancybox();


    $('.back-button').click(function()
    {
        window.history.back();
    });




        // Ajax add package

        $('body').on('click', '#upload', function(e)
        {
              e.preventDefault();
              var formData = new FormData($(this).parents('form')[0]);

              $('#upload').val("Adding package...");

              $.ajax({
                  url: '../includes/add_issue.php',
                  type: 'POST',
                  xhr: function()
                  {
                      var myXhr = $.ajaxSettings.xhr();
                      return myXhr;
                  },
                  success: function (response)
                  {

                    var p = document.getElementById('errorMessage');
                    p.innerHTML = response;
                    $('#upload').val("Add");
                    $('#package').trigger("reset");
                  },
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false
              });
              return false;
        });



        // Ajax create new user

        $('body').on('click', '#createuser', function(e)
        {
              e.preventDefault();
              var formData = new FormData($(this).parents('form')[0]);

              $('#createuser').val("Creating user...");

              $.ajax({
                  url: '../includes/addUser.php',
                  type: 'POST',
                  xhr: function()
                  {
                      var myXhr = $.ajaxSettings.xhr();
                      return myXhr;
                  },
                  success: function (response)
                  {

                    var p = document.getElementById('errorMessage');
                    p.innerHTML = response;
                    $('#createuser').val("Done");
                    $('#createuserform').trigger("reset");
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
                    $('.titleheading').html("<i class='fa fa-bug fa-fw'></i>New issue creation. Enter as much details as possible then click 'ADD'");

                  }
                });

              });



              // When user clicks on the link that says "Add user in the navigation, run this task

                    $('#adduser').click(function()
                    {

                        var url='../includes/addUser.php';

                      $.ajax
                      (
                        {

                          url:url,
                          success: function(response)
                          {
                            $('#data').html(response);
                            $('.titleheading').html("<button class='back-button'><i class='fa fa-chevron-left fa-fw'></i></button><i class='fa fa-user-plus fa-fw'></i>Create a new user. Note that most fields are required.");

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



                  $('#searchNav').click(function()
                  {
                      $('.titleheading').html("<i class='fa fa-search fa-fw'></i>Package search. Enter all or part of a tracking number then 'FIND'");
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
            console.log(note);
              $.ajax
              ({

                  url: 'save-note.php',
                  type: 'POST',
                  data: "note="+note,

                  success: function(response)
                  {

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


            // var news = "marked issue"+tnumber+" as RESOLVED.";
              $.ajax
              ({

                  url: 'resolve-issue.php',
                  type: 'POST',
                  // data: "news="+news,
                  success: function(response)
                  {

                      if(response == 'Done')
                      {
                        window.open('allpackages.php', '_self');

                      }
                      else
                      {
                          $('#errorMessage').text(response);
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

                      if(response == 'Done')
                      {
                        window.open('allpackages.php', '_self');

                      }

                  }

                });
              return false;
        });




          // Create the circular graphs
          $('#total-issues').circliful();
          $('#hidden-issues').circliful();
          $('#available-issues').circliful();
          $('#last-issue').circliful();





});
