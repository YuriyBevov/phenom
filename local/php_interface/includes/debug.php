<?php

if (!function_exists('debug')) {
  





  function debug($data, $die = false)
  {
    echo '<pre>' . print_r($data, true) . '</pre>';

    if ($die) {
      die('DEBUG STOP');
    }
  }
}