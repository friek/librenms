<?php
/**
 * Created by Johan Mulder <johan@cambrium.nl>
 * Date: 2014-12-24 15:19
 */

echo "REAP system temperature:\n";

// System temperature.
$reap_array['temp'] = snmpwalk_cache_multi_oid($device, "raisecomTemperatureValue",
    array(), "RAISECOM-SYSTEM-MIB", $config['install_dir'] . '/mibs/raisecom');

if (is_array($reap_array) && count($reap_array))
{
	foreach ($reap_array as $index => $sys_temp)
	{
		var_dump($sys_temp);
		$oid = '.1.3.6.1.4.1.8886.1.1.4.2.1.0';
		$value = intval($sys_temp[1]);

		$descr = 'System temperature';
		discover_sensor($valid['sensor'], 'temperature', $device, $oid, 0, 'reap', $descr, $scale, $value);
	}
}

echo "REAP fans:\n";

$reap_array['fan'] = snmpwalk_cache_multi_oid($device, 'raisecomFanMonitorStateTable',
    array(), 'RAISECOM-FANMONITOR-MIB', $config['install_dir'] . '/mibs/raisecom');
var_dump($reap_array['fan']);
$scale = 1;

foreach ($reap_array['fan'] as $index => $entry)
{
	echo "$index -> {$entry['raisecomFanSpeedValue']}\n";
	$oid = '.1.3.6.1.4.1.8886.1.1.5.2.2.1.2.' . $index;
	$value = intval($entry['raisecomFanSpeedValue']);
	$descr = 'Fan ' . $index;

	discover_sensor($valid['sensor'], 'fanspeed', $device, $oid, $index, 'reap', $descr, $scale, $value);
}
