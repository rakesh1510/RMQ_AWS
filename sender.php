
<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$routingkey="maria.dev.task.publish";
$exchange="";
$connection = new AMQPStreamConnection('166.77.1.217', 5672, 'mediabus', 'mediabuspass', '/media');

//var_dump($connection);exit;
$channel = $connection->channel();
//var_dump($channel);exit;
//$channel->queue_declare('maria.dev.task', false, false, false,false);

$msg = new AMQPMessage('RAKESH IS TESTING');
$channel->basic_publish($msg, '', "$routingkey");
//$channel->basic_publish($msg, '', "");
echo " [x] Sent 'Hello_World'\n";

$channel->close();
$connection->close();
?>

