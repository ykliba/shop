<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>gengo</title>
</head> 
<body>

<?php

require_once('../common/common.php');

$seireki=$_POST['seireki'];

$wareki=gengo($seireki);
print $wareki;

?>
</body>