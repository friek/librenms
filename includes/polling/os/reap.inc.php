<?php
/**
 * Created by Johan Mulder <johan@cambrium.nl>
 * Date: 2014-12-24 14:42
 */

$hardware = snmp_get($device, "SNMPv2-SMI::mib-2.47.1.1.1.1.13.1", "-OQsv", "SNMPv2-SMI");
$serial = snmp_get($device, "SNMPv2-SMI::mib-2.47.1.1.1.1.11.1", "-OQsv", "SNMPv2-SMI");
$version = snmp_get($device, "SNMPv2-SMI::mib-2.47.1.1.1.1.10.1", "-OQsv", "SNMPv2-SMI");


