<?php
 include('header.php');
 include('nav-bar.php');
?>
<div class="wrapper row4">
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >

    <h1>Admin Login</h1>
  </div>
  <div id="comments">
    <form class="login-form" id="mainav" method="post" action="<?php echo FRONT_ROOT."Session/CheckAdminLogin" ?>">
    <div class="form-group">
                         <label>Nickname</label>
                         <?php if($message){ echo "<h3>". $message ."</h3><br>";}?>
                         <input name="userName" type="email" placeholder="Nickname"  style="max-width: 20%;"required/>  
                    </div>
                    <div class="form-group">
                         <label >Password</label>
                         <input name="password" type="password" placeholder="Password"  style="max-width: 20%;" required /> 
                    </div>
<br>
      <input type="submit" value="Log In" class="btn" style="background-color:#DC8E47;color:white;"/>
  
    </form>
    
  </div>
</main>
  </div>
</div>

