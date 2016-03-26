#!/bin/bash

$wav = $1
$myzip = ""
if [$# -ne 1];
    then $myzip = $2
fi

# Extract midi file
$midi = zipinfo -1 myzip.zip
curl -sS $myzip > myzip.zip
unzip myzip.zip
rm myzip.zip

# Convert midi to mp3
timidity -Ow -o - $midi | lame - $wav.mp3
