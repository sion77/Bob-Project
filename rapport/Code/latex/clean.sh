#!/bin/sh
echo "clean.sh >> rm -r *.log rapport.toc rapport.aux rapport.log rapport.synctex.gz"
rm -r *.log rapport.toc rapport.aux rapport.log rapport.synctex.gz

echo "clean.sh >> *~ ../rapport.pdf"
rm -r *~ ../rapport.pdf

echo "clean.sh >> mv rapport.pdf ../rapport.pdf"
mv rapport.pdf ../rapport.pdf

