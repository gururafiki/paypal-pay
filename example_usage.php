<?php

require "db.php";
$order = R::dispense('passed');
$postData=file_get_contents('php://input');
if(isset($postData))
{
    $order->customData = file_get_contents('php://input');
    $order->custom = $postData;
}
$order->good=2;
R::store($order);
// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");