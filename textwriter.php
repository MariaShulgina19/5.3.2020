<?php

// php-tiedosto joka avustaa highscore-tiedostoon kirjoittamisessa
// lähde: https://www.dreamincode.net/forums/topic/69055-how-to-save-a-txt-file-to-a-server-using-php-code/

// Open the file in write mode
$handle = fopen("coordinates.txt","w+");
// If successful
if ($handle && isset($_POST["newlist"])) {
    $newlist = explode(",", $_POST["newlist"]);
    // Write to that handle the username submitted in the form and the date
    fwrite($handle, $newlist[0] . "\n" . $newlist[1]);
    // Close the file
    fclose($handle);

    echo "OK";
}
else
{
    echo "NOK";
}
?>