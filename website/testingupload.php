<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<form action="testingupload.php" method="post" enctype="multipart/form-data">
		<label for="pfp">pfp</label>
		<input type="file" name="pfp" id="pfp">
		<br>
		<br>
		<input type="submit" name="submit" value="submit">
	</form>
    <?php 

        $allowed=array('jpg', 'jpeg', 'png');
        $pfpName=$_FILES['pfp']['name'];
        $pfpTempName=$_FILES['pfp']['tmp_name'];
        $pfpSize=$_FILES['pfp']['size'];
        $pfpError=$_FILES['pfp']['error']; //error 4 means no file uploaded

        $pfpExt=explode('.',$pfpName);
        $pfpActualExt=strtolower(end($pfpExt));

        if(in_array($pfpActualExt, $allowed) && $pfpError==0 /*&& $pfpSize<1000000*/ ){
            //get a new name and assign location
            $pfpNewName=uniqid('',true).".".$pfpActualExt;
            $pfpDestination='uploads/test/'.$pfpNewName;
            move_uploaded_file($pfpTempName, $pfpDestination);
            //file ready for upload
        }else{
            echo $pfpError;
            echo 'An error occured';
        }
    
    ?>
</body>
</html>