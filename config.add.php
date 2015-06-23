

$config['mibs']['ASTERISK-MIB'] = 1;
$config['mibs']['DIGIUM-MIB'] = 1;

$config['poller_modules']['asterisk'] = 1;
$config['discovery_modules']['asterisk'] = 1;

$config['graph_types']['device']['asterisk_channel_type'] = array(
  'order'     => '1',
  'section'   => 'asterisk',
  'descr'     => 'Active Channel Types',
  'file'      => 'asterisk_channels.rrd',
  'unit_text' => 'channels',
  'num_fmt'   => '4.0',
  'no_mag'    => TRUE,
  'ds'        => array(
    'ac_sip'     => array('label' => 'SIP',     'draw' => 'LINE2', 'colour' => '22aa22'),
    'ac_iax2'    => array('label' => 'IAX2',    'draw' => 'LINE2', 'colour' => 'aa2222'),
    'ac_agent'   => array('label' => 'Agent',   'draw' => 'LINE2', 'colour' => '555555'),
    'ac_local'   => array('label' => 'Local',   'draw' => 'LINE2', 'colour' => '555555'),
    'ac_phone'   => array('label' => 'Phone',   'draw' => 'LINE2', 'colour' => '555555'),
    'ac_bridge'  => array('label' => 'Bridge',  'draw' => 'LINE2', 'colour' => '2222aa'),
    'ac_console' => array('label' => 'Console', 'draw' => 'LINE2', 'colour' => '555555'),
    'ac_multicastrtp'  => array('label' => 'MCRTP',    'draw' => 'LINE2', 'colour' => '555555'),
    'ac_confbridgerec' => array('label' => 'ConfBrRec', 'draw' => 'LINE2', 'colour' => 'aa5522'),
  )
);


$config['graph_types']['device']['asterisk_channels'] = array(
  'order'     => '2',
  'section'   => 'asterisk',
  'descr'     => 'Active Channels',
  'file'      => 'asterisk.rrd',
  'colours'   => 'oranges',
  'unit_text' => 'channels',
  'num_fmt'   => '4.0',
  'no_mag'    => TRUE,
  'ds'        => array(
    'asterisk_channels' => array('label' => 'Active channels', 'draw' => 'AREASTACK', 'line' => TRUE, 'rra_min' => FALSE, 'rra_max' => FALSE)
  )
);

$config['graph_types']['device']['asterisk_bridged'] = array(
  'order'     => '3',
  'section'   => 'asterisk',
  'descr'     => 'Active Conversations',
  'file'      => 'asterisk.rrd',
  'colours'   => 'greens',
  'unit_text' => 'conversations',
  'num_fmt'   => '4.0',
  'no_mag'    => TRUE,
  'ds'        => array(
    'asterisk_bridged' => array('label' => 'Active conversations', 'draw' => 'AREA', 'line' => TRUE, 'rra_min' => FALSE, 'rra_max' => FALSE)
  )
);

$config['graph_types']['device']['asterisk_processed'] = array(
  'order'     => '4',
  'section'   => 'asterisk',
  'descr'     => 'Processed Calls',
  'file'      => 'asterisk.rrd',
  'colours'   => 'blues',
  'unit_text' => 'calls',
  'num_fmt'   => '8.0',
  'no_mag'    => TRUE,
  'nototal' => FALSE,
  'rra_min' => FALSE,
  'rra_max' => FALSE,
  'ds'        => array(
    'asterisk_processed' => array('label' => 'Processed calls', 'draw' => 'AREA', 'line' => TRUE, 'rra_min' => FALSE, 'rra_max' => FALSE),
  )
);

$config['overview_asterisk']['diff_from'] = 21600;
