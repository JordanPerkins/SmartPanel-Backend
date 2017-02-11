<?php

function openvz_tuntap_enable($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz tuntap ".$container." on 2>&1", $raw);
  if ($raw[count($raw)-1] == "Setting devices" || count($raw) == 1) {
    output();
  } else {
    output(NULL, 1);
  }
}

function openvz_tuntap_disable($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz tuntap ".$container." off 2>&1", $raw);
  if ($raw[count($raw)-1] == "Setting devices" || count($raw) == 1) {
    output();
  } else {
    output(NULL, 1);
  }
}

function openvz_fuse_enable($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz fuse ".$container." on 2>&1", $raw);
  if ($raw[count($raw)-1] == "Setting devices" || count($raw) == 0) {
    output();
  } else {
    output(NULL, 1);
  }
}

function openvz_fuse_disable($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  exec("/usr/local/smartpanel/core/openvz fuse ".$container." off 2>&1", $raw);
  if ($raw[count($raw)-1] == "Setting devices" || count($raw) == 0) {
    output();
  } else {
    output(NULL, 1);
  }
}
