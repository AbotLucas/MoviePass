<?php require_once('nav-bar.php');

?>
<div style="text-align: -webkit-center">
    <br>
    <div style="display:inline-flex; margin: 20px; padding: 10px">
        <div style="position: absolute; left:15%">
            <h3 style="font-size: 40px; font-weight: bold 20%;"> <span style="background-color: rgba(115, 64, 70, 0.9); padding:10px; border: solid 1px #321f28">Movie List</span></h3>
        </div>

        <div>
            <?php  if($message){ echo "<span style='color:red; font-weight: bold;' >". $message ."</span><br><br>";}?>
        </div>

        <div style="position: absolute; right: 15%; background-color: #321f28;">
            <form action="<?php echo FRONT_ROOT . "/Screening/ApplyFilters" ?>" method="POST" style="background-color: #321f28; padding: 5px; display:flex">
                
                <div>
                    <label for="date">Date</label>
                    <input type="date" id="date">
                </div>
                &nbsp;
                <div>
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="">Genero1</option>
                        <option value="">Genero2</option>
                        <option value="">Genero3</option>
                    </select>
                </div>
                &nbsp;
                <button type="submit" class="" style="width: 50px; height:25px; align-self: flex-end;;">Apply</button>
            </form>
        </div>
    </div>
    <table class="homeTable" style="width: auto; max-width: 70%; margin-top: 40px">
        <thead>
            <th colspan="4">Cartelera</th>
        </thead>
        <tbody>
            <tr>
                <?php if(count($MovieList)>4){ while ($count <= 5) {
                    while ($count2 < $count * 4) { ?>

                        <td style="text-align: center; padding: 10px; max-width: calc(70%*0.25)">
                            <a href="<?php echo FRONT_ROOT . "Movie/ShowMovieSheet/" . "?id_movie=" . $MovieList[$count2]->getId_movie(); ?>">

                                <div class="div-img">
                                    <img class="img" src="http://image.tmdb.org/t/p/w200<?php echo $MovieList[$count2]->getUrlImage(); ?>" alt="<?php echo $MovieList[$count2]->getTitle(); ?>" style="max-width: 200px; max-height:300px">
                                </div>
                            </a>
                            <br>
                            <a href="#" style="font-weight: bold;"><?php echo $MovieList[$count2]->getTitle(); ?></a>


                        </td>

                    <?php $count2++;
                    } ?>
            </tr>
            <tr>
        <?php $count++;
                }} else { foreach($MovieList as $movie){ ?>
                
                <td style="text-align: center; padding: 10px; ">
                            <a href="<?php echo FRONT_ROOT . "Movie/ShowMovieSheet/" . "?id_movie=" . $movie->getId_movie(); ?>">

                                <div class="div-img">
                                    <img class="img" src="http://image.tmdb.org/t/p/w200<?php echo $movie->getUrlImage(); ?>" alt="<?php echo $movie->getTitle(); ?>" style="max-width: 200px; max-height:300px">
                                </div>
                            </a>
                            <br>
                            <a href="#" style="font-weight: bold;"><?php echo $movie->getTitle(); ?></a>


                        </td>
                
                <?php }}?>
                </tr>

        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>