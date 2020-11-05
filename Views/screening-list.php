<?php
 require_once('nav-bar.php');
?>
<div class="wrapper row4 diseño" style="background-color: rgba(0, 0, 0, 0);">
  <main class="hoc container clear" style="background-color: rgba(0, 0, 0, 0);"> 
    <div class="content" style="background-color: rgba(0, 0, 0, 0);"> 
      <div class="scrollable">
      <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Screenings List</span></h2>
      <br>
      <form action="<?php  echo FRONT_ROOT."Screening/modifyANDremove".$id ?> " method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
           
            <th style="width: 15%;">Cinema</th>
            <th style="width: 30%;">Movie</th>
            <th style="width: 15%;" >Date</th>
            <th style="width: 15%;" >Hour</th>
            <th style="width: 25%;" >Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($screeningList as $Screening)
          {
               ?>
            <tr>
                <td> <?php echo $Screening->GetCinema()->getName(); ?> </td>
                <td> <?php echo $Screening->GetMovie()->getTitle(); ?> </td>
                <td> <?php echo $Screening->GetDate_screening(); ?> </td>
                <td> <?php echo $Screening->GetHour_screening(); ?> </td>
                           
                <td>
                <button type="submit" name="id_remove" class="btn" value="<?php echo $Screening->getId_screening() ?>"style="font-size: 12px"> Remove </button>
                &nbsp;
                <button type="submit" name="id_modify" class="btn" value="<?php echo $Screening->getId_screening() ?>"style="font-size: 12px"> Modify </button>

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