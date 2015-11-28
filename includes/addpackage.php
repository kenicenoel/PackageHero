
    <form class="card" id="package" enctype="multipart/form-data" method = "post" action = "includes/addpackage.php">
          <br>
          <header class="subheading"><span class="fa fa-bug"> </span> Create a new issue </header>
          <p id="errorMessage"></p>
          <p>
            Enter the tracking number, customer name (if known) and pick a main issue. Enter a description and pick the shipping carrier.
          </p>
          <br><br>
          <label for="trackingnumber">Tracking Number</label>
          <input type = "text" id = "trackingnumber" name="trackingnumber" required /><br>

          <label for="customername">Customer Name</label>
          <input type = "text" id = "customername" name="customername" /><br>

          <label for="type">Main Issue</label>
            <select form="package" name="MainIssue"> <br>
              <option value="" disabled selected>Select an issue</option>
              <option value = "Broken">Received broken</option>
              <option value = "Missing customer details">Missing customer details</option>
              <option value = "Invoice required">Invoice required</option>
              <option value = "No account number found">No account number found</option>
              <option value = "Delivery address not known">Delivery address not known</option>
            </select><br>

          <label for="description">Details</label>
          <textarea rows="7" cols="55" form="package" id = "description" name="description"></textarea> <br>

          <label for="itemtype">Item Description</label>
          <input type = "text" id = "itemtype" name="itemtype" /><br>
          <label for="shippingcarrier">Shipping Carrier</label>
            <select form="package" name="shippingcarrier" required> <br>
              <option value="" disabled selected>Pick the shipping agent</option>
              <option value = "USPS">USPS</option>
              <option value = "FedEX">FedEx</option>
              <option value = "UPS">UPS</option>
              <option value = "Canada Post">Canada Post</option>
              <option value = "Express Mail">EMS(Express Mail Service)</option>
              <option value = "DHL">DHL</option>
              <option value = "Lasership">Lasership</option>
              <option value = "Amazon">Amazon</option>
              <option value = "Warehouse drop-off">Warehouse drop-off</option>
            </select><br>

          <label for="images">Images (MAX: 5)</label>
          <input type = "file" id = "images" name="images[]" accept=".jpg" multiple="" required> <br>
          <input id="addIssue" type = "submit" value="Add" />

      </form>
