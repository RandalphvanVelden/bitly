
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

// voor meerdere groepen
?>
<td><form action="" method="post">
    <select name="var" onchange="this.form.submit();">
<?php foreach($groups['groups'] as $group){
    $group = $group['guid'];?>
    <option value="<?php $group ?>"><?php echo $group ?></option>                
<?php   
}?>
  </select>
                </form> 
<?php
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

if (curl_errno($ch)) 
    {
        echo 'Error:' . curl_error($ch);
    }

curl_close($ch);
?>

<!-- weergave van de links in een tabel -->
<table>
    <thead>
        <tr>
            <th> Bitly links </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>id:</td>
            <td>naam:</td>
            <td> url:</td> 
            <td><form action="" method="post">
                    <select name="var" onchange="this.form.submit();">
                        <option value="0">visibility</option>
                        <option value="1">zichtbaar</option>
                        <option value="2">verborgen</option>
                        <option value="3">beide</option>
                    </select>
                </form> 
            </td>
        </tr>
    <?php 
    // inhoud van de tabel afhankelijk van wat je wil laten zien
    if(isset($_POST['var']))
        {
            $var = $_POST['var'];
            if ($var == 1) include 'visibleTable.php';
            if ($var == 2) include 'hiddenTable.php';
            if ($var == 3){ include 'visibleTable.php'; include 'hiddenTable.php';}
        }

    else include 'visibleTable.php'; 
    ?>
    </tbody>
</table>

 
    </body>


