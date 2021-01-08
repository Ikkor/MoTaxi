<?php
	require 'loginCheck.php';
?>

<html lang="en">
<head>
	<title>Document</title>
</head>
<body>
	<form method="post" action="writecomplaint.inc.php">
		<label for="txt_desc"></label>
		<textarea name="txt_desc" id="txt_desc"></textarea>

		<label for="txt_type"></label>
		<select name="txt_type" id="txt_type">
			<option value="hygiene">hygiene</option>
			<option value="treatment">treatment</option>
			<option value="other" selected>other</option>
		</select>

		<input type="submit" name="submit" value="submit">

	</form>
</body>
</html>