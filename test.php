<?php

require_once 'SASConnector.php';

$acp = new SASConnector('demo4.sasradius.com', 'admin', 'admin', 'acp');
$acp->login();
$res = $acp->post('index/user', []);

print_r(json_decode($res));


$ucp = new SASConnector('demo4.sasradius.com', 'demo1', '1234', 'ucp');
$ucp->login();
$res = $ucp->get('user');
print_r(json_decode($res));
