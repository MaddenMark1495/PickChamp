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
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3">
				
                 
							
                            </div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<h2>Login</h2>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<div class="row form-group">
								<input class='form-control' type="text" name="username" placeholder="username">
						</div>
						<div class="row form-group">
								<input class='form-control' type="password" name="password" placeholder="password">
						</div>
						<div class="row form-group">
								<input class=" btn btn-info" type="submit" name="submit" value="Login"/>
                                <a href="register2.php" class="btn btn-warning">Register</a>
                                <!--<input class=" btn btn-info" type="submit" name="logout" value="Logout"/>-->
						</div>
					</form>
                
				</div>
                
			</div>
			<?php
			
							
				if(isset($_POST['submit'])) { // Was the form submitted?
					
					$link = mysqli_connect("#","#","#","#") or die ("Connection Error " . mysqli_error($link));
					






					//password salted and Hashed
					
					$sql = 'SELECT salt, hashed_password, usertype FROM users WHERE username = "';
					$query=$sql . $_POST['username'].'";';
					$result = mysqli_query($link, $query);
						$row = mysqli_fetch_assoc($result);
						$localhash = sha1( $row['salt'] . $_POST['password'] );
						if ($localhash == $row['hashed_password'])
						{
							echo 'You logged in!';
							// Set session variables
							$_SESSION['username'] = $_POST['username'];
							$_SESSION['usertype'] = $row['usertype'];
							$_SESSION['islogin'] = '1';
							
							
							
							date_default_timezone_set("America/Chicago");
							$time2=date('Y-m-d H:i:s');
							$query2='UPDATE logins SET time_of_login="' . $time2 . '" WHERE userName = "' . $_POST['username'].'";';
							$query3='UPDATE logins SET loginTimes=loginTimes+1 WHERE userName = "' . $_POST['username'].'";';
							mysqli_query($link, $query2);
							mysqli_query($link, $query3);
							
							
							
							
							
							
						
							
							if($_SESSION['usertype']=='c')
							{
								header("Location: pick.php");
							}
							else
							{
								header("Location: main.php");
							}
							
						}
						else
						{
							echo 'Password error!';
							
						}
						
						
   
    
					
				}
			
			?>
		</div>
    
    
    
    
    
    </td>
  </tr>
</table>
</body>
</html>
