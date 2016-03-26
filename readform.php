<?php
// define variables and set to empty values
$artistErr = $songErr = "";
$song = $artist = $zip_link = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["artist"])) {
     $artistErr = "Artist is required";
   } else {
     $artist = test_input($_POST["artist"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$artist)) {
       //$artistErr = "Only letters and white space allowed";
     }
   }
   if (empty($_POST["song"])) {
     $songErr = "Song is required";
   } else {
     $song = test_input($_POST["song"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$song)) {
       //$songErr = "Only letters and white space allowed";
     }
   }

   include('getzip.php');
   include('tts.php');
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
