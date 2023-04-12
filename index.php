<?php

	include("validations.php");

	
	function sanitize($str,$length=50 ){
		$str = strip_tags($str);
		$str = trim($str);
		$str = htmlentities($str);
		return substr($str,0,$length);

	}

	if( !empty(  $_POST['fname']  )  ){
		/*
		$fname = sanitize($_POST['fname']);
		$date = sanitize($_POST['date']);
		$email = sanitize($_POST['email']);
		*/

		$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
		$email  = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

		$oktosubmit = true;

		if(date1($date)){
			
			echo "<br>Valid Date<br>";
		}else{
			$oktosubmit = false;
			echo "<br>Invalid Date<br>";
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<br>Valid Email<br>";
		}else{
			$oktosubmit = false;
			echo "<br>Invalid Email<br>";
		}

		/*
		if(emailCheck($email)){

			echo "<br>Valid Email<br>";
		}else{
			$oktosubmit = false;
			echo "<br>Invalid Email<br>";
		}
		*/

		if($oktosubmit){
			// a valid insert looks like this: INSERT INTO `testdate` (`name`, `date`) VALUES ('Testbob2', '20201122');
			$new_time = strtotime($date);
			$new_time = date("Ymd",$new_time);
			echo "<br/>FORMATTED DATE:". $new_time . "<br/>";
			
			$sql = "INSERT INTO `testdate` (`name`, `date`) VALUES ('".$fname."', '".$new_time."');";
			echo "<br/>" . $sql;
		}
		//echo $fname . " | " . $date . " | " . $email;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Clean input</title>
 	<style type="text/css">
 		form div{margin: 1em;}
 		form div label{float: left;width: 10%;}
 		form div.radio {float: left;}
 		.clearfix {clear: both;}
 	</style>
</head>
<body>
	<script>
		function validate(){
			// do your checks
			if( document.forms[0].fname.value == ""  ){
				alert("Missing firstname");
				return false;
			}
			
		}
	</script>
	<form name="comment" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  onsubmit="return validate()"  >
		<div>
			<label>First Name:</label>
			<input type="text" name="fname" size="30"  />
		</div>
		<div>
			<label>Date:</label>
			<input type="text" name="date" size="30" /> mm/dd/yyyy
		</div>
		<div>
			<label>Email:</label>
			<input type="text" name="email" size="30"  />
		</div>
		<div class="clearfix">
			<input type="reset" value="Reset Form" />
			<input type="submit" name="submit" value="Submit Form" />
		</div>	
	</form>
	<?php

	?>
</body>
</html>