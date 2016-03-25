<?php
/**
 * Created by Johan Mulder <johan@cambrium.nl>
 * Date: 2014-12-24 15:19
 */

if ($device['os'] == 'reap') {
    echo "REAP fans:\n";

    $mib_dir = $config['install_dir'] . '/mibs:' . $config['install_dir'] . '/mibs/raisecom';
    $reap_array['fan'] = snmpwalk_cache_multi_oid($device, 'raisecomFanMonitorStateTable',
        array(), 'RAISECOM-FANMONITOR-MIB', $mib_dir);

    foreach ($reap_array['fan'] as $index => $entry) {
        echo "$index -> {$entry['raisecomFanSpeedValue']}\n";
        $oid = '.1.3.6.1.4.1.8886.1.1.5.2.2.1.2.' . $index;
        $value = intval($entry['raisecomFanSpeedValue']);
        $descr = 'Fan ' . $index;

        discover_sensor($valid['sensor'], 'fanspeed', $device, $oid, $index, 'reap', $descr, 1, 1, 0, 500, 1000, 6000);
    }
}
