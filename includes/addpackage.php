
      <form class="card" id="package" enctype="multipart/form-data" method = "post" action = "includes/addpackage.php">
          <br>
          <header class="subheading"><span class="fa fa-bug"> </span> Create a new issue </header>
          <p id="errorMessage"></p>

          <br><br>
        <section>
          <label for = "trackingnumber">Tracking Number</label>
          <input type = "text" id = "trackingnumber" name="trackingnumber" required placeholder="e.g 942759457846848" autofocus /><br>

          <label for="customername">Customer Name</label>
          <input type = "text" id = "customername" name="customername" placeholder="e.g Lincoln Wendy" /><br>

          <label for="accountnumber">Account Number</label>
          <input type = "text" id = "accountnumber" name="accountnumber" placeholder="e.g WEB720 or BSL67324" /><br>

          <label for="type">Main Issue</label>
            <select form = "package" name="mainissue" required> <br>
              <option value="" disabled selected>What's wrong?</option>
              <option value = "Broken">Item received broken</option>
              <option value = "Proof of pickup">Proof of pickup</option>
              <option value = "Crating required">Crating required</option>
              <option value = "Missing customer details">Missing customer details for the package</option>
              <option value = "Hazardous material">Hazmat. What to do?</option>
              <option value = "Held by customs USA">Item is being held by customs</option>
              <option value = "Restricted item">Item is on the restricted list</option>
              <option value = "Import License Needed">Import license needed</option>
              <option value = "Invoice required">Invoice required</option>
              <option value = "No account number found">Item has no account number</option>
              <option value = "Verify accountholder ordered item">Verify if account holder ordered item </option>
              <option value = "Other">Other</option>
            </select><br>

          <label for="description">Comments/ Details</label>
          <textarea rows="7" cols="55" form="package" id = "description" name="description"></textarea> <br>

          <label for="itemtype">Item Type</label>
          <input type = "text" id = "itemtype" name="itemtype" /><br>

          <label for="shippingcarrier">Shipping Company</label>
            <select form="package" name="shippingcarrier" required> <br>
              <option value="" disabled selected>Who delivered this item?</option>
              <option value = "USPS">USPS</option>
              <option value = "FedEX">FedEx</option>
              <option value = "UPS">UPS</option>
              <option value = "Canada Post">Canada Post</option>
              <option value = "Express Mail">EMS (Express Mail Service)</option>
              <option value = "DHL">DHL</option>
              <option value = "Lasership">Lasership</option>
              <option value = "Amazon">Amazon</option>
              <option value = "Warehouse drop-off">Warehouse drop-off</option>
            </select><br>

            <label for="sendEmail">Email Customer?</label>
            <select id = "sendEmail" form="package" name = "sendEmail" required> <br>
              <option value = "auto"  selected>Yes (auto generated)</option>
              <option value = "custom">Yes, but I will enter the text</option>
              <option value = "no">No</option>
            </select>

            <label id="forEmailBody" style="display:none;" for ="emailBody">Email body</label>
            <textarea style="display:none;" id="emailBody" name="emailBody" rows="7" cols="55" ></textarea>

          <label for="images">Photos (up to 5)</label>
          <input type = "file" id = "images" name="images[]" accept=".jpg" multiple="" required> <br>
          <input id="addIssue" type = "submit" value="Add" />
        </section>

      </form>

      	<script type= "text/javascript" src="../includes/js/jquery.js"></script>

        <script type="text/javascript">


          $('#sendEmail').change(function()
          {
            var sendEmail = $(this).val();

            if(sendEmail == "custom")
            {
              $('#emailBody').css('display', 'block');
              $('#forEmailBody').css('display', 'block');

            }

            else
            {
                $('#emailBody').css('display', 'none');
                $('#forEmailBody').css('display', 'none');
            }
          });

        </script>
