<?php

if ($device['type'] == 'voip')
{
?>

<div class="widget widget-table">
  <div class="widget-header">
    <a href="<?php echo(generate_url(array('page' => 'device', 'device' => $device['device_id'], 'tab' => 'graphs'))); ?>">
      <h3>Asterisk</h3>
    </a>
  </div>
  <div class="widget-content">


<?php
  $graph_array['height'] = "100";
  $graph_array['width']  = "512";
  $graph_array['to']     = $config['time']['now'];
  $graph_array['device'] = $device['device_id'];
  if (isset($config['overview_asterisk']['diff_from'])) {
    $graph_array['from'] = $config['time']['now'] - $config['overview_asterisk']['diff_from'];
  } else {
    $graph_array['from'] = $config['time']['day'];
  }
  $graph_array['legend'] = "no";

  echo('<table class="table table-condensed table-striped table-bordered">');

  foreach($config['graph_types']['device'] as $device_name => $dev_graph) {
    if ($dev_graph['section'] == 'asterisk') {
      $dev_graph['device_name'] = $device_name;
      $ordered_asterisk_graphs[$dev_graph['order']] = $dev_graph;
    }
  }

  ksort($ordered_asterisk_graphs);

  foreach($ordered_asterisk_graphs as $dev_graph) {
        $graph_array['type']   = "device_" . $dev_graph['device_name'] . "";
        $graph = generate_graph_tag($graph_array);

        $link_array = $graph_array;
        $link_array['page'] = "graphs";
        unset($link_array['height'], $link_array['width']);
        $link = generate_url($link_array);

        $overlib_content = generate_overlib_content($graph_array, $device['hostname'] . " - " . $dev_graph['descr']);

        echo('<tr><td>');
        echo(overlib_link($link, $graph, $overlib_content, NULL));
        echo('</td></tr>');
  }
  echo('</table>');

  unset($ifsep);
  echo("</div></div>");
}

// EOF
