
<?php
require_once __DIR__ . '/vendor/autoload.php'; //directory of library folder
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$GLOBALS["channel"] = $channel;
$GLOBALS["consumerTag"] = $consumerTag;

$server = "166.77.1.217";
$port = 5672;
$vhost = "/media";
$username = "mediabus";
$password = "mediabuspass";
$exchangeName = "testarc";
$replyQueue = "replyQ";
$requestKey = "maria.dev.task.publish";
//$replyKey = "reply";

//callback funtion on receiving reply messages
$onMessage = function ($message) {
    echo $message->body.PHP_EOL;
    //stop consuming once receives the reply
    $GLOBALS["channel"]->basic_cancel($GLOBALS["consumerTag"]);
};

try {
    //connect
    $connection = new AMQPConnection($server, $port, $username, $password, $vhost, $heartbeat = 60);
    $channel =  $connection->channel(); 

    //listen for reply messages
    $channel->queue_declare($replyQueue, false, false, $exclusive = true, $auto_delete = true);
    $channel->queue_bind($replyQueue, $exchangeName, $replyKey);
    $consumerTag = $channel->basic_consume($replyQueue, "", false, $no_ack = true, false, false, $callback = $onMessage);

    //send request message
    $message = new AMQPMessage("Hello World!", array("content_type" => "text/plain", "delivery_mode" => 1, "reply_to" => $replyKey));
    $channel->basic_publish($message, $exchangeName, $requestKey);

    //start consuming
    while(count($channel->callbacks)) {
        $channel->wait();
    }

    //disconnect
    $connection->close();
} catch(Exception $e) {
    echo $e.PHP_EOL;
}
?>

