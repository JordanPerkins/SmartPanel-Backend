<?php

function openvz_password($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  $pass = escapeshellarg($data['value']);
  exec("/usr/local/smartpanel/core/openvz rootpass ".$container." ".$pass." 2>&1", $raw);
  if (explode(' ', trim($raw[count($raw-1)]))[2] == "saved") {
    output();
  } else {
    output(NULL, 1);
  }
}
