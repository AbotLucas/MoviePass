<div class="wrapper row1" style="background-color: #321f28;">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left">
      <h1><a href="<?php echo FRONT_ROOT . "Home/Index" ?>"><img style="width: 30px; height: 30px" src="https://image.flaticon.com/icons/png/512/120/120603.png" alt="YourMovie"> YourMovie</a></h1>
    </div>
    <!-- Add path routes below -->
    <nav id="mainav" class="fl_right fixed-top">
      <ul class="clear">
        <li class="active"> <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>">Main Menu</a> </li>

        <li>
        <a href="<?php echo FRONT_ROOT . "Movie/listMovies" ?>">Movies</a>
        </li>

        <?php if (!isset($_SESSION["loginUser"])) { ?>
          
              <li>
              <a href="<?php echo FRONT_ROOT . "Session/ShowLogInView" ?>">Log In</a>
              </li>
              <li>
              <a href="<?php echo FRONT_ROOT . "Session/ShowSignUpView" ?>">Sign Up</a>
              </li>
        <?php
        } else { if($_SESSION["loginUser"]->getRole() == 1){
        ?>
         <li><a class="drop" href="#">Cinemas</a>
              <ul>
              <li><a href="<?php echo FRONT_ROOT."Cinema/ShowListCinemaView" ?>">Show List Cinema</a></li>
              <li><a href="<?php echo FRONT_ROOT."Room/ShowListRoomALLView" ?>">Show List Room</a></li>
              </ul>
            </li>
        <?php }?>
          <!-- <li><a href="<?php //echo FRONT_ROOT . "Screening/ShowListScreeningView" ?>">Screenings</a></li> -->
          <li><a class="drop" href="#">Session</a>
            <ul>
              <li><a href="<?php echo FRONT_ROOT. "Home/ShowWeAreWorkingView"?>">My profile</a></li>
              <li><a href="<?php echo FRONT_ROOT . "Session/SessionDestroy" ?>">Log Out</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </header>
</div>