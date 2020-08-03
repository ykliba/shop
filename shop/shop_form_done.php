<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>川原商店</title>
</head> 
<body>

<?php

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

print $onamae.'様<br />';
print 'ご注文ありがとうございました。<br />';
print $email.'にメールを送りましたのでご確認ください。<br />';
print '商品は以下の住所に発送させて頂きます。<br />';
print $postal1.'-'.$postal2.'<br />';
print $address.'<br />';
print $tel.'<br />';

?>

</body>