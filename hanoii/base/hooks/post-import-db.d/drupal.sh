#ddev-generated
#!/bin/bash

if [[ "$DDEV_PROJECT_TYPE" == *"drupal"* ]]; then
  printf "\033[0;36mRunning hanoii/base/hooks/post-import-db.d/drupal.sh...\033[0m\n" "$f"
  drush cr -y
  drush updb -y
  drush cim -y

  /var/www/html/.ddev/hanoii/base/scripts/drupal/drush-uli.sh
fi
