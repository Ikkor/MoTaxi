<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<form action="account_creat_General.php?ref=driver" method="post" enctype="multipart/form-data">

		<label for="txt_name">name</label>
		<input type="text" name="txt_name" placeholder="John Doe" id="txt_name">
		<br>
		<br>

		<label for="txt_email">email</label>
		<input type="email" name="txt_email" placeholer="johndoe@gmail.com" id="txt_email">
		<br>	
		<br>

		<label for="txt_phone">telno</label>
		<input type="text" name="txt_phone" id="txt_phone">
		<br>
		<br>
				
		<label for="txt_dob">dob</label>
		<input type="date" name="txt_dob" id="txt_dob">
		<br>
		<br>
		<label for="txt_address">address</label>
		<input type="text" name="txt_address" id="txt_address">
		<br>
		<br>

		<label for="txt_pass">password</label>
		<input type="text" name="txt_pass" placeholder="********" id="txt_pass">
		<label for="txt_passR">Repeat password</label>
		<input type="text" name="txt_passR" placeholder="********" id="txt_passR">
--------------------------------------------------------------------------
		<br>
		<br>
	

		<label for="txt_dateStart">Date started taxi</label>
		<input type="date" name="txt_dateStart" id="txt_dateStart">
		<br>
		<br>
		<label for="filelicense">license</label>
		<input type="file" name="filelicense" id="filelicense">
		<br>
		<br>

		<label for="filepfp">pfp</label>
		<input type="file" name="filepfp" id="filepfp">
		<br>
		<br>




		<input type="submit" name="submit" value="submit">
	</form>

</body>
</html>