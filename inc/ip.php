<?php

function openvz_mainip($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  $mainip = $data['value'];
  exec("/usr/local/smartpanel/core/openvz ip ".$container." list 2>&1", $raw);
  $iplist = explode(' ', $raw[0]);
  if (!in_array($mainip, $iplist)) {
    output(NULL, 1);
    return false;
  }
  exec("/usr/local/smartpanel/core/openvz ip ".$container." del all 2>&1", $raw);
  exec("/usr/local/smartpanel/core/openvz ip ".$container." add ".escapeshellarg($mainip)." 2>&1", $raw);
  foreach ($iplist as $ip) {
    if ($mainip != $ip) {
      exec("/usr/local/smartpanel/core/openvz ip ".$container." add ".$ip." 2>&1", $raw);
      if (explode(' ', $raw[count($raw)-1])[2] != "saved") {
        output(NULL, 1);
        return false;
      }
    }
  }
  output();
}
