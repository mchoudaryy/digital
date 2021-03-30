<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php


error_reporting(0);
session_start();
$path_to_root = "..";
if($_SESSION['digitalmedia_sid']!=session_id())
{
    $URL = $path_to_root."/login.php";
    header('Location: '.$URL);
}
if($_SESSION['digitalmedia_user_type'] != 'admin' )
{
    header('location:'.$path_to_root.'/error.php');
}

include '../config.php';


  $sql_getRegisterDetailsEdit = "SELECT * FROM register WHERE reg_id='".$_REQUEST['regusrid']."'";

  
  $result_registersDetails = mysql_query($sql_getRegisterDetailsEdit,$con);
  $arr_registersDetails = mysql_fetch_array($result_registersDetails);
 
        $_POST['txt_company'] = $arr_registersDetails['company_name'];
//        echo $_POST['txt_company'];
        $_POST['siteurl'] = $arr_registersDetails['siteurl'];
        $_POST['drp_uniqueSiteTraffic'] = $arr_registersDetails['unique_traffic_site'];
        $_POST['custentity_inventory_type'] = $arr_registersDetails['inventory_type'];
        $_POST['custentity_creation_of_site'] = $arr_registersDetails['create_of_site'];
        $_POST['custentity_monthly_revenue'] = $arr_registersDetails['monthly_revenue'];
        $_POST['txt_title'] = $arr_registersDetails['title'];
        $_POST['txt_firstName'] = $arr_registersDetails['first_name'];
        $_POST['txt_lastName'] = $arr_registersDetails['last_name'];
        $_POST['txt_address'] = $arr_registersDetails['address1'];
        $_POST['txt_address2'] = $arr_registersDetails['address2'];
        $_POST['txt_zipcode'] = $arr_registersDetails['zip_code'];
        $_POST['txt_city'] = $arr_registersDetails['city'];
        $_POST['state'] = $arr_registersDetails['state'];
        $_POST['country'] = $arr_registersDetails['country'];
        $_POST['txt_email'] = $arr_registersDetails['email'];
        $_POST['txt_phone'] = $arr_registersDetails['phone'];
  

  
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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
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
           <!--<li><a href="../index.php"><b>Visit Web Site</b></a></li>-->
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
     


     <form id="form_register" method="post" action="">
                <input type='hidden' name='smeditid' value='<?= $_REQUEST['smeditid']?>'>
      <table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top"><table width="550" cellpadding="5" cellspacing="2" class="signupForm">
              <tbody>
                <tr>
                  <td colspan="2"><b><span class="genericHeader2">Site Information</span></b></td>
                </tr>
<!--                <tr>
                  <td width="196"><br></td>
                  <td width="342"><span class="text12" style="float: left;"> Required fields</span></td>
                </tr>-->
                <tr>
                  <td><span class="required"></span> Company:</td>
                  <td><span><?php echo $_POST['txt_company'] ?></td>
                </tr>
                <tr>
                <tr>
                  <td><span class="required"></span> Site URL:</td>
                  <td><span style="white-space: nowrap" id="custentity_url_fs" class="effectStatic">
                         <?php echo $_POST['siteurl'] ?>
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Unique Site Traffic:</td>
                  <td><span id='custentity_unique_site_traffic_fs' class='' style="white-space: nowrap;">
                    <?php echo $_POST['drp_uniqueSiteTraffic'];  ?>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $drp_uniqueSiteTrafficErr; ?></span></span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Inventory Type:</td>
                  <td><span id='custentity_inventory_type_fs' style="white-space: nowrap;">
                    
                          <?php echo $_POST['custentity_inventory_type'];  ?>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $custentity_inventory_typeErr; ?></span></span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Creation of
                    Site:</td>
                  <td><span id='custentity_creation_of_site_fs' class='' style="white-space: nowrap;">
                           <?php echo $_POST['custentity_creation_of_site'];  ?>
                    
                    <span class='field_widget_helper_pos effectStatic'><?php echo $custentity_creation_of_siteErr; ?></span></span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Monthly
                    Revenue:</td>
                  <td><span id='custentity_monthly_revenue_fs' class='' style="white-space: nowrap;">
                          <?php echo $_POST['custentity_monthly_revenue'];  ?>
                    
                    <span class='field_widget_helper_pos effectStatic'><?php echo $custentity_monthly_revenueErr; ?></span></span></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><span class="genericHeader2"><strong>Affiliate
                    Information</strong></span></td>
                </tr>
                <tr>
                  <td>Title:</td>
                  <td><span style="white-space: nowrap" id="salutation_fs" class="effectStatic">
                           <?php echo $_POST['txt_title'];  ?>
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> First
                    Name:</td>
                  <td><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">
                          <?php echo $_POST['txt_firstName'];  ?>
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Last
                    Name:</td>
                  <td><span style="white-space: nowrap" id="lastname_fs" class="effectStatic">
                          <?php echo $_POST['txt_lastName'];  ?>
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Address1:</td>
                  <td><span style="white-space: nowrap" id="address1_fs" class="effectStatic">
                         <?php echo $_POST['txt_address'];  ?> 
                    </span></td>
                </tr>
                <tr>
                  <td> Address2:</td>
                  <td><span style="white-space: nowrap" id="address2_fs" class="effectStatic">
                         <?php echo $_POST['txt_address2'];  ?> 
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Zipcode:</td>
                  <td><span style="white-space: nowrap" id="zipcode_fs" class="effectStatic">
                         <?php echo $_POST['txt_zipcode'];  ?> 
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> City:</td>
                  <td><span style="white-space: nowrap" id="city_fs" class="effectStatic">
                        <?php echo $_POST['txt_city'];  ?>  
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> State:</td>
                  <td><span id='state_fs' class='' style="white-space: nowrap;">
                          <?php echo $_POST['state'];  ?>
                    
                    <span class='field_widget_helper_pos effectStatic'><?php echo $stateErr; ?></span></span></td>
                </tr>
               
                <tr>
                  <td><span class="required"></span> Country:</td>
                  <td><span id='country_fs' class='' style="white-space: nowrap;">
                          <?php echo $_POST['country'];  ?>
                   
                    <span class='field_widget_helper_pos effectStatic'> <?php echo $countryErr; ?></span></span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Email:</td>
                  <td><span style="white-space: nowrap" id="email_fs" class="effectStatic">
                          <?php echo $_POST['txt_email'];  ?>
                    </span></td>
                </tr>
                <tr>
                  <td><span class="required"></span> Phone:</td>
                  <td><span style="white-space: nowrap" id="phone_fs" class="effectStatic">
                          <?php echo $_POST['txt_phone'];  ?>
                    </span></td>
                </tr>
                
              </tbody>
            </table></td>
        </tr>
      </table>
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