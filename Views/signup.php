<?php
include_once('nav-bar.php');
?>
<div class="wrapper row4 portada" style="position: fixed;top: 20%;">
  <main class="container clear" style="color:black;">
    <div class="content">
      <div id="comments">
        <span style="font-weight: bold;">
          <h1>Sign-Up!</h1>
        </span>
        <span style="color:#ec0101; font-weight: bold;" >
        <?php if ($message) {
          echo  "ERROR: " . $message ;
        } ?>
        </span>
      </div>
      <div id="comments">
        <form class="login-form" id="mainav" method="post" action="<?php echo FRONT_ROOT . "User/SignUpValidate" ?>">
          <div class="form-group content-align: inline;">
            <label style="font-weight: bold;">E-mail</label>
            <input name="email" type="email" placeholder="Insert your E-mail" style="max-width: 20%;" required />
          </div>
          <div class="form-group ">
            <label style="font-weight: bold;">Password</label>
            <input name="password" type="password" placeholder="Insert yor password" style="max-width: 20%;" required />
          </div>
          
          <div class="form-group ">
            <label style="font-weight: bold;">Confirm Password</label>
            <input name="password2" type="password" placeholder="Insert yor password again" style="max-width: 20%;" required />
          </div>

          <div>
            <span style="font-weight: bold;"> Ya estas registrado? <a href="<?php echo FRONT_ROOT."Session/ShowLogInView"?>">Hace click acá!</a></span>
          </div> 
          <br>
          
          <input type="submit" value="Sign Up" class="btn" style="background-color:#DC8E47;color:white;" />

        </form>

      </div>
  </main>
</div>

</div>