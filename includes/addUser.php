<?php
    include_once "config.php";
    if(!empty($_POST))
    {
      // print_r($_POST);
      // Create new note and newsfeed item
      $user = $_POST['username'];
      $pass = $_POST['password'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $email = $_POST['emailaddress'];
      $phone = $_POST['phonenumber'];
      $country = $_POST['country'];
      $role = $_POST['role'];

      // Insert the note into the updates table
      $sql = "INSERT INTO users (Username, Password, FirstName, LastName, EmailAddress, PhoneNumber, Country, Role) VALUES(?,?,?,?,?,?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('ssssssss', $user, $pass, $fname, $lname, $email, $phone, $country, $role);
      $stmt->execute();
      $stmt->close();

      echo "Done";


    }



    else
    {
      echo '
			  <div id ="content">
			      <form class="card">
								<header class="subheading"><span class=" fa fa-user-plus"></span> Grant access to a new user</header>
                <p>Enter a username, a password, Pick the country and account type.<br> We recommend that you fill in the
                  First and Last name field and<br> enter an email address and or phone number to keep things<br> organised.
                </p><br>
								<p id="errorMessage"></p>
			          <label for="username">Username</label>
								<input type = "text" id = "username" name="username" required /><br>

								<label for="password">Password</label>
								<input type = "text" id = "password" name="password" required /><br>

								<label for="firstname">First Name</label>
			          <input type = "text" id = "firstname" name="firstname" /><br>

								<label for="lastname">Last Name</label>
			          <input type = "text" id = "lastname" name="lastname" /><br>

								<label for="emailaddress">Email Address</label>
			          <input type = "email" id = "emailaddress" name="emailaddress" required /><br>

								<label for="phonenumber">Phone Number</label>
			          <input type = "text" id = "phonenumber" name="phonenumber" /><br>

								<label for="country">Country</label>
								<select name="country" required>
									<option selected disabled>Pick a country</option>
									<option value="Antigua">Antigua</option>
									<option value="Barbados">Barbados</option>
									<option value="Canada">Canada</option>
									<option value="Dominica">Dominica</option>
									<option value="Grenada">Grenada</option>
									<option value="Guyana">Guyana</option>
									<option value="Jamaica">Jamaica</option>
									<option value="St Lucia">St Lucia</option>
									<option value="St Vincent">St Vincent</option>
									<option value="Trinidad">Trinidad</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>

								</select><br>

								<label for="role">Account type</label>
                <select name="role" required>
									<option selected disabled>Pick Priviledge</option>
                  <option value="Administrator">Administrator</option>
									<option value="Standard">Standard</option>
                </select> <br><br>

								<input id="createuser" type = "submit" value="Done" />

			      </form>



			</div>

			';
    }
