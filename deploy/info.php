<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'kimchi';
$app['version'] = '1.1.2';
$app['release'] = '1';
$app['vendor'] = 'Marc Laporte';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('kimchi_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('kimchi_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_virtualization');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'kimchi',
    'app-base >= 1:2.3.7',
    'app-nginx-core'
);

$app['core_directory_manifest'] = array(
    '/var/clearos/kimchi' => array(),
    '/var/clearos/kimchi/backup' => array(),
);

$app['core_file_manifest'] = array(
    'wokd.php'=> array('target' => '/var/clearos/base/daemon/wokd.php')
);

$app['delete_dependency'] = array(
    'app-kimchi-core',
    'kimchi',
    'wok',
);
