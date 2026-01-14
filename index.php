<?php
header('Content-Type: text/plain');

echo "REQUEST_METHOD:\n";
var_dump($_SERVER['REQUEST_METHOD']);

echo "\n\nRAW QUERY STRING:\n";
var_dump($_SERVER['QUERY_STRING']);

echo "\n\n_GET ARRAY:\n";
var_dump($_GET);

exit;
