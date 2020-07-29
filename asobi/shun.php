<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>shun</title>
</head> 
<body>

<?php

$tsuki = $_POST['tsuki'];

// $yasai[] = '';
// $yasai[] = 'ブロッコリー';
// $yasai[] = 'カリフラワー';
// $yasai[] = 'レタス';
// $yasai[] = 'みつば';
// $yasai[] = 'アスパラガス';
// $yasai[] = 'セロリ';
// $yasai[] = 'ナス ';
// $yasai[] = 'ピーマン';
// $yasai[] = 'オクラ';
// $yasai[] = 'さつまいも';
// $yasai[] = '大根';
// $yasai[] = 'ほうれん草';

$yasai = array('','ブロッコリー','カリフラワー','レタス','みつば','アスパラガス','セロリ','なす','ピーマン','オクラ','さつまいも','大根','ほうれん草');

print $tsuki;
print '月は';
print $yasai[$tsuki];
print 'が旬です。';

?>
</body>