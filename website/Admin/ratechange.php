<?php 
	require '../../../includes/db_connect.php';
	require '../../../modules/login_check.php';

	$oldresult['rate']="";
	$oldrate='select * from rate order by date desc limit 1';
	$stmt=$pdo->prepare($oldrate);
	$stmt->execute();
	$oldresult = $stmt->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST['submit'])){
		if(is_numeric($_POST['newrate']) && $_POST['newrate']!=""){
			$email=$_SESSION['adminEmail'];
			$null=NULL;
			$sql='insert into rate values(:NULL, :rate, :who)';
			$stmt=$pdo->prepare($sql);
			$stmt->execute(['NULL'=>$null,'rate'=>$_POST['newrate'], 'who'=>$email]);
		}
	}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
	<label for="oldrate">Old Rate</label>
	<input type="text" name="oldrate" id="oldrate" value="<?php echo $oldresult['rate'] ?>" readonly>
	<br>
	<br>

	<label for="newrate">New Rate</label>
	<input type="number" name="newrate" id="newrate">
	<br>
	<br>


	<input type="submit" name="submit" value="update">

</form>
