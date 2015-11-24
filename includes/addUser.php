<?php
    include_once "config.php";
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['country']) && isset($_POST['role']))
    {
      // print_r($_POST);
      // Create new note and newsfeed item
      $user = $_POST['username'];
      $pass = md5($_POST['password']);
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $email = $_POST['emailaddress'];
      $phone = $_POST['phonenumber'];
      $country = $_POST['country'];
      $agent = $_POST['agent'];
      $role = $_POST['role'];

      // Insert the note into the updates table
      $sql = "INSERT INTO users (Username, Password, FirstName, LastName, EmailAddress, PhoneNumber, Country, Agent, Role) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('sssssssss', $user, $pass, $fname, $lname, $email, $phone, $country, $agent, $role);
      $stmt->execute();
      $stmt->close();

      echo "Done";

    }



    else
    {
      echo '
			  <div id ="content">
			      <form class="card" id="user">
								<header class="subheading"><span class=" fa fa-user-plus"></span> Add a new user</header>
                <p>Enter a username, a password, choose the country and the user priviledge.
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
			          <input type = "email" id = "emailaddress" name="emailaddress" /><br>

								<label for="phonenumber">Phone Number</label>
			          <input type = "text" id = "phonenumber" name="phonenumber" /><br>

								<label for="country">Country</label>
								<select width="100px" style="width:200px" id="country" name="country" required>
									<option selected disabled>Choose country</option>
									<option value="Antigua">Antigua</option>
									<!-- <option value="Barbados">Barbados</option> -->
									<!-- <option value="Canada">Canada</option> -->
									<option value="Dominica">Dominica</option>
									<option value="Grenada">Grenada</option>
									<option value="Guyana">Guyana</option>
									<option value="Jamaica">Jamaica</option>
									<option value="St Lucia">St Lucia</option>
									<!-- <option value="St Vincent">St Vincent</option> -->
									<option value="Trinidad">Trinidad</option>
									<!-- <option value="United Kingdom">United Kingdom</option> -->
									<option value="United States">United States</option>

								</select>

                <select readonly id="agent" name="agent" style="width:200px">
								</select>

								<label for="role">Role</label>
                <select id="role" name="role" required>
									<option selected disabled>Account Type</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Miami">Miami</option>
									<option value="Standard">Standard</option>
                </select> <br><br>

								<input id="createuser" type = "submit" value="Done" />

			      </form>



			</div>

			';
    } ?>

    <script src="../includes/js/generateAgent.js"></script>
