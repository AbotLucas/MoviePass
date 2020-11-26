<?php

use Controllers\CinemaController;

include("nav-bar.php");

$NewCinemaController = new CinemaController();
$Cinemas_List = $NewCinemaController->getCinemasList();

?>
<div class="wrapper row4 diseño" style="position: fixed;top: 23%; background-color: rgba(0,0,0,0);">
    <main class="container clear centrado" >
        <div class="content">
            <div id="comments">
            <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Add New Screening</span></h2>
                <form action="<?php echo  FRONT_ROOT . "Screening/AddScreening/".$id_movie?>" method="post" style="padding: 2rem !important;">
                    <table style="width: 75%;">
                        <thead>
                            <tr>
                                <?php if ($message) {
                                    echo "<h3>" . $message . "</h3><br>";
                                } ?>
                            </tr>
                            <tr>
                                <th style="width: 8%;"><label for="movie_screening">Id Movie</label></th>
                                <th><label for="cinema_screening">Cinema</label></th>
                                <!-- <th><label for="room_screening">Room</label></th> -->
                                <th><label for="date_screening">Date</label></th>
                                <th><label for="hour_screening">Hour</label></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 10%;">
                                    <input type="text" name="id_movie" value="<?php echo $id_movie ?>" placeholder="<?php echo $id_movie ?>" style="height: 30px; weight: 50px; position:relative; vertical-align:middle;">
                                </td>
                                <td style="max-width: 25%; align-items: center;">
                                    <select name="cinema_screening" id="cinema_screening" style="width: 100%; margin-top: 10px;" required>
                                            <option value="" disable_selected>--Choose a Cinema--</option>
                                            <?php foreach($Cinemas_List as $Cinema){ ?>
                                            <option value="<?php echo $Cinema->getId_Cinema(); ?>"><?php echo $Cinema->getName();?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                                <!-- <td style="max-width: 25%; align-items: center;">
                                <select name="room_screening" id="room_screening" style="width: 100%; margin-top: 10px;" required>
                                            <option value="" disable_selected>--Choose a Room--</option>
                                            <option value="1">Room1</option>
                                            <option value="2">Room2</option>
                                    </select>
                                </td> -->
                                <td style="max-width: 25%; align-items: center;">
                                <input type="date" name="date_screening" id="date_screening" style="width: 100%;" required>
                                </td>
                                <td style="max-width: 25%; align-items: center;">
                                <input type="time" name="hour_screening" id="hour_screening" style="width: 100%;" min="14:00:00" max="23:00:00" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <br>
                        <input type="submit" class="btn" value="Add Screening" style="background-color:#DC8E47;color:white;" />
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<?php
include('footer.php');
?>