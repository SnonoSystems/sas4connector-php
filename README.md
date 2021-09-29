# sasconnector-php
API connector for SAS Radius 4

__Installation__<br>
Clone the git repository:
```
git clone https://github.com/hasanenalbana/sasconnector-php
```
Install required libraries:
```cd sasconnector-php
curl -sS https://getcomposer.org/installer | php
php composer.phar install
````

__Usage__
```
require_once 'SASConnector.php';

$acp = new SASConnector('demo4.sasradius.com', 'admin', 'admin', 'acp');
$acp->login();
$res = $acp->post('index/user', []);

print_r(json_decode($res));


$ucp = new SASConnector('demo4.sasradius.com', 'demo1', '1234', 'ucp');
$ucp->login();
$res = $ucp->get('user');
print_r(json_decode($res));

```
