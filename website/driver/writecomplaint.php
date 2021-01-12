<?php
	require '../config/loginCheck.php';


?>

<html lang="en">
<head>
	<title>Document</title>
</head>
<body>
	<form method="post" action="writecomplaint.inc.php">
		<label for="txt_comment">Comments</label>
		<textarea name="txt_comment" id="txt_comment"></textarea>

		<input type="submit" name="submit" value="submit">

	</form>
</body>
</html>