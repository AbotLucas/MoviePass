<?php
require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);">
    <div class="content" style="background-color: rgba(0, 0, 0, 0);">
      <div class="scrollable">
        <br>
        <form action="" method="">
        <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">You Buy <a href="#" style="font-size: 16px;"><?php # echo $buyUp->getTicket()->getUser();?></a></span></h2>
      <br>
        <table style="text-align:center;">
          <thead>
            <tr>
            <th style="width: 20%;">Cinema/Room</th>
            <th style="width: 25%;">Movie</th>
            <th style="width: 15%;" >Date</th>
            <th style="width: 15%;" >Hour</th>
            <th style="width: 25%;" >ticketquantity</th>
            <th style="width: 25%;" >ticket value</th>
            <th style="width: 25%;" >total tickets</th>
            </tr>
          <tbody>
          <?php  foreach($listBuyUpUser as $buyUp){
               ?>
            <tr>
                <td> <?php echo $buyUp->getTicket()->getScreening()->getRoom()->getCinema()->getName()."/". $buyUp->getTicket()->getScreening()->getRoom()->getName(); ?> </td>
                <td> <?php echo $buyUp->getTicket()->getScreening()->getMovie()->getTitle() ?> </td>
                <td> <?php echo $buyUp->getTicket()->getScreening()->getDate_screening() ?> </td>
                <td> <?php echo $buyUp->getTicket()->getScreening()->getHour_screening() ?> </td>
                <td> <?php echo $buyUp->getTicketquantity() ?> </td>
                <?php echo $buyUp->getTicket()->getScreening()->getRoom()->getTicketValue()?> </td>
                <td> <?php echo $buyUp->getTotal() ?> </td>
            </tr> 
          <?php 
            }
         ?>     
            </tbody>
        </form>
        </table>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
</div>







































