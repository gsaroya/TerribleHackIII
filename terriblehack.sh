#!/bin/bash

myzip = $1
#mp3 = $2
#location = $3

curl -sS myzip > myzip.zip

unzip myzip.zip

timidity -Ow -o - *.midi | lame - output.mp3