<?php 
 include('header.php');
 include('nav-bar.php');
?>

<div class="wrapper row4 diseño" style="position: fixed;top: 23%; background-color: rgba(0,0,0,0);" >
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
      <h2> <span style="background-color: rgba(115, 64, 70, 0.9); padding: 10px">Modify Cinema</span></h2>
        <form action="<?php echo  FRONT_ROOT."Cinema/modify"?>" method="post" style="padding: 2rem !important;">
          <table style="width:60%"> 
            <thead>
              <tr>
                <th>New Name</th>
                <th>New Address</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="width: 25%;">
                  <input type="text" name="name" min="1" max="30" size="30"  placeholder="Name of the cinema" required>
                </td>
                <td style="width: 25%">
                  <input type="text" name="address" size="20" min="1" max="30" placeholder="Address of the cinema" required>
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