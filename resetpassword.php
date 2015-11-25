
      <form id="password" action= "" method ="post">
        <header class="reset"><i class = "fa fa-exclamation-circle"></i> Password Reset</header>
          <p class="text">You are about to reset your password</p>
          <p id = "msg"></p>
           <label for="username"><span class="fa fa-male fa-fw"></span> Username</label>
          <input type = "text" id = "username" name="username" required autofocus placeholder = "e.g Brendon" /> <br><br>
          <label for="password"><span class="fa fa-at fa-fw"> </span> Email</label>
          <input type = "email" id = "emailaddress" name="emailaddress" required placeholder="you@websource.com" /> <br>
          <input id ="reset-button" type = "submit" value="Reset" />

      </form>
      <?php include_once 'includes/footer.php'; ?>
