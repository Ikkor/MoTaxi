<?php 


	$newrate='select * from rate order by date desc limit 1';
	$stmt=$pdo->prepare($newrate);
	$stmt->execute();
	$newresult = $stmt->fetch(PDO::FETCH_ASSOC);

	$rate = $newresult['rate'];
?>