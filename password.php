<?php
	session_start();
?>
<html>
<head>
<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
<title>Pick Champ Data Management System</title>
</head>

<body>
<table width="1359" border="0">
  <tr>
    <td colspan="2"><img src="PICK-CHAMP-HEADER.jpg" width="1260" height="240" /></td>
  </tr>
  <tr>
    <td width="220" height="38" bgcolor="#000000"><div align="center"><a href="http://pickchamp.co/" rel="home"><font size="4" color="LawnGreen"><strong>Pick Champ</strong></font></a></div></td>
    <td width="919" bgcolor="#000000"><div align="right">
    
   
   
   
   
    
    
    </div></td>
  </tr>
  <tr>
    <td height="362" bgcolor="#000000">&nbsp;</td>
    <td>
    
    
    
    
    <div class="container">
    <?php
        if($_SESSION['islogin']!='1')
				{
					header("Location: index.php");
					exit;
				}
				?>
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3">
				
                 
							
                            </div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<h2>Change password</h2>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<div class="row form-group">
								<input class='form-control' type="password" name="password0" placeholder="current password">
						</div>
						<div class="row form-group">
								<input class='form-control' type="password" name="password1" placeholder="new password">
						</div>
                        <div class="row form-group">
								<input class='form-control' type="password" name="password2" placeholder="verify new password">
						</div>
						<div class="row form-group">
								<input class=" btn btn-info" type="submit" name="submit" value="Apply"/>
                                <!--<input class=" btn btn-info" type="submit" name="logout" value="Logout"/>-->
                                <a href="main.php" class="btn btn-primary">Back</a>
						</div>
					</form>
                    
				</div>
			</div>
			<?php
				if(isset($_POST['submit'])) { // Was the form submitted?
					
					$link = mysqli_connect("#","#","#","#") or die ("Connection Error " . mysqli_error($link));
					


					/*
					$sql = 'SELECT salt, hashed_password FROM users WHERE username = $1';
					if ($stmt = mysqli_prepare($link, $sql)) {
						mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
						mysqli_stmt_execute($stmt) or die("execute");
					}
					$result = mysqli_stmt_get_result($stmt);
					*/
					
					$sql = 'SELECT salt, hashed_password, usertype FROM users WHERE username = "';
					$query=$sql . $_SESSION['username'].'";';
					$result = mysqli_query($link, $query);
						$row = mysqli_fetch_assoc($result);
						$localhash = sha1( $row['salt'] . $_POST['password0'] );
						if ($localhash == $row['hashed_password'])
						{
							if($_POST['password1']==$_POST['password2'])
							{
								$salt = mt_rand();
								$hpass = sha1($salt.$_POST['password1'])  or die("bind param");
								$sql='UPDATE users SET salt="'.$salt.'", hashed_password="'.$hpass.'" WHERE username="'.$_SESSION['username'].'";';
								$stmt = mysqli_prepare($link, $sql);
								if(mysqli_stmt_execute($stmt)) {
									echo "<h4>Success</h4>";
								} else {
									echo "<h4>Failed</h4>";
								}
								
								
								
							}
							else
							{
								echo "Doesn't match conformation!";	
							}
							//echo 'You logged in!';
							// Set session variables
							//$_SESSION['username'] = $_POST['username'];
							//$_SESSION['usertype'] = $row['usertype'];
							//$_SESSION['islogin'] = '1';
							/*
							if($_SESSION['usertype']=='a')
							{
								echo ' Welcome Admin! You have super privileges';
							}
							else
							{
								echo 'Welcome ' . $_SESSION['username'] . '!';
							}
							*/
							//echo '<br><input class=" btn btn-info" type="logout" name="logout" value="Logout"/>';
							//header("Location: main.php");/////////////////////////////
						}
						else
						{
							echo "Current password error!";	
						}
						/*
						if($_SESSION['islogin']=='1')
							{
								echo ' <input class=" btn btn-info" type="submit" name="logout" value="Logout"/>';
							}
						*/
						
   
    
					
				}
				/*
				if(isset($_POST['logout']))
				{
					// remove all session variables
					session_unset();
					// destroy the session
					session_destroy();
					echo 'You logged out!';
				}
				*/
			?>
		</div>
    
    
    
    
    
    </td>
  </tr>
</table>
</body>
</html>
