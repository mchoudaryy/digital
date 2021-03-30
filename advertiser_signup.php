<?php
error_reporting(0);
include "config.php";

function send_success_email($customerEmail,$customername)
{
    $subject = "Thanks for registration" ;
    $header  .= 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       
    $headers = $header."";
   //!!!All the emails are coming with comma as separator  .... "\r\n\" is important to separate FROM Cc BCc.
 
       $message .= "<table width='700' border='0' align='center' cellspacing='5' cellpadding='0'>
  <tbody><tr>
    <td height='72' style='background:none repeat scroll 0 0 #313232; repeat-x top center;padding:0px 10px;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tbody><tr>
        <td width='50%' valign='middle' height='45' align='left'><a target='_blank' href='http://www.digitalmediahk.om/'><img width='206' height='30' border='0' src='http://www.digitalmediahk.com/images/logo.jpg'></a></td>
        <td width='50%' valign='middle' align='right'><img width='59' height='60' src='https://ci5.googleusercontent.com/proxy/YSywgNcdDYa9xsRZDLywwo1eZEo9MFZCvHaNTLHaNrxt2bd_N4oVmbw-XfNxEowXPZJ0OKupluPeuv_8jARLGytY9_u3QuRcFA=s0-d-e1-ft#http://www.tagjunction.com/mailimages/emailicon.gif'></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td valign='middle' height='300' align='center' style='background:#f4f4f4;border:solid 1px #e2e1e1;padding:0px 10px'><table width='400' border='0' cellspacing='0' cellpadding='0' style='font-size:12px;color:#606060;font-family:Arial,Helvetica,sans-serif'>
      <tbody><tr>
        <td valign='middle' height='21' align='left'></td>
      </tr>
      <tr>
        <td valign='middle' height='140' align='center' style='background:#ffffff;border:solid 1px #e2e1e1;padding:0px 10px'>
        <font size='2' face='Arial' color='#464646'>Dear $customername,<br><br>Welcome to Digital Media!<br><br>You have 
            successfully created your Advertiser Account.<br>Thank you for applying to
            <a target='_blank' href='http://www.smartaheadsolutions.co.uk'>www.digitalmediahk.com</a><br><br> We will contact you soon.<br><br></font></td>
      </tr>
      <tr>
        <td valign='middle' height='40' align='left'>
			Best regards,<br>
		  <a style='color:#199aae;text-decoration:none' href='#147290b9209fe2d9_'>support@smartahead.co.uk</a></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>";
       
        @mail($customerEmail, $subject, $message, $headers);
    
}
if(isset($_POST['sbt_signUp']))
{
   
    if($_POST["txt_firstName"] == "")
    {
        $siteFirstNameErr = "<font color=red>Field is required</font>";
        $flag_error = true;
    }
    
    if($_POST["txt_lastName"] == "")
    {
        $siteLastNameErr = "<font color=red>Field is required</font>";
        $flag_error = true;
    }
	if($_POST["txt_email"] == "")
    {
        $txt_emailErr = "<font color=red>Field is required</font>";
        $flag_error = true;
    }
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	if (!preg_match($regex, $_POST["txt_email"]))
	{
		$txt_emailErr = "<font color=red>Invalid Email</font>";
		$flag_error = true;
	}
	$sql_checkemail = "SELECT email FROM advertiser_members WHERE email='".$_POST['txt_email']."'";
    $result_checkEmail = mysql_query($sql_checkemail);
    $count_checkEmailRecords = mysql_num_rows($result_checkEmail);
    if($count_checkEmailRecords > 0)
    {
        $txt_emailErr = "<font color=red>Email already exists</font>";
        $flag_error = true;
    }
    if($_POST["int_phoneNumber"] == "")
    {
        $phoneErr = "<font color=red>Field is required</font>";
        $flag_error = true;
    }
    if($_POST["txt_query"] == "")
    {
        $txt_queryErr = "<font color=red>Field is required</font>";
        $flag_error = true;
    }
    if($flag_error == false)
    {
        $sql_insert = "insert into advertiser_members
            (first_name ,
             last_name ,
             email ,
             phone,
             query,inserted_date
            )
            values( '".filter_input(INPUT_POST, 'txt_firstName')."', '".filter_input(INPUT_POST, 'txt_lastName')."'"
                . ", '".filter_input(INPUT_POST, 'txt_email')."', '".filter_input(INPUT_POST, 'int_phoneNumber')."',"
                . " '".filter_input(INPUT_POST, 'txt_query')."',NOW())";
       
        if(mysql_query($sql_insert))
        {
            $customer_name = filter_input(INPUT_POST, 'txt_firstName').'&nbsp'.filter_input(INPUT_POST, 'txt_lastName');
             mysql_close($con);
             send_success_email(filter_input(INPUT_POST, 'txt_email'),$customer_name);
            echo '<script type="text/javascript">
                             window.location.href = "thankyou.php"
                    </script>';
            
        }
    }
    
    
    
}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Welcome | Digital Ad Media</title>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>

    

</script>
<style>
    #error_message{
        color: red;
        font-weight: bold;
    }
