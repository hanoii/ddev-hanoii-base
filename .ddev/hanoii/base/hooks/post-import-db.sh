#!/bin/bash
#ddev-generated
set -e -o pipefail

for f in /var/www/html/.ddev/hanoii/base/hooks/post-import-db.d/*; do
  if [ -x $f ]; then
    $f;
  fi
done
