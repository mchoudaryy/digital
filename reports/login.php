<?php
error_reporting(0);
include '../config.php';
 if(isset($_POST['login']))
 {
     $sql_userLoginCheck = "SELECT * FROM rpt_users WHERE user_name='".$_POST['txt_userId']."' AND password='".$_POST['txt_password']."'";
     $result_loginCheck = mysql_query($sql_userLoginCheck,$con);
     $arr_loginDbDetails = mysql_fetch_array($result_loginCheck);
//     echo '<br>'.$arr_loginDbDetails['email'].'txt'. filter_input(INPUT_POST,'txt_userId').'psf '.$arr_loginDbDetails['email'].' txt pased'.filter_input(INPUT_POST, 'txt_password');
     
  
        if($_POST['txt_userId'] != '' &&  $_POST['txt_password'] != '')
        {
            if($arr_loginDbDetails['user_name'] == filter_input(INPUT_POST,'txt_userId') && $arr_loginDbDetails['password'] == filter_input(INPUT_POST, 'txt_password'))
            {
                
                if($arr_loginDbDetails['user_name'] == "admin@digitalmediahk.com")
                {
                    session_start();
                    $_SESSION['sid_digimedia_report']=session_id();
                    $_SESSION['sid_digimedia_user_name'] = $arr_loginDbDetails['first_name'].' '.$arr_loginDbDetails['last_name'];
                    $_SESSION['digimedia_user_type'] = $arr_loginDbDetails['user_type'];
                    $URL_admin = "index.php";
                    header('Location: '.$URL_admin);
                }
                elseif($arr_loginDbDetails['user_name']=="digimedia@promotion")
                {
                    session_start();
                    $_SESSION['sid_digimedia_report']=session_id();
                    $_SESSION['sid_digimedia_user_name'] = $arr_loginDbDetails['first_name'].' '.$arr_loginDbDetails['last_name'];
                    $_SESSION['digimedia_user_type'] = $arr_loginDbDetails['user_type'];
                    $URL_admin = "impressions.php";
                    header('Location: '.$URL_admin);
                }
                else
                {
                    $error_loginFailed = "<font color='red'>Your account has been deactivated.</font>";
                }
            }
            else
            {      
                $error_loginFailed = "<font color='red'>The email or password you entered is incorrect.</font>";
            }
        }
        else
        {
            $error_loginFailed = "<font color='red'>Enter login details.</font>";
        }
    
 }
    

    
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Welcome | Digital Ad Media</title>
<link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div>
  <div class="container">
    <div class="row header">
      <div class="logo navbar-left">
        <h1><a href="index.php"><img src="../images/logo.jpg" width="287" height="88"></a></h1>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="row h_menu">
      <nav class="navbar navbar-default navbar-left" role="navigation"> 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            
          </ul>
        </div>
      </nav>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="main_bg">
</div>
<div class="main_btm">
  <div class="container">
    <div class="main row">
      <div class="col-md-4 company_ad"></div>
      <div class="col-md-8">
        <div class="contact-form">
          <h2>Login</h2><h5><?php echo $error_loginFailed ?></h5>
          <form method="post" action="">
            <div> <span>Email ID</span> <span>
                   
              <input type="username" class="form-control" name="txt_userId" id="" style="width:260px;" value="<?=$_POST['txt_userId']?>">
              </span> </div>
            <div> <span>Password</span> <span>
                   
              <input type="password" class="form-control"  name="txt_password" style="width:260px;" value="<?=$_POST['txt_password']?>">
              </span> </div>
            <div></div>
            <div>
              <label class="fa-btn btn-1 btn-1e">
                  <input type="submit" name="login" value="Login Now">
              </label>
            </div>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<div class="footer_bg">
  <div class="container">
    <div class="row  footer">
      <div class="copy text-center">
        <p class="link"><span>&#169; All rights reserved | Digital Ad Media Limited</span></p>
      </div>
    </div>
  </div>
</div>
</body>
</html>