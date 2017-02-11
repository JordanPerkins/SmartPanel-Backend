<?php
function openvz_start($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz start ".$container." 2>&1", $raw);
  if ($raw[count($raw)-1] == "Container start in progress...") {
    output();
  } else {
    output(NULL, 1);
  }
}

function openvz_stop($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz stop ".$container." 2>&1", $raw);
  if ($raw[1] == "Container was stopped") {
    output();
  } else {
    output(NULL, 1);
  }
}

function openvz_restart($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz stop ".$container." 2>&1", $raw);
  if ($raw[1] == "Container was stopped") {
    exec("/usr/local/smartpanel/core/openvz start ".$container." 2>&1", $raw);
    if ($raw[count($raw)-1] == "Container start in progress...") {
      output();
    } else {
      output(NULL, 1);
    }
  } else {
    output(NULL, 1);
  }
}

 ?>
