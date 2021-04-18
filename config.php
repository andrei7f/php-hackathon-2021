<?php

$db_user     ='root';
$db_password ='';
$db_name     ='healthCenter';

$db= new PDO('mysql:host =127.0.0.1;$db_name='.$db_name.';charset=utf8',$db_user,$db_password);


//setting some db attributes
$db->setAtribute(PDO::ATTR_EMULATE_PREPARES,false);
$db->setAtribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
$db->setAtribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

define('APP_NAME','USERS','PROGRAMMES');



?>
