<?php require_once('nav-bar.php');


?>
<div style="text-align: -webkit-center">

    <div class="wrapper row4 diseño" style="background-color: rgba(0,0,0,0);">

        <div style="margin: 5%">

            <div style="display: inline-block;">
                <img src="<?php echo MOVIE_POSTER . $movie->getUrlImage(); ?>" alt="<?php echo $movie->getTitle(); ?>">
            </div>

            <div style="width:60%;  vertical-align: top; display:inline-block; background-color: rgba(115, 64, 70, 0.9); padding: 1%; text-align: left;">
                <h3 style="font-weight: bold; -webkit-text-stroke: 1.25px rgba(50, 31, 40, 1); padding-left: 4%;"><?php echo $movie->getTitle(); ?></h3>
                <p style="background-color:rgba(50, 31, 40, 0.9); padding: 4%">
                    <?php echo "Overview: " . "<br>" . $movie->getOverview() .
                        "<br> Duration: " . $movie->getduration() . " min." .
                        "<br> Language: " . $movie->getLanguage(); ?>
                </p>
                <details style="background-color:rgba(50, 31, 40, 0.9); padding: 4%">
                    <summary>Screenings</summary>
                    
                    <?php foreach($screeningList as $screening) { ?>
                    
                        &nbsp;&nbsp;
                            <?php echo "Date: " . $screening->getDate_screening() . " || " . 
                            "Hour: " . $screening->getHour_screening() . " || Cinema: " . 
                            $screening->getRoom()->getCinema()->getName() . " || Room: " . $screening->getRoom()->getName();?>
                        &nbsp;<b><a href="<?php echo FRONT_ROOT."Ticket/GetTicket/?id_screening=" . $screening->getId_screening();?>">Get ticket!</a></b>
                        <br>
                        

                    <?php } ?>
                        
                </details>

            </div>
        </div>
    </div>

</div>