#!/bin/bash

wav=$1
myzip=$2
name=$3

echo $wav
echo $myzip

# Extract midi file
y | wget $myzip -O myzip.zip
midi=`zipinfo -1 myzip.zip`
echo $midi
y | unzip myzip.zip
y | rm myzip.zip

# Convert midi to mp3
y | timidity -Ow -o - $midi | lame - ${name}midi.mp3
y | ffmpeg -i ${name}midi.mp3 -af "volume=0.35" ${name}low.mp3

# Convery wav to mp3
y | lame $wav ${name}wav.mp3

# Merge together
y | ffmpeg -i ${name}low.mp3 -i ${name}wav.mp3 -filter_complex amerge -ac 2 -c:a libmp3lame -q:a 4 ${name}.mp3
