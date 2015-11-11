
    <form class="card" id="package" enctype="multipart/form-data" method = "post" action = "includes/addpackage.php">
          <br>
          <header class="subheading"><span class="fa fa-bug"> </span> Add a new package with issues to the system </header>
          <p id="errorMessage"></p>
          <p>
            Enter the tracking number, customer name (if known) and pick a main issue. <br>Enter a description if additional information is known or
            the issue is not listed<br> in the main issue dropdown.
          </p>
          <br><br>
          <label for="trackingnumber">Tracking Number</label>
          <input type = "text" id = "trackingnumber" name="trackingnumber" required /><br>

          <label for="customername">Customer Name</label>
          <input type = "text" id = "customername" name="customername" /><br>

          <label for="type">Main Issue</label>
            <select form="package" name="MainIssue"> <br>
              <option disabled selected>Select an issue</option>
              <option value = "Broken">Received broken</option>
              <option value = "Cannot identify customer">Cannot identify customer</option>
              <option value = "Invoice required">Invoice required</option>
              <option value = "Delivery address not known">Delivery address not known</option>
            </select><br>


          <textarea rows="10" cols="70" form="package" id = "description" name="description"></textarea> <br>

          <label for="images">Images (MAX: 5)</label>
          <input type = "file" id = "images" name="images[]" accept=".jpg" multiple=""> <br>
          <input id="upload" type = "submit" value="Add" />

      </form>
