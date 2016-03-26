<?php
//$artist = "Rick Astley";
//$song = "Never Gonna Give You Up";
$lyrics_url = strtolower($artist . "&song=" . $song);
$the_name = $search = str_replace(" ", "_", $song);
$lyrics_url = "http://api.chartlyrics.com/apiv1.asmx/SearchLyricDirect?artist=" . $lyrics_url;
$xml = simplexml_load_file($lyrics_url);
$lyrics = $xml->Lyric;
$lyrics = trim($lyrics);
$lyrics = stripslashes($lyrics);
$lyrics = htmlspecialchars($lyrics);
$lyrics = preg_replace( "/\r|\n/", ". ", $lyrics );
$cmd1 = 'echo "' . $lyrics . '" > ' . $the_name . '.txt';
$output = shell_exec($cmd1);
$output = shell_exec('cat -A ' . $the_name . '.txt | text2wave -o ' . $the_name . '.wav');
?>
