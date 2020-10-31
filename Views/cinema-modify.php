<?php 
 include('header.php');
 include('nav-bar.php');
?>

<div class="wrapper row4">
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
        <h2>MODIFY CINEMA</h2>
        <form action="<?php echo  FRONT_ROOT."Cinema/modify"?>" method="post" style="padding: 2rem !important;">
          <table> 
            <thead>
              <tr>
                <th>Name</th>
                <th>Adress</th>
                <th>Capacity</th>
                  <th>Ticket Value</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 100px;">
                  <input type="text" name="name" min="1" max="30" size="30"  placeholder="Name of the cinema" required>
                </td>
                <td>
                  <input type="text" name="address" size="20" min="1" max="30" placeholder="Address of the cinema" required>
                </td>
                  <td>
                      <input type="number" name="capacity" size="10" min="50" max="200" placeholder="Max capacity" required>
                  </td>
                  <td>
                  <input type="number" name="ticketValue" size="10" min ="300" max="700" placeholder="Value per ticket" required>
                </td>         
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Add Cinema" style="background-color:#DC8E47;color:white;"/>
            <br>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
<?php 
  include('footer.php');
?>