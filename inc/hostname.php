<?php

function openvz_hostname($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  $hostname = escapeshellarg($data['value']);
  exec("/usr/local/smartpanel/core/openvz hostname ".$container." ".$hostname." 2>&1", $raw);
  if (explode(' ', $raw[count($raw)-1])[2] == "saved") {
    output();
  } else {
    output(NULL, 1);
  }
}
