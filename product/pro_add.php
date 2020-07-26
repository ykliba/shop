<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>川原商店</title>
</head> 
<body>

商品追加<br />
<br />
<form method="post" action="pro_add_check.php" nectype="multipart/form-data">
商品名を入力してください。 <br />
<input type="text" name="name" style="width:200px"><br />
価格を入力してください。 <br/>
<input type="text" name="price" style="width:50px"><br />
画像を選んでください。<br />
<input type="file" name="gazou" style="width:400px"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
 
</html>