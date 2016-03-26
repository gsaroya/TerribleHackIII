#!/bin/bash
if [ "$#" -ne 2 ]; then
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

  # Convert wav to mp3
  y | lame $wav ${name}wav.mp3

  len1=`mp3info -p "%S" ${name}wav.mp3`
  len2=`mp3info -p "%S" ${name}low.mp3`
  if [[ $len1 < $len2 ]]; then
    # Merge together
    y | ffmpeg -i ${name}wav.mp3 -i ${name}low.mp3 -filter_complex amerge -ac 2 -c:a libmp3lame -q:a 4 ${name}.mp3
  else
    # Merge together
    y | ffmpeg -i ${name}low.mp3 -i ${name}wav.mp3 -filter_complex amerge -ac 2 -c:a libmp3lame -q:a 4 ${name}.mp3
  fi

else
  wav=$1
  name=$2
  echo $wav
  # Convert wav to mp3
  y | lame $wav ${name}.mp3
fi
