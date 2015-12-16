
//Load FancyBox

$(document).ready(function()
  {
    $(".fancybox").fancybox();




        // Ajax add new issue

        $('body').on('click', '#addIssue', function(e)
        {
              // Get the trackingnumber and image
              var tnum = $('#trackingnumber').val();
              var imgs = $('#images').val();

              if(tnum == "" || imgs == "")
              {
                $('#errorMessage').html("<i class='fa fa-exclamation-triangle'></i> You must enter a tracking number and select at least one image.");
              }

              else
              {
                e.preventDefault();
                var formData = new FormData($(this).parents('form')[0]);

                $('#addIssue').val("Saving...");

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
                      if(response == "done" || response == "Message has been sent: done")
                      {
                        $('#errorMessage').append("<p style='font-size:1.1em; background-color:#27ae60; color:#ffffff;'><i class='fa fa-check-circle'></i> Saved. An email was also sent to the customer!<br>You may add another or move on.</p>");
                        $('#package')[0].reset();

                        $('#addIssue').val("Add");

                      }

                      else
                      {
                        $('#errorMessage').append("<p style='font-size:1.1em; background-color:#f1c40f; color:#000000; padding-bottom:10px'><i class='fa fa-close'></i>"+response+".</p>")
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



        // Ajax create new user
        $('body').on('click', '#createuser', function(e)
        {

          // Get the username, password, country and Account type
          var u = $('#username').val();
          var p = $('#password').val();
          var c = $('#country').val();
          var r = $('#role').val();

          if(u == "" || p == "" || c == null || r == null)
          {

            $('#errorMessage').html("<i class='fa fa-exclamation-triangle'></i> A username, password, country and user role is required.</br>");
          }

          else
          {
            e.preventDefault();
            var formData = new FormData($(this).parents('form')[0]);

            $('#createuser').val("Creating user...");

            $.ajax({
                url: '../includes/adduser.php',
                type: 'POST',
                xhr: function()
                {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                success: function (response)
                {


                  $('#errorMessage').html("<p style='font-size:1.1em; background-color:#27ae60; color:#ffffff; margin:5px 0px 5px 5px'><i class='fa fa-check-circle'></i> User was created. You may create another user or move on.</p>");
                  $('#user')[0].reset();
                  $('#agent').empty();
                  $('#createuser').val("Done");

                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
          }

        });



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
                    $('.pageTitle').text("New issue creation");

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
                            $('.pageTitle').text("Create a new user");

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
                                    $('.pageTitle').text("Scan packages into the system");
                                    $('#tnum').focus();
                                  }
                                });

                              });




        // The jquery/ajax function below is responsible for the search function
        $('body').on('click', '#lookupButton', function(e)
        {

          e.preventDefault();

            var query = $('#queryField').val();
            var before = $('#before').val();
            var after = $('#after').val();


            $('#lookupButton').replaceWith("<span id='loader' class='fa fa-refresh fa-spin'></span>");
          $.ajax
          ({
              url: '../includes/packagelookup.php',
              type: 'POST',
              data: "query="+query+"&beforeDate="+before+"+&afterDate="+after,
              // datatype: 'text',
              success: function (response)
              {
                if(response =="")
                {
                  $('#lookupResults').html("<img class='nothing' src='../images/icons/no-packages.png' alt='' />");
                  $('#loader').replaceWith('<input id="lookupButton" type = "submit" value="Find">');
                }
                else
                {
                  $('#lookupResults').html(response);
                  $('#loader').replaceWith('<input id="lookupButton" type = "submit" value="Find">');
                }

              },

          });

              return false;
        });


        // Add note
        $('#saveNote').click(function()
        {

            var note = $('#note').val();
            if(note == "")
            {
              $('#note').effect('highlight');
              // $('#saveNote').effect('puff');
            }
            else
            {
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
            }

              return false;
        });


        // Run this code when the "RESOLVE" button is clicked
        $('#resolve').click(function()
        {

              $.ajax
              ({

                  url: 'resolve-issue.php',
                  type: 'POST',
                  success: function(response)
                  {

                    $('#data').html(response);

                  }

                });
              return false;
        });

        // When the user clicks on the Resolve button on the Resolve issue page do this
        $('body').on('click', '#resolveissue', function(e)
        {

          // Get the account number
          var number = $('#accountNumber').val();
          if(number == "")
          {

            $('#errorMessage').html("<i class='fa fa-exclamation-triangle'></i> Whoa there! Ensure you've entered the Account Number</br>");
          }

          else
          {
            e.preventDefault();
            var num = $('#accountNumber').val();

            $('#resolve-issue').val("Saving...");

            $.ajax({
                url: '../includes/resolve-issue.php',
                type: 'POST',
                data: 'accountNumber='+num,
                success: function (response)
                {

                  window.open('allpackages.php', '_self');

                }

            });
            return false;
          }

        });

        // Run this code when the "HIDE" button is clicked
        $('.hide').click(function()
        {

          $( "#dialog-confirm" ).dialog(
            {
              resizable: false,
              height:250,
              modal: true,
              buttons:
              {
                "Yes": function()
                {
                  $( this ).dialog( "close" );
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
                },
                "No": function()
                {
                  $( this ).dialog( "close" );
                }
              }
            });

            // var news = "marked issue"+tnumber+" as RESOLVED.";

        });


        // Run this code when the "profile" link is clicked
        $('.profile').click(function()
        {

              $.ajax
              ({

                  url: '../includes/profile.php',
                  type: 'POST',
                  success: function(response)
                  {

                    $('#data').html(response);
                    $('.pageTitle').text("Update your profile");

                  }

                });
              return false;
        });

        // Ajax update user profile

    $('body').on('click', '#save_profile', function(e)
    {
      e.preventDefault();

      $('#save_profile').replaceWith("<span id='loader' class='fa fa-refresh fa-spin'></span>");

      $.ajax
      ({
          url: '../includes/profile.php',
          type: 'POST',
          data: $('form').serialize(),
          // datatype: 'text',
          success: function (response)
          {
            $('#profile').html("Updated profile successfully");
            $('#loader').replaceWith('<button id="save_profile" type = "submit">Updated</button>');

          },

      });

          return false;
    });





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



          // Create the circular graphs
          // $('#total-issues').circliful();
          // $('#hidden-issues').circliful();
          // $('#available-issues').circliful();
          // $('#last-issue').circliful();



          // Hide the news section when loaded
          // $('p.newsitem').hide();

          // Hide the links when they are clicked
          $(".user").click(function()
          {
            $(".submenu").toggle('slow');

          });

          $('.navIssues').click(function()
          {
            $('.issues').toggle();
            $(this).find('i').toggleClass('fa fa-toggle-off fa fa-toggle-on');

          });

          $('.navPackages').click(function()
          {
            $('.packages').toggle();
            $(this).find('i').toggleClass('fa fa-toggle-off fa fa-toggle-on');
          });

          $('.navUsers').click(function()
          {
            $('.usr').toggle();
            $(this).find('i').toggleClass('fa fa-toggle-off fa fa-toggle-on');
          });

          // Hide the navigation menu
          $('.menu').click(function()
          {
              $('#navigation').toggle("puff");
              $(this).toggleClass('menuHidden', 'menuVisible');
          });

          // Hide the dashboard sections //
          $('.newsModule').click(function()
          {
            $('p.newsitem').toggle("fade");
          });


          $('.summaryModule').click(function()
          {
            $('p#summary-graph').toggle("fade");
          });

          $('.trendsModule').click(function()
          {
            $('p#weekly-report').toggle("fade");
          });

          $('.recentModule').click(function()
          {
            $('table#results').toggle("fade");

          });

          // when the search button on the header is clicked
          // $('#headerSearchButton').click(function()
          //   {
          //     var keyword = $('#headerSearch').val();
          //
          //     $.ajax
          //     ({
          //         url: '../includes/packagelookup.php',
          //         type: 'POST',
          //         data: "query="+keyword,
          //         success: function (response)
          //         {
          //           if(response == "")
          //           {
          //             $('#data').html("<img class='nothing' src='../images/icons/no-packages.png' alt='' />");
          //           }
          //           else
          //           {
          //             $('#data').html(response);
          //           }
          //
          //
          //         },
          //
          //     });
          //
          //         return false;
          //   }
          // );

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

            $('.listView').mouseover(function()
            {
                $(".quickView", this).css('visibility', 'visible');
                $(".quickHide", this).css('visibility', 'visible');
            });

            $('.listView').mouseout(function()
            {
                $(".quickView", this).css('visibility', 'hidden');
                $(".quickHide", this).css('visibility', 'hidden');
            });

            



});
