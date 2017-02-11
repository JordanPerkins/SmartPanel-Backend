<?php

function openvz_status($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz status ".$container." 2>&1", $raw);
  $status = array_values(array_filter(explode(' ', trim($raw[0]))));
  $ram = array_values(array_filter(explode(' ', trim($raw[1])), function($value) { return $value !== ''; }));
  $swap = array_values(array_filter(explode(' ', trim($raw[2])), function($value) { return $value !== ''; }));
  $output["status"] = $status[0];
  if (trim($raw[count($raw)-1]) == 'yes') {
    $output["status"] = "suspended";
  }
  if ($status[1] == "-") {
    $output["loadavg"] = "n/a";
  } else {
    $output["loadavg"] = $status[1];
  }
  if (!is_numeric($ram[2])) {
    $output["ram"] = "0";
  } else {
    $output["ram"] = $ram[2];
  }
  if (!is_numeric($swap[2])) {
    $output["swap"] = "0";
  } else {
    $output["swap"] = $swap[2];
  }
  $output["disk"] = round($status[2]/(1024*1024), 2);
  output($output);
}
 ?>
