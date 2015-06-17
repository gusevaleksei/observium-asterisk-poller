

$config['mibs']['ASTERISK-MIB'] = 1;
$config['mibs']['DIGIUM-MIB'] = 1;

$config['poller_modules']['asterisk'] = 1;
$config['discovery_modules']['asterisk'] = 1;


$config['graph_types']['device']['asterisk_channels'] = array(
  'order'     => '1',
  'section'   => 'asterisk',
  'descr'     => 'Active Channels',
  'file'      => 'asterisk.rrd',
  'colours'   => 'oranges',
  'unit_text' => 'channels',
  'num_fmt'   => '8.0',
  'no_mag'    => TRUE,
  'ds'        => array(
    'asterisk_channels' => array('label' => 'Active channels', 'draw' => 'AREASTACK', 'line' => TRUE, 'rra_min' => FALSE, 'rra_max' => FALSE)
  )
);

$config['graph_types']['device']['asterisk_bridged'] = array(
  'order'     => '2',
  'section'   => 'asterisk',
  'descr'     => 'Active Conversations',
  'file'      => 'asterisk.rrd',
  'colours'   => 'greens',
  'unit_text' => 'conversations',
  'num_fmt'   => '8.0',
  'no_mag'    => TRUE,
  'ds'        => array(
    'asterisk_bridged' => array('label' => 'Active conversations', 'draw' => 'AREA', 'line' => TRUE, 'rra_min' => FALSE, 'rra_max' => FALSE)
  )
);

$config['graph_types']['device']['asterisk_processed'] = array(
  'order'     => '3',
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


