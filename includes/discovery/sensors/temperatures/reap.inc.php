<?php
/**
 * Created by Johan Mulder <johan@cambrium.nl>
 * Date: 2016-03-25 13:28
 */


if ($device['os'] == 'reap') {
    echo "REAP system temperature:\n";

    // System temperature.
    $mib_dir = $config['install_dir'] . '/mibs:' . $config['install_dir'] . '/mibs/raisecom';
    $reap_array['temp'] = snmpwalk_cache_multi_oid($device, "raisecomTemperatureValue",
        array(), "RAISECOM-SYSTEM-MIB", $mib_dir);

    if (is_array($reap_array) && count($reap_array)) {
        foreach ($reap_array as $index => $sys_temp) {
            var_dump($sys_temp);
            $oid = '.1.3.6.1.4.1.8886.1.1.4.2.1.0';
            $value = intval($sys_temp[1]);

            $descr = 'System temperature';
            discover_sensor($valid['sensor'], 'temperature', $device, $oid, 0, 'reap', $descr, 1, 1, 0, 40, 55);
        }
    }
}
