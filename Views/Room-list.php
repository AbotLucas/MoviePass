<?php
 require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);"> 
    <div class="content" style="background-color: rgba(0, 0, 0, 0);"> 
      <div class="scrollable">
      <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Cinemas List</span></h2>
      <br>
      <form action="<?php echo FRONT_ROOT."Room/ShowListRoomView"?> " method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
           
            <th style="width: 20%;">Name</th>
            <th style="width: 20%;">Capacity</th>
            <th style="width: 30%;">ticketValue</th>
            <th style="width: 30%;">Cinema</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($roomList as $Room)
          {
               ?>
            <tr>
                <td> <?php echo $Room->GetName(); ?> </td>
                <td> <?php echo $Room->GetCapacity(); ?> </td>
                <td> <?php echo $Room->GetTicketValue(); ?> </td>
                <td> <?php echo $Room->GetCinema(); ?> </td>          
                <td>
                <button type="submit" name="id_remove" class="btn" value="<?php echo $Room->getId_room() ?>"style="font-size: 12px"> Remove </button>
                <button type="submit" name="id_modify" class="btn" value="<?php echo $Cinema->getId_room() ?>"style="font-size: 12px"> modify </button>
            
                </td>
                
            </tr> 
          <?php 
        }
         ?>                
        </tbody></form>
        </table> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
</div>