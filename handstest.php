<!doctype html>
<html lang="ru">
<head>
  <meta charset="windows-1251">
  <title>Test</title>
  <meta name="description" content="Test">
  <meta name="author" content="Wesen">
  <link rel="stylesheet" href="ht_styles.css">  
</head>
<body>
<? require("handstest_logic.php")?>
<form method="POST" >
   <input name="phone" placeholder="������� ����� ��������" class="textbox" type="text" required />
   <input name="submit" class="button" type="submit" value="���������" />
</form>
<div class="phoneOut" >
<div>������ ������:</br> <i>	<?=$out?></i></div>
	
<div class="resultFB" ><?=$res?></div>
<div class="resultFB" ><?=$resV?></div>
 <div style="clear: left"></div>
	</div>
</body>
</html>