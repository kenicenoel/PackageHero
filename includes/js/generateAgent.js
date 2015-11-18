$(document).ready(function()
{
  // What to do when the dropdown is selected
  $('#country').change(function()
  {
    var country = $(this).val();
    var agent = $('#agent');
    if(country == 'Grenada')
    {
      agent.empty().append('<option selected default value="GRE" selected>GRE</option>');

    }

    else if(country == 'Antigua')
    {
      agent.empty().append('<option selected default value="ANU" selected>ANU</option>');

    }

    else if(country == 'Trinidad')
    {
      agent.empty().append('<option selected default value="WEB" selected>WEB</option>');

    }

    else if(country == 'Guyana')
    {
      agent.empty().append('<option selected default value="GUY" selected>GUY</option>');

    }

    else if(country == 'Jamaica')
    {
      agent.empty().append('<option selected default value="JCA" selected>JCA</option>');

    }

    else if(country == 'St Lucia')
    {
      agent.empty().append('<option selected default value="BSL" selected>BSL</option>');

    }

    else if(country == 'Dominica')
    {
      agent.empty().append('<option selected default value="DCA" selected>DCA</option>');

    }

    else if(country == 'United States')
    {
      agent.empty().append('<option selected default value="USA" selected>USA</option>');

    }


  });


});
