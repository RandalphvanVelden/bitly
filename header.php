<?php
// header met inlog/uitlog knop en wie er is ingelogd
if(isset($token)){
echo "logged in as $user";?>
<button class="button" type="submit" onClick="parent.location='destroysession.php'" >log out</button>
<?php }
else {?>
     <button class="button" onClick="parent.location='login.php'">log in</button>
<?php } ?> 