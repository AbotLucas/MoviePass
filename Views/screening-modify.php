<?php
include("nav-bar.php");
?>
<div class="wrapper row4 diseño" style="position: fixed;top: 23%; background-color: rgba(0,0,0,0);">
    <main class="container clear centrado" >
        <div class="content">
            <div id="comments">
            
                <form action="<?php echo  FRONT_ROOT . "Screening/modify"?>" method="post" style="padding: 2rem !important;">
                <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Add New Screening in <a href="#" style="font-size: 16px;"><?php echo $room->getName() . " - " . $cinema->getName(); ?></a></span></h2>
                    <table style="width: 75%;">
                        <thead>
                            <tr>
                                <?php if (isset($message)) {
                                    echo "<h3>" . $message . "</h3><br>";
                                } ?>
                            </tr>
                            <tr>
                                <th>Movie</th>
                                <th>Cinema</th>
                                <th>Room</th>
                                <th>Date</th>
                                <th>Hour</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 10%; align-items: center; vertical-align: middle;">
                                    <select name="movie" id="movie" style="width: 100%;">
                                            <option value="" disable_selected>--Choose a Movie--</option>
                                        <?php foreach($movieList as $movie){?>
                                            <option value="<?php echo $movie->getId_Movie(); ?>"><?php echo $movie->getTitle(); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="max-width: 25%; align-items: center; vertical-align: middle;">
                                    <span><?php echo $cinema->getName(); ?></span>
                                    <input type="hidden" value="<?php echo $cinema->getId_Cinema(); ?>" name="id_cinema">
                                </td>
                                </td>
                                <td style="max-width: 25%; align-items: center; vertical-align: middle;">
                                    <span><?php echo $room->getName(); ?></span>
                                    <input type="hidden" value="<?php echo $room->getId_room(); ?>" name="id_room">
                                </td>
                                <td style="max-width: 25%; align-items: center; vertical-align: middle;">
                                <input type="date" min="<?php echo $actualDate ?>" max="<?php echo $maxDate ?>" name="date_screening" id="date_screening" style="width: 100%;" required>
                                </td>
                                <td style="max-width: 25%; align-items: center; vertical-align: middle;">
                                <select name="hour_screening" id="hour_screening" style="width: 100%;" required>
                                            <option value="" disable_selected>--Choose an Hour--</option>
                                            <option value="14:00">14:00</option>
                                            <option value="15:00">15:00</option>
                                            <option value="16:00">16:00</option>
                                            <option value="17:00">17:00</option>
                                            <option value="18:00">18:00</option>
                                            <option value="19:00">19:00</option>
                                            <option value="20:00">20:00</option>
                                            <option value="21:00">21:00</option>
                                            <option value="22:00">22:00</option>
                                            <option value="23:00">23:00</option>
                                    </select>
                                </td>
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