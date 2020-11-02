<?php

use DAO\MovieDao;

include('nav-bar.php');
?>
<div class="wrapper row4 portada" style="position: fixed;top: 20%;">
<main class="container clear" style="color:black;"> 
    <div class="content"> 
      <div id="comments" >
    <span style="font-weight: bold;"><h1>Login</h1></span>
  </div>
  <div id="comments">
    <form class="login-form" id="mainav" method="post" action="<?php echo FRONT_ROOT."User/LogInValidate" ?>">
    <div class="form-group">
                         <label style="font-weight: bold;">Nickname</label>
                         <span style="color:#ec0101; font-weight: bold;" >
                         <?php if($message){ echo $message;}?>
                         </span>
                         <input name="userName" type="email" placeholder="Nickname"  style="max-width: 20%;"required/>  
                    </div>
                    <div class="form-group">
                         <label style="font-weight: bold;">Password</label>
                         <input name="password" type="password" placeholder="Password"  style="max-width: 20%;" required /> 
                    </div>
                    <div>
                      <span style="font-weight: bold;"> No estas registrado? <a href="<?php echo FRONT_ROOT."Session/ShowSignUpView"?>">Hace click acá!</a></span>
                    </div>
<br>
      <input type="submit" value="Log In" class="btn" style="background-color:#DC8E47;color:white;"/>
  
    </form>
    
  </div>
</main>
</div>

</div>

