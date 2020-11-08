<?php
require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);">
    <div class="content" style="background-color: rgba(0, 0, 0, 0);">
      <div class="scrollable">

        <br>
        <form action="<?php echo FRONT_ROOT . "Room/modifyANDremover" ?> " method="post">
          <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px"> Room List from <a href="#"><?php echo $cinema->getName() . " Cinema"; ?></a> </span></h2>
          <table style="text-align:center;">
            <thead>
              <tr>
                <?php if (isset($message)) {
                  echo "<h3>" . $message . "</h3><br>";
                } ?>
                <th style="width: 10%;">Name</th>
                <th style="width: 10%;">Capacity</th>
                <th style="width: 10%;">ticketValue</th>
                <th style="width: 10%;">Cinema</th>
                <th style="width: 30%;">Action</th>
              </tr>
              <td style="background-color: #1a1c20;">
                <span style="color: yellow; padding: 2px; font-weight: bold"><a href="<?php echo FRONT_ROOT . "Room/ShowAddRoomView" . "?id_cinema=" . $cinema->getId_Cinema(); ?>">+Add</a></span>
              </td>
              <td style="background-color: #1a1c20">
                - - - -
              </td>
              <td style="background-color: #1a1c20">
                - - - -
              </td>
              <td style="background-color: #1a1c20">
                - - - -
              </td>
              <td style="background-color: #1a1c20">
                - - - -
              </td>
            </thead>
            <tbody>
              <?php if (is_array($roomList)) {
                foreach ($roomList as $Room) {
              ?>
                  <tr>
                    <td> <?php echo $Room->GetName(); ?> </td>
                    <td> <?php echo $Room->GetCapacity(); ?> </td>
                    <td> <?php echo $Room->GetTicketValue(); ?> </td>
                    <td> <?php echo $Room->GetCinema()->getName() ?> </td>
                    
                    <td><?php if($_SESSION["loginUser"]->getRole()==1){ ?>
                      <button type="submit" name="id_remove" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Remove </button>
                      <button type="submit" name="id_modify" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Modify </button>
                      <button type="submit" name="id_add_screenings" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Add Screenings </button>
                    <?php } ?>

                    <input id="id_cinema" name="id_cinema" type="hidden" value="<?php echo $cinema->getId_Cinema();?>">
                      <button type="submit" name="id_show_screenings" class="btn" value="<?php echo $Room->getId_room() ?>" style="font-size: 12px"> Show Screenings </button>
                      
                    </td>
                  </tr>
              <?php
                }
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