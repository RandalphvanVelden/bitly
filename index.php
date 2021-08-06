
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <div class ="content">
 <?php
 include 'session.php';

 include 'header.php';
 
 include 'bitlyconnect.php';

 include 'tables.php';

 include 'classes.php';

$long_url = ''; 
$title = '';
$var= '0';
$ch = '';
$method = '';
$visibility = '';
$group = '';

 ?>

<!-- formulier voor het toevoegen van een bitly -->
 <form  class= "add-content" action="index.php" method="POST">

 URL: <input type = "text" placeholder = "paste long URL" name = "long_url"  required>
 Title: <input type = "text" placeholder = "titel" name = "title" required>
 
 <button class ="button" type = "submit">Save</button>
 
 </form>

<?php
// toevoegen van eeen link
if(isset($_POST['long_url']))
    {
        $long_url = htmlspecialchars($_POST['long_url']);
    }

if(isset($_POST['title']))
    {
        $title = htmlspecialchars($_POST['title']);
    }

 // toevoegen van de nieuwe link bij bitly
$data= array('title'=>$title, 'long_url'=>$long_url );
$id = 'none';
$method ='post';

$newLink = new Connect($data, $id, $token, $method, $visibility, $group);
$newLink->connect();

?>

<!-- voor meerdere groepen -->

<div class="group-choice"> 
<form  action="" method="post">
    <select name="var" onchange="this.form.submit();">
<?php foreach($groups['groups'] as $group){
    $group = $group['guid'];?>
    <option value="<?php $group ?>"><?php echo $group ?></option>                
<?php   
}?>
  </select>
</form> 
</div>
<?php
$choice=new Choice();
$choice->form();
$visibility = $choice->visibility;


$table = new Table($data, $id, $token, $method, $visibility, $group);
$table->table();




?>
    </div>
    </div>


</body>


