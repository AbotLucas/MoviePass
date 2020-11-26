<?php
require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
    <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);">
        <div class="content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="scrollable">
                <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Confirm the buy</span></h2>
                <form action="<?php echo  FRONT_ROOT."Ticket/ConfirmTickets"?>" method="post" style="padding: 2rem !important;" >
                <table style="max-width: 60%">
                    <thead>

                        <th colspan="3" style="font-weight: bold; color:yellow;">Movie: <?php echo $screening->getMovie()->getTitle(); ?>

                    </thead>
                    <tbody align="center">
                        <tr>
                            <td>
                                Duration: <?php echo $screening->getMovie()->getDuration(); ?>
                            </td>
                            <td>
                                Cinema: <?php echo $screening->getRoom()->getCinema()->getName(); ?>
                            </td>
                            <td>
                                Room: <?php echo $screening->getRoom()->getName(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 50%;">
                                Date: <?php echo $screening->getDate_screening() ?>
                            </td>
                            <td style="width: 50%;">
                                Hour: <?php echo $screening->getHour_screening() ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: yellow;">
                                Price x Ticket
                            </td>
                            <td style="color: yellow;">
                                Quantity
                            </td>
                            <td style="color: yellow;">
                                Total
                            </td>
                        </tr>
                        <tr>
                            <td>
                                $ <?php echo $screening->getRoom()->getTicketValue(); ?>
                            </td>
                            <td>
                                <?php echo $number; ?>
                            </td>
                            <td style="color: white;">
                                $ <?php echo $totalPrice; ?>
                            </td>
                        </tr>
                    </tbody>
                   <!--  <tfoot>
                        <tr >
                            <td colspan="2" style="width: 50%; align:center;">
                                <button type="button" class="btn" style="width: 30%; height: 35px"><a href=""></a></button>
                            </td>
                            <td style="width: 50%;">
                                <button type="button" class="btn"><a href=""></a></button>
                            </td>
                        </tf>
                    </tfoot> -->
                </table>
                
                <div>
                    <br>
                    <input type="submit" class="btn" value="confirm" style="background-color:#DC8E47;color:white;"/>
                    <input type="submit" class="btn" value="cancel" name="cancel" style="background-color: black;color: #dc8e47;"/>
                    <input id="id_screening" name="id_screening" type="hidden" value="<?php echo $screening->getId_screening() ?>">
                    <input id="number" name="number" type="hidden" value="<?php echo $number ?>">
                </div>
                </form>
                <!-- / main body -->
                <div class="clear"></div>
    </main>
</div>