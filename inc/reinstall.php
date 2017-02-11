<?php

function openvz_reinstall($data) {
  $output = array();
  $container = escapeshellarg($data['ctid']);
  $template = escapeshellarg($data['value']);

  exec('[ -f /vz/template/cache/'.$template.'.tar.gz ] && echo "1" || echo "0" 2>&1', $raw);
  if ($raw[0] == "1") {
    exec("/usr/local/smartpanel/core/openvz reinstall ".$container." ".$template." 2>&1", $raw);
    if (trim($raw[count($raw)-1]) == "Container start in progress...") {
      output();
    } else {
      output(NULL, 1);
    }
  } else {
    output(NULL, 1);
  }
}


 ?>
