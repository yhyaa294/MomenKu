<?php

// Set the correct base path
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Change to public directory
chdir(__DIR__ . '/../public');

// Include the Laravel application
require __DIR__ . '/../public/index.php';
