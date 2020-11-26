<?php
require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);">
    <div class="content" style="background-color: rgba(0, 0, 0, 0);">
      <div class="scrollable">
        <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Screening Stats</span></h2>
        <form action="<?php echo FRONT_ROOT . "Ticket/PayTickets"  ?>" method="post" style="padding: 2rem !important;">
          <table style="max-width: 60%">
            <thead>
            
              <th colspan="3">
                Movie: <?php echo $screening->getMovie()->getTitle(); ?>
              </th>

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
                <td>
                  Date: <?php echo $screening->getDate_screening() ?>
                </td>
                <td>
                  Hour: <?php echo $screening->getHour_screening() ?>
                </td>
                <td>
                  Value: <?php echo $screening->getRoom()->getTicketValue() ?>
                </td>
              </tr>
              <tr>
                <td  style="color: yellow; font-weight:bold;">
                    Sold: <?php echo $cantidadVendida; ?>
                </td>
                <td colspan="2" style="color: yellow; font-weight:bold; width:50%">
                    Rest: <?php echo $remanente; ?>
                </td>
              </tr>

            </tbody>
        </form>
        </table>
        <!-- / main body -->
        <div class="clear"></div>
  </main>
</div>