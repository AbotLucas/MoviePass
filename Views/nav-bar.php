
  <div class="wrapper row1" style="background-color: #321f28;">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="<?php echo FRONT_ROOT."Home/Index"?>" ><img style="width: 30px; height: 30px" src="https://image.flaticon.com/icons/png/512/120/120603.png" alt="YourMovie"> YourMovie</a></h1>
      </div>
      <!-- Add path routes below -->
      <nav id="mainav" class="fl_right fixed-top">
        <ul class="clear">
            <li class="active"> <a href="<?php echo FRONT_ROOT."Home/MostrarHome";?>">Main Menu</a> </li>
            <li><a class="drop" href="#">Movies</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Movie/listMovies" ?>">Show List</a></li>
              </ul>
            </li>
            <?php if(!isset($_SESSION["loginUser"])){ ?>
            <li><a class="drop" href="#">Log In</a>
              <ul>
              <li><a href="<?php echo FRONT_ROOT."Session/ShowLogInView" ?>">Log In</a></li>
                <li><a href="<?php echo FRONT_ROOT."Session/ShowSignUpView" ?>">Sign Up</a></li>
              </ul>
            </li>
            <?php 
           }
           else
           {
             ?>
            <a href="<?php echo FRONT_ROOT."Cinema/ShowListCinemaView" ?>">Cinemas</a></li>
            <li><a class="drop" href="#">Screenings</a>
              <ul>
              <li><a href="<?php echo FRONT_ROOT."Screening/ShowAddScreeningView" ?>">Add Screening</a></li>
              <li><a href="<?php echo FRONT_ROOT."Screening/ShowListScreeningView" ?>">Show List</a></li>
              </ul>
            </li>
            <li><a class="drop" href="#">Session</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Session/SessionDestroy" ?>">Log Out</a></li>
              </ul>
            </li> 
            <?php } ?>
        </ul>
    </nav> 
    </header>
  </div>