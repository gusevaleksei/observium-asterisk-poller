# observium-asterisk-poller
Small module for polling asterisk metrics over snmp


INSTALL


git clone http://github.com/gusevaleksei/observium-asterisk-poller observium-asterisk-poller

cd observium-asterisk-poller/

cp -rf includes /path/to/observium/

cat config.add.php >> /path/to/observium/config.php


CUSTOMIZE HARD

1. If you want add new graphs to "Graphs" tab of device:

sed -i "s/^\$config\['graph_sections'\] = array(/\$config\['graph_sections'\] = array('asterisk',/" /path/to/observium/includes/definitions/graphtypes.inc.php
Or open /path/to/observium/includes/definitions/graphtypes.inc.php
Find $config['graph_sections'] = array(... and add to it 'asterisk'

2. If you want add new graphs to device "header":

Open /path/to/observium/includes/definitions/os.inc.php
Find "$os = "linux";" then find rows, little bit lower:
    $config['os'][$os]['over'][0]['graph'] = "device_processor";
    $config['os'][$os]['over'][1]['graph'] = "device_ucd_memory";
After them add:
    $config['os'][$os]['over'][]['graph'] = "device_GRAPH_NAME";

For example:
$os = "linux";
...
$config['os'][$os]['over'][0]['graph'] = "device_processor";
$config['os'][$os]['over'][1]['graph'] = "device_ucd_memory";
$config['os'][$os]['over'][2]['graph'] = "device_storage";
$config['os'][$os]['over'][3]['graph'] = "device_bits";
$config['os'][$os]['over'][]['graph'] = "device_asterisk_processed";

3. New graphs on device main page

In file /path/to/observium/html/pages/device/overview.inc.php
...
/* Begin Left Pane */
include("overview/information.inc.php");
include("overview/asterisk.inc.php");
include("overview/ports.inc.php");