</style>
</head>
<body>
<div>
  <div class="container">
    <div class="row header">
      <div class="logo navbar-left">
        <h1><a href="index.php"><img src="images/logo.jpg" width="287" height="88"></a></h1>
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
            <li><a href="index.php">Home</a></li>
            <li  class="active"><a href="advertisers.php">Advertisers</a></li>
            <li><a href="publishers.php">Publishers</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Sign Up</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="main_bg">
</div>
<!-- end main -->
<div class="main_btm">
  <div class="container">
    <div class="main row">
      <div class="col-md-4 company_ad"></div>
      <div class="col-md-8">
        <div class="contact-form">
             <h2>Register</h2>
      <br />
<?php
echo $error_header;

?>
                    <div class="contact_info">
			    	 	
			    	 		<div class="map">
                                                    <form action="" method="post">
                            <table width="80%" align="center" cellpadding="5" cellspacing="5" margin="0">
        
            <tbody>
        <tr>
            <td class="reg-form_title" valign="top"><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">First Name:</span></td>
            <td align="left"><input class="reg-form_inputs_field required validate-size-25 validate-password" id="user_password4" name="txt_firstName" value="<?= $_POST['txt_firstName']?>" size="30" type="text"><?php echo $siteFirstNameErr; ?></td>
        </tr>

        <tr>
            <td>
            </td><td height="7px"><font style="font-size: 4px">&nbsp;</font></td>
            
            
        </tr>

        <tr>
            <td class="reg-form_title" valign="top"><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">Last Name:</span></td>
            <td align="left"><input class="reg-form_inputs_field required validate-size-25 validate-password" id="user_password3" name="txt_lastName" value="<?=  $_POST['txt_lastName'] ?>" size="30" type="text"><?php echo $siteLastNameErr; ?></td>
        </tr>

        <tr>
            <td>
            </td><td height="7px"><font style="font-size: 4px">&nbsp;</font></td>
            
            
        </tr>

        <tr>
            <td class="reg-form_title" valign="top" style="padding-top: 0px;"><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">E-mail:</span><br>

                
            </td>
            <td align="left"><input class="reg-form_inputs_field required validate-size-25 validate-password" id="user_password2" value="<?= $_POST['txt_email']?>" name="txt_email" size="30" type="text"><?php echo  $txt_emailErr; ?></td>
        </tr>
        <tr>
            <td>
            </td><td height="7px"><font style="font-size: 4px">&nbsp;</font></td>
            
            
        </tr>
        
        <tr>
          <td class="reg-form_title" valign="middle"><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">Phone:</span></td>
          <td align="left"><input class="reg-form_inputs_field required validate-size-25 validate-password" id="int_phoneNumber" value="<?= $_POST['int_phoneNumber']?>" name="int_phoneNumber" size="30" type="text"> <?php echo $phoneErr; ?> </td>
        </tr>

        <tr>
            <td>
            </td><td height="7px"><font style="font-size: 4px">&nbsp;</font></td>
            
        </tr>

        <tr>
            <td class="reg-form_title" valign="middle"><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">Query:</span></td>
            <td align="left"><textarea class="reg-form_inputs_field required validate-password-conf" id="txt_query" name="txt_query" rows="30" cols="30"><?php echo $_POST['txt_query'] ?></textarea>
			<?php echo $txt_queryErr; ?></td>
        </tr>
		<tr>
            <td>
            </td><td height="7px"><font style="font-size: 4px">&nbsp;</font></td>
            
        </tr>
		<tr>
            <td>
            </td><td height="7px">
            <!--<a class="button" href="#">Sign Up Now</a>-->
              <label class="fa-btn btn-1 btn-1e">
             <input type="submit" name="sbt_signUp" value="Register Now"> </label>
           
            </td>
            
        </tr>
		
		<tr>
            <td colspan="2">
			
            </td>
        </tr>

    </tbody></table>
                                                        </form>
                      </div>
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
