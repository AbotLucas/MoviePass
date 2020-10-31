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
<div> 
        <br>
        <h3 style="font-size: 40px; font-weight: bold 20%; text-align: center;">Movies</h3>
    <table class="homeTable">
        <thead>
            
        </thead>
        <tbody>
          <tr>
          <?php while($count<=5){ while($count2<$count*4) {?>
          

             <td style="justify-content: center;" ><a href=""><img src="http://image.tmdb.org/t/p/w200<?php echo $MovieList[$count2]->getUrlImage();?>" alt="<?php echo $MovieList[$count2]->getTitle(); ?>"></a></td>
                
            
          <?php $count2++;}?>  
          </tr>
          <?php $count++;} ?>  
        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>