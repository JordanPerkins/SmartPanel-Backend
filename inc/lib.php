<?php

// Load every php file in the inc folder
foreach (glob('../inc/*.php') as $filename)
{
  if ($filename != "../inc/lib.php") {
    include_once $filename;
  }
}

// Function for displaying output correctly.
function output ($info, $error = 0) {
  $data = array();
  $data["error"] = $error;
  $data["data"] = $info;
  echo json_encode($data);
}

// Authenticates the user
function authenticate($user, $pass, $config) {
  $ip = $_SERVER['REMOTE_ADDR'];
  if ($ip == $config['ip'] && $user == $config['user'] && $pass == $config['pass']) {
    return true;
  }
  return false;
}
?>
