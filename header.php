<?php
if(!isset($token)){?>
<button class="button" onClick="parent.location='login.php'">log in</button>
<?php }
else {
     echo "logged in as $user";?>
<button class="button" type="submit" onClick="parent.location='destroysession.php'" >log out</button>
<?php } ?> 