<?php

if (isset($_POST) && !empty($_POST['email'])) {

  $file = 'potential-customers.txt';

  $current = file_get_contents($file);

  $current .= $_POST['email'] . "\n";

  file_put_contents($file, $current);
}