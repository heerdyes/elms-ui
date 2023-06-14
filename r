#!/usr/bin/env bash
set -euo pipefail
IFS=$'\r\n'

sudo cp *.{html,php,ini} /opt/lampp/htdocs/elms-ui
sudo cp -r {js,css,img} /opt/lampp/htdocs/elms-ui

echo "done!"

