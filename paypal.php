<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Paypal</title>
  </head>
  <body>
<?php
require_once 'db.php'; // подключаем скрипт


$payNowButtonUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

$user_id = R::FindOne('users','login = ?',array($_POST['login']));
$product_id = R::FindOne('products','item_name = ?',array($_POST['item_name']));


$receiverEmail = 'broaden.your-facilitator@outlook.com'; //email получателя платежа(на него зарегестрирован paypal аккаунт)
$productId = $product_id->id;
$price = $product_id->price; // цена продукта(за 1 шт.)

$returnUrl = 'http://gururafiki.gq.s21.hhos.ru/payment_success.php';
$amount=floatval($_POST['quantity'])*$price;

$order = R::dispense('orders');
$order->custom_Data = $_POST['custom'];
$order->quantity = $_POST['quantity'];
$order->amount= $amount;
$order->product_Id = $productId;
R::store($order);

$privatuser = R::dispense($_POST['login']);
$privatuser->custom=$_POST['custom'];
R::store($privatuser);

echo("Good");
?>

<form action="<?php echo $payNowButtonUrl; ?>" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $receiverEmail; ?>">
    <input id="paypalItemName" type="hidden" name="item_name" value="<?php echo $_POST['item_name']; ?>">
    <input id="paypalQuantity" type="hidden" name="quantity" value="<?php echo $_POST['quantity']; ?>">
    <input id="paypalAmmount" type="hidden" name="amount" value="<?php echo $price; ?>">

    <input type="hidden" name="return" value="<?php echo $returnUrl; ?>">
    <input id="custom" type="hidden" name="custom" value="<?php echo $_POST['custom'];?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="US">
    <input type="hidden" name="bn" value="PP-BuyNowBF">

    <button type="submit">
        Pay Now
    </button>
 </form>
  </body>
</html>