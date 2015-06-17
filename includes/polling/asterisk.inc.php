<?php

// file_put_contents('/tmp/asterisk.inc.txt', var_export($device, true));

if ($device['type'] == 'voip')
{
    echo("VOIP:\n");
    include("includes/include-dir-mib.inc.php");

    $asterisk_rrd = "asterisk.rrd";
    $asterisk_channels_rrd = "asterisk_channels.rrd";

    $ast_proc_calls = snmp_walk($device, "astConfigCallsProcessed", "-OUqnv", "ASTERISK-MIB", $mibdir, FALSE) + 0;
    echo("Asterisk processed calls: " . $ast_proc_calls . "\n");

    $ast_channels = snmp_walk($device, "astNumChannels",  "-OUqnv", "ASTERISK-MIB", $mibdir, FALSE) + 0;
    echo("         number of active channels: " . $ast_channels . "\n");

    $ast_bridged = snmp_walk($device, "astNumChanBridge", "-OUqnv", "ASTERISK-MIB", $mibdir, FALSE) + 0;
    echo("         number of bridged channels: " . $ast_bridged . "\n");

    echo("\n");

    // "index" => ".1.3.6.1.4.1.22736.1.5.4.1.1"
    $ast_chan_oid = array(
        "name"  => ".1.3.6.1.4.1.22736.1.5.4.1.2",
        "descr" => ".1.3.6.1.4.1.22736.1.5.4.1.3",
        "count" => ".1.3.6.1.4.1.22736.1.5.4.1.7",
    );

    $ast_chan = array();
    foreach ($ast_chan_oid as $oid_name => $oid_num) {
        $chan__ = explode(PHP_EOL, snmp_walk($device, $oid_num, "-Oqn", "ASTERISK-MIB", $mibdir, FALSE));
        foreach ($chan__ as $str__) {
            $data__ = explode(" ", str_replace($oid_num.".", "", $str__), 2);
            $ast_chan[$data__[0]][$oid_name] = $data__[1];
        }
    }

    $rrd_ds_string = " ";
    $rrd_ds_update_data = array();
    foreach ($ast_chan as $chan) {
        $rrd_ds_string = $rrd_ds_string . "DS:" . "ac_" . strtolower($chan['name']) . ":GAUGE:600:0:U ";
        $rrd_ds_update_data[] = $chan['count'];
        echo("         " . $chan['name'] . " channels: " . $chan['count'] . "\n");
    }

    rrdtool_create($device, $asterisk_channels_rrd, $rrd_ds_string);

    rrdtool_update($device, $asterisk_channels_rrd, $rrd_ds_update_data);

    $graphs['asterisk_channel_type'] = TRUE;

    rrdtool_create($device, $asterisk_rrd, " \
        DS:asterisk_processed:GAUGE:600:0:U \
        DS:asterisk_channels:GAUGE:600:0:U \
        DS:asterisk_bridged:GAUGE:600:0:U \
        ");

    rrdtool_update($device, $asterisk_rrd, array($ast_proc_calls, $ast_channels, $ast_bridged));

    $graphs['asterisk_processed'] = TRUE;
    $graphs['asterisk_channels'] = TRUE;
    $graphs['asterisk_bridged'] = TRUE;

}

echo(PHP_EOL);

// EOF

