<?php
 require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);"> 
    <div class="content" style="background-color: rgba(0, 0, 0, 0);"> 
      <div class="scrollable">
     
      <br>
      <form action="<?php echo FRONT_ROOT."Room/modifyANDremover"?> " method="post">
      <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px"> Room List </span></h2>
        <table style="text-align:center;">
          <thead>
            <tr>
            <?php if ($message) { echo "<h3>" . $message . "</h3><br>";} ?>
            <th style="width: 20%;">Name</th>
            <th style="width: 20%;">Capacity</th>
            <th style="width: 20%;">ticketValue</th>
            <th style="width: 20%;">Cinema</th>
            <th style="width: 30%;">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($roomList)) {foreach($roomList as $Room)
          {
               ?>
            <tr>
                <td> <?php echo $Room->GetName(); ?> </td>
                <td> <?php echo $Room->GetCapacity(); ?> </td>
                <td> <?php echo $Room->GetTicketValue(); ?> </td>
                <td> <?php echo $Room->GetCinema()->getName() ?> </td>  
                <td>
               <input id="id_cinema" name="id_cinema" type="hidden" value="<?php echo $Room->GetCinema()->getId_Cinema();?>">
               <button type="submit" name="id_remove" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Remove </button>
               <button type="submit" name="id_modify" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Modify </button> 
                </td>       
           
            </tr> 
           
          <?php 
        }
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