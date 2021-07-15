<?php
 include 'session.php';

 include 'header.php';
 
 ?>

<!-- formulier voor het toevoegen van een bitly -->
 <form action="index.php" method="POST">

 URL: <input type = "text" placeholder = "paste long URL" name = "long_url"  required>
 Title: <input type = "text" placeholder = "titel" name = "title" required>
 
 <button type = "submit" class="button">Save</button>
 
 </form>

<?php
$long_url = ''; 
$title = '';
$var= '0';

if(isset($_POST['long_url'])){
    $long_url = htmlspecialchars($_POST['long_url']);
}

if(isset($_POST['title'])){
    $title = htmlspecialchars($_POST['title']);
}
 // toevoegen van de nieuwe link bij bitly
$data= array('title'=>$title, 'long_url'=>$long_url );
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/bitlinks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$headers = array();
$headers[] = "Authorization: Bearer {$token}";
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>

<!-- weergave van de links in een tabel -->
<table>
<thead>
 <tr>
 <th> tabel </th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <td>id</td>
 <td>naam</td>
 <td> link</td> 
 <td><form action="" method="post">
<select name="var" onchange="this.form.submit();">
<option value="0">visibility</option>
<option value="1">visible</option>
<option value="2">hidden</option>
<option value="3">both</option>
</select>
</form> </td>
 </tr>

 <?php 
if(isset($_POST['var'])){
    $var = $_POST['var'];
       
if ($var == 1) include 'visibleTable.php';
if ($var == 2) include 'hiddenTable.php';
if ($var == 3){ include 'visibleTable.php'; include 'hiddenTable.php';}
 }

 else include 'visibleTable.php'; 
?>
    </tbody>
    </table>

 



