<?php
 session_start();
 session_regenerate_id(true);
 if(isset($_SESSION['member_login'])==false)
 {
   print 'ログインされていません。<br />';
   print '<a href="shop_list.php">商品一覧へ</a>';
   exit();
 }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>川原商店</title>
</head> 
<body>

<?php

try
{

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

$honbun='';
$honbun.=$onamae."様\n\nこのたびはご注文ありがとうございました。\n";
$honbun.="\n";
$honnbun.="ご注文商品\n";
$honbun.="---------------\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

for($i=0; $i<$max; $i++)
{
  $sql='SELECT name,price FROM mst_product WHERE code=?';
  $stmt=$dbh->prepare($sql);
  $data[0]=$cart[$i];
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  $name=$rec['name'];
  $price=$rec['price'];
  $kakaku[]=$price;
  $suryo=$kazu[$i];
  $shokei=$price*$suryo;

  $honbun.=$name.'';
  $honbun.=$price.'円 x';
  $honbun.=$suryo.'個 =';
  $honbun.=$shokei."円\n";
}

$sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=$_SESSION[''];

$sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel)VALUES(?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

for($i=0; $i<$max; $i++)
{
  $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
  $stmt=$dbh->prepare($sql);
  $data=array();
  $data[]=$lastcode;
  $data[]=$cart[$i];
  $data[]=$kakaku[$i];
  $data[]=$kazu[$i];
  $stmt->execute($data);
}

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

$honbun.="□□□□□□□□□□□□□□□□□\n";
$honbun.="〜信用と実績の川原商店〜\n";
$honbun.="\n";
$honbun.="福岡市中央区平尾5-1-3\n";
$honbun.="電話090-9492-0062\n";
$honbun.="メール mediaboxing2@gmail.com\n";
$honbun.="□□□□□□□□□□□□□□□□□\n";
// print '<br />';
// print $honbun;

$title='ご注文ありがとうございます。';
$header='Form:mediaboxing2@gmail.com';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$ttitle,$honbun,$header);

$title='お客様から注文がありました。';
$header='Form:'.$email;
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('mediaboxing2@gmail.com',$title,$honbun,$header);

session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
  setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();

}
catch(Exception $e)
{
  // print 'ただいま障害により大変ご迷惑をお掛けしております。';
  echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
  exit();
}

?>

<br />
<a href="shop_list.php">商品画面へ</a>

</body>