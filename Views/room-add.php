<?php require_once('nav-bar.php'); ?>

<div class="wrapper row4 diseño" style="position: fixed;top: 23%; background-color:rgba(0,0,0,0)">
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
        <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Add New Room</span></h2>
        <form action="<?php echo  FRONT_ROOT."Room/AddRoom"?>" method="post" style="padding: 2rem !important;" >
          <table style="max-width: 60%"> 
            <thead>
              <tr>
              <?php if($message){ echo "<h3>". $message ."</h3><br>";}?>
              </tr>
              <tr>
                <th>Name</th>
                <th>Capacity</th>
                <th>ticketValue</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="width: 30%;">
                  <input type="text" name="name" min="1" max="30" size="30"  placeholder="Name of the Room" required>
                </td>
                <td style="width: 30%;">
                  <input type="number" name="capacity"  min="50" max="300" size="20" placeholder="Capacity of the room" required>
                </td> 
                <td style="width: 30%;">
                  <input type="number" name="ticketValue" min="50" max="1500" size="20"  placeholder="Ticket Value" required>
                </td>           
              </tr>
              </tbody>
          </table>
          <div>
            <br>
            <input type="submit" class="btn" value="Add Room" style="background-color:#DC8E47;color:white;"/>
            <br>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
</div>