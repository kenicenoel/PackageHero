
      <form id="password" action= "" method ="post">
        <img src="images/icons/password.svg" />
        <header class="reset">Password Reset</header>
          <p class="text">To reset your password, we need to know what your username and email address was</p>
          <p id = "msg"></p>
           <label for="username">Username</label>
          <input type = "text" id = "username" name="username" required autofocus placeholder = "e.g Brendon" /> <br><br>
          <label for="emailaddress">Email</label>
          <input type = "email" id = "emailaddress" name="emailaddress" required placeholder="you@shipwebsource.com" /> <br>
          <input id ="reset-button" type = "submit" value="Reset" />

      </form>
      <?php include_once 'includes/footer.php'; ?>
