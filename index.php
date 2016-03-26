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
    <h2>PHP Form Validation Example</h2>
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
    echo "<h2>Your Input:</h2>";
    echo $artist;
    echo "<br>";
    echo $song;
    ?>



  </body>
</html>
