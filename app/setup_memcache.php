<?php
require_once __DIR__ . '/bootstrap.php';

$con = $app->db;
$sql = 'select id,password from user';
$sth = $con->prepare($sql);
$sth->execute();
$mem = $app->container['memcached'];
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
    $mem->set($result['id'],$result['password'] );
    if($result['id'] % 10000 === 0){
        echo $result['id']."\n";
    }
}
$message = 'finished';
echo  $message;
