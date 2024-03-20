<?php

use Composer\Semver\Comparator;

/**
 * #ddev-generated
 * Documentation for these can be found on default.settings.php
 * and example.settings.local.php
 */

/**
 * Assertions.
 *
 * The Drupal project primarily uses runtime assertions to enforce the
 * expectations of the API by failing when incorrect calls are made by code
 * under development.
 *
 * @see http://php.net/assert
 * @see https://www.drupal.org/node/2492225
 *
 * It is strongly recommended that you set zend.assertions=1 in the PHP.ini file
 * (It cannot be changed from .htaccess or runtime) on development machines and
 * to 0 or -1 in production.
 */

// If for some reason you need to avoid this site on a project, you can add
// DDEV_HANOII_DRUPAL_SETTINGS_DISABLE=true to your '.ddev/config.yaml'
// file
if (!empty($_ENV['DDEV_HANOII_DRUPAL_SETTINGS_DISABLE'])) {
  return;
}

if (PHP_VERSION_ID < 80300) {
  assert_options(ASSERT_ACTIVE, TRUE);
  assert_options(ASSERT_EXCEPTION, TRUE);
}

// Allow every url
$settings['trusted_host_patterns'] = array(
  '^.*$',
);

$settings['skip_permissions_hardening'] = TRUE;
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
$settings['rebuild_access'] = TRUE;
$settings['extension_discovery_scan_tests'] = TRUE;

// A local dev services.yml file than can be edited as necessary
$settings['container_yamls'][] =  '/var/www/html/.ddev/HANOII/base/assets/drupal/dev.services.yml';

// Disabling caches
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['cache']['bins']['page'] = 'cache.backend.null';

$config['system.logging']['error_level'] = 'verbose';

// Local hash_salt not to use the same as remote ones.
$settings['hash_salt'] = 'development';

// Set temporary directory within the local filesystem.
// https://www.drupal.org/node/3039255
if (Comparator::lessThan(\Drupal::VERSION, '8.8.0')) {
  $config['system.file']['path']['temporary'] = '/tmp';
}
else {
  $settings['file_temp_path'] = '/tmp';
}
// Easilly accessible local private file system
$settings['file_public_path'] = 'sites/default/files';
$settings['file_private_path'] = 'sites/default/private';

// assumes a config split entity with an id of 'development'
$config['config_split.config_split.development']['status'] = TRUE;
$config['stage_file_proxy.settings']['hotlink'] = TRUE;

// This needs to be set manually on some of your project' settings file.
// $config['stage_file_proxy.settings']['origin'] = 'https://www.example.com';

