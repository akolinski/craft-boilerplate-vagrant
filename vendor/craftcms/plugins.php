<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'topshelfcraft/environment-label' => 
  array (
    'class' => 'topshelfcraft\\environmentlabel\\EnvironmentLabel',
    'basePath' => $vendorDir . '/topshelfcraft/environment-label/src',
    'handle' => 'environment-label',
    'aliases' => 
    array (
      '@topshelfcraft/environmentlabel' => $vendorDir . '/topshelfcraft/environment-label/src',
    ),
    'name' => 'Environment Label',
    'version' => '3.2.0',
    'schemaVersion' => '1.0.0',
    'description' => '...so you don\'t forget where you are.',
    'developer' => 'Top Shelf Craft (Michael Rog)',
    'developerUrl' => 'https://topshelfcraft.com',
    'documentationUrl' => 'https://github.com/TopShelfCraft/Environment-Label',
    'changelogUrl' => 'https://raw.githubusercontent.com/TopShelfCraft/Environment-Label/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
    'components' => 
    array (
      'label' => 'topshelfcraft\\environmentlabel\\services\\Label',
    ),
  ),
);
