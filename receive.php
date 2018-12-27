
<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$routingkey="maria.dev.task.publish";
$exchange="";
$qname="maria.dev.task.publish";


//$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'serverworld', 'password', '/my_vhost');
$connection = new AMQPStreamConnection('166.77.1.217', 5672, 'mediabus', 'mediabuspass', '/media');

$channel = $connection->channel();

$channel->queue_declare('testrmq', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$result=$channel->basic_get('maria.dev.task.publish');

var_dump($result);



function process_message($message)
{
    echo "Received message '" . $message->body . "'\n";

    /** Do your grouping here **/

}

$channel->basic_consume($qname, '', false, false, false, false, 'process_message');

// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
    $channel->wait();
}







/*
$callback = function($msg) {
    echo " [x] Received ", $msg->body, "\n";
};

$channel->basic_consume('Hello_World', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}
 */
?>
