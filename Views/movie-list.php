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
                    Date
                    <input type="radio" value="" id="date" name="filter_radio" style="margin: auto; display: inline-flex;width: 10px;" required>
                    <select name="date" id="date">
                        <option value="" disable_selected>--Select a Date--</option>
                        <?php foreach($datesOfScreenings as $date){?> 

                            <option value="<?php echo $date['date_screening']; ?>"><?php echo $date['date_screening']; ?></option>
                            
                        <?php } ?>
                    </select>
                </div>
                &nbsp;
                <div>
                    Genre
                    <input type="radio" value="" id="genre" name="filter_radio" style="margin: auto; display: inline-flex;width: 10px;">
                    <select name="gender" id="gender">
                        <option value="" disable_selected>--Select a Genre--</option>
                        <?php foreach($genresOfScreenings as $genre){?>

                        <option value="<?php echo $genre->getId_genre(); ?>"><?php echo $genre->getGenreName(); ?></option>
                        
                        <?php } ?>
                    </select>
                </div>
                &nbsp;
                <button type="submit" style="width: 50px; height:25px; align-self: flex-end;;">Apply</button>
            </form>
        </div>
    </div>
    
               
        <?php if(is_array($MovieList) && !empty($MovieList)){?>
        <table class="homeTable" style="width: 70%; margin-top: 40px">
        <thead>
            <th colspan="6">Cartelera</th>
        </thead>
        <tbody>
            <tr>
        <?php foreach($MovieList as $movie){ if($count==6) { echo "</tr><tr>"; $count = 0;}?>
        
                <td style="text-align: center; padding: 10px; ">
                            <a href="<?php echo FRONT_ROOT . "Movie/ShowMovieSheet/" . "?id_movie=" . $movie->getId_movie(); ?>">

                                <div class="div-img">
                                    <img class="img" src="http://image.tmdb.org/t/p/w200<?php echo $movie->getUrlImage(); ?>" alt="<?php echo $movie->getTitle(); ?>" style="max-width: 200px; max-height:300px">
                                </div>
                            </a>
                            <br>
                            <a href="#" style="font-weight: bold;"><?php echo $movie->getTitle(); ?></a>


                        </td>
                
                <?php $count++; }}?>
                </tr>

        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>