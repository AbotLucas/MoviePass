<?php
 require_once('nav-bar.php');
?>      
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);"> 
    <div class="content" style="background-color: rgba(0, 0, 0, 0);"> 
      <div class="scrollable">
      <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Add number of ticket</span></h2>
        <form action="<?php  echo FRONT_ROOT."BuyUp/TicketPayAdd/?id_ticket=". $id_ticket ?>" method="post" style="padding: 2rem !important;" >
          <table style="max-width: 60%"> 
            <thead>
              <tr >
              <?php  if(isset($message)){ echo "<span style='color:red; font-weight: bold;' >". $message ."</span><br><br>";}?>
              </tr>
              <tr>
                <th>Numeber Ticket</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="width: 50%;">
                  <input type="number" name="numberTicket" min="1" max="30" size="30"  placeholder="Numeber Ticket" required>
                  <br>
                 
                  <button type="submit" name="add_numeberTicket" value ="<?php echo $id_ticket ?> " class="btn" style="font-size: 12px"  > Add numeber ticket </button>
                </td>
                </tbody></form>
        </table> 
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
