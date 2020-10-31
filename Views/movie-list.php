<?php require_once('nav-bar.php');
use Controllers\MovieController;
use Models\Movie;

$MovieController = new MovieController();
$MovieList = $MovieController->getAPIList();
$count = 0; $count2 = 0;

/* $count=0;
        $count2=0;
        while($count<=3){
            while($count2<$count*3){
                echo $list[$count2];
                $count2 ++;
            }
            echo "<br>";
            $count++;
        } */

?>
<div style="text-align: -webkit-center"> 
        <br>
        <h3 style="font-size: 40px; font-weight: bold 20%; text-align: center;"> <span style="background-color: rgba(115, 64, 70, 0.9); padding:10px; border: solid 1px #321f28">Movie List</span></h3>
    <table class="homeTable" style="max-width: 70%; ">
        <thead>
            
        </thead>
        <tbody>
          <tr>
          <?php while($count<=5){ while($count2<$count*4) {?>

            <td style="text-align: center;">
                <a href="#">
                    
                        <div class="div-img">
                            <img class="img" src="http://image.tmdb.org/t/p/w200<?php echo $MovieList[$count2]->getUrlImage();?>" alt="<?php echo $MovieList[$count2]->getTitle(); ?>">
                        </div>
                </a>
                <br>
                <a href="#" style="font-weight: bold;"><?php echo $MovieList[$count2]->getTitle(); ?></a>

                
            </td>
                            
          <?php $count2++;}?>  
          </tr>
          <?php $count++;} ?>  
        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>