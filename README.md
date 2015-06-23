## observium-asterisk-poller
Observium poller for asterisk metrics and overview page widget (add Astrisk as device and work without unix agent)


### Installation
###### Don't forget to update [Asterisk](https://wiki.asterisk.org/wiki/display/AST/Asterisk+MIB+Definitions) and [Digium](https://wiki.asterisk.org/wiki/display/AST/Digium+MIB+Definitions) MIB files in Observium's mibs directory

    git clone http://github.com/gusevaleksei/observium-asterisk-poller observium-asterisk-poller
    cd observium-asterisk-poller/
    cp -rf includes html mibs /path/to/observium/
    cat config.add.php >> /path/to/observium/config.php

### Additional Customizations

##### Add new graphs to device's "Graphs" tab

    sed -i "s/^\$config\['graph_sections'\] = array(/\$config\['graph_sections'\] = array('asterisk',/" \
    /path/to/observium/includes/definitions/graphtypes.inc.php

Or open /path/to/observium/includes/definitions/graphtypes.inc.php , find

    $config['graph_sections'] = array(...

and add 'asterisk' to it

##### Add new graphs to device's "header"

Open /path/to/observium/includes/definitions/os.inc.php, find

    $os = "linux";

Then find rows, little bit lower:

    $config['os'][$os]['over'][0]['graph'] = "device_processor";
    $config['os'][$os]['over'][1]['graph'] = "device_ucd_memory";

After the rows add:

    $config['os'][$os]['over'][]['graph'] = "device_GRAPH_NAME";

for example:

    $os = "linux";
    ...
    $config['os'][$os]['over'][0]['graph'] = "device_processor";
    $config['os'][$os]['over'][1]['graph'] = "device_ucd_memory";
    $config['os'][$os]['over'][2]['graph'] = "device_storage";
    $config['os'][$os]['over'][3]['graph'] = "device_bits";
    $config['os'][$os]['over'][]['graph'] = "device_asterisk_processed";


##### New graphs on device overview page

In file /path/to/observium/html/pages/device/overview.inc.php

    ...
    /* Begin Left Pane */
    include("overview/information.inc.php");
    include("overview/asterisk.inc.php");
    include("overview/ports.inc.php");


