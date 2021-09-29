<?php

require_once 'SASConnector.php';
//connect to admin portal and list users
$acp = new SASConnector('demo4.sasradius.com', 'admin', 'admin', 'acp');
$acp->login();
$res = $acp->post('index/user', []);

print_r(json_decode($res));

//Connect to user portal and fetch user info
$ucp = new SASConnector('demo4.sasradius.com', 'demo1', '1234', 'ucp');
$ucp->login();
$res = $ucp->get('user');
print_r(json_decode($res));
