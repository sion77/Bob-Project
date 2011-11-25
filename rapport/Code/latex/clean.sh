#!/bin/sh
echo "clean.sh >> rm -rf rapport.toc rapport.aux rapport.log rapport.synctex.gz"
rm -rf rapport.toc rapport.aux rapport.log rapport.synctex.gz

echo "clean.sh >> *~"
rm -rf *~

echo "clean.sh >> cp rapport.pdf ../rapport.pdf"
cp rapport.pdf ../rapport.pdf

