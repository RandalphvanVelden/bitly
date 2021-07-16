<div class="header">
<?php
// header met inlog/uitlog knop en wie er is ingelogd
if(isset($token))
     {
          echo "logged in as $user";?>
          <button class="button log" type="submit" onClick="parent.location='destroysession.php'" >log out</button>
     <?php 
     }

else {?>
          <button class="button log" onClick="parent.location='login.php'">log in</button>
     <?php 
     } ?> 
     </div>