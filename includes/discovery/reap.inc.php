<?php
/**
 * Created by Johan Mulder <johan@cambrium.nl>
 * Date: 2014-12-24 13:56
 */

if ($device['os'] == 'reap') {
	$rds = snmp_get($device, "raisecomTotalMemory.0", "", "RAISECOM-SYSTEM-MIB",
        $config['install_dir'] . '/mibs/raisecom');
}
