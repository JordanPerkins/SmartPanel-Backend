<?php

  require('../inc/lib.php');

  // Check if config file exists. Error code 1
  if (!$config) {
    output(NULL, 1);
  // Check if anything was posted. Error code 2
  } elseif(!$_POST) {
    output(NULL, 2);
  // Authenticate user including IP
  } elseif(!authenticate($_POST['user'], $_POST['pass'], $config)) {
    output(NULL, 3);
  /* Check if a CMD was specified.
   * In this case it returns 0 (no error)
   * This is because it'll be used as a node online check. */
  } elseif(!($_POST['cmd'] && $_POST['type'])) {
      // Everything is okay, run the command executor
    output();
  } else {
    $cmd = $_POST['cmd'];
    $type = $_POST['type'];
    $function = $type."_".$cmd;
    $functions = get_defined_functions()['user'];
    // Has the posted CMD been defined as an array?
    if (in_array($function, $functions)) {
      $function($_POST);
    } else {
      // Error code 4 - no command of this name.
      output(NULL, 4);
    }
  }


 ?>
