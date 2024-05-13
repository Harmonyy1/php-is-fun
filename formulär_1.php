<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body> 
    
<?php
if(isset($_POST["submit"])) 
{
    echo $_POST["name"]; 
    echo "<br>";
    echo $_POST["password"];
}

else{


?>
    <form action="formulär_1.php" method="post">
        <input type="text" name="name">
        <input type="password" name="password">
        <input type="submit" name="submit" value="Logga in">
    </form>
    
<?php } ?>
</body>
</html>