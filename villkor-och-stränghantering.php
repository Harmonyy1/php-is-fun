<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php

        $siffror = array("ett", "två", "tre", "fyra", "fem", "sex", "sju", "åtta", "nio", "tio");

        for($i=1; $i<11; $i++){
            echo "Rad: ".$siffror[$i-1]."<br>";
        }

    ?>

    
</body>
</html>