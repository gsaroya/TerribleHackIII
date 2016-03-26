<!DOCTYPE HTML>
<html>
  <head>
    <link rel='stylesheet' href="css/style.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <style>
    .error {color: #FF0000;}
    </style>
    <?php include("readform.php"); ?>
  </head>
  <body>
    <h2>Song Generator</h2>
    <p><span class="error">* required field.</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       Artist: <input type="text" name="artist" value="<?php echo $artist;?>">
       <span class="error">* <?php echo $artistErr;?></span>
       <br><br>
       Song: <input type="text" name="song" value="<?php echo $song;?>">
       <span class="error">* <?php echo $songErr;?></span>
       <br><br>
       <input type="submit" name="submit" value="Submit">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $final_name = $artist . "-" . $song;
      $final_name = trim($final_name);
      $final_name = stripslashes($final_name);
      $final_name = htmlspecialchars($final_name);
      $final_name = $final_name = str_replace(" ", "_", $final_name);
      echo "<h2>Your Output:</h2>";
      if (strpos("a" . $zip_link, "http://www.midikaraokes.com/") == 1) {
        //echo "<br/><a href='$zip_link'>zip file</a>";
      } else {
        echo "<br/>Song instrumental not found";
      }
      //echo "<br/><a href='http://159.203.22.56/th/TerribleHackIII/" . $the_name . ".wav'>wav file</a>";
      $cmd2 = "./terriblehack.sh ${the_name}.wav $zip_link $final_name";
      //echo $cmd2;
      $output = shell_exec($cmd2);
      echo "<br/><a href='http://159.203.22.56/th/TerribleHackIII/" . $final_name . ".mp3'>song file</a>";
    }
    ?>
  </body>
</html>
