#!/bin/sh
echo "clean.sh >> rm -rf *.log rapport.toc rapport.aux rapport.log rapport.synctex.gz"
rm -rf *.log rapport.toc rapport.aux rapport.log rapport.synctex.gz

echo "clean.sh >> rm -rf *~ ../rapport.pdf"
rm -rf *~ ../rapport.pdf

echo "clean.sh >> mv rapport.pdf ../rapport.pdf"
mv rapport.pdf ../rapport.pdf

