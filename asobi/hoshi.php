<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>hoshi</title>
</head> 
<body>

<?php

$mbango = $_POST['mbango'];

$hoshi['M1'] = 'かに星雲';
$hoshi['M2'] = 'アンドロメダ大星雲';
$hoshi['M3'] = 'オリオン大星雲';
$hoshi['M4'] = 'すばる';
$hoshi['M5'] = 'ドーナツ星雲';

foreach($hoshi as $key => $val)
{
  print $key.'は'.$val;
  print '<br />';
}

print  'あなたが選んだ星は、';
print $hoshi[$mbango];


?>
</body>