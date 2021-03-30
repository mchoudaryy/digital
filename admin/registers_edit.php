  
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
if($_SESSION['digitalmedia_user_type'] != 'admin' )
{
    header('location:'.$path_to_root.'/error.php');
}
include '../config.php';


  $sql_getRegisterDetailsEdit = "SELECT * FROM register WHERE reg_id='".$_REQUEST['smeditid']."'";
  
  $result_registersDetails = mysql_query($sql_getRegisterDetailsEdit,$con);
  
  $arr_registersDetails = mysql_fetch_array($result_registersDetails);
  if(!isset($_POST['btn_detailsupdate']))
  {
        $_POST['txt_company'] = $arr_registersDetails['company_name'];
      
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
        $_POST['drp_status'] = $arr_registersDetails['status']; 
  }
  if(isset($_POST['btn_detailsupdate']))
  {
      
       if($_POST["txt_company"] == "")
    {
    $companyErr = "<font color=red>Field is required</font>";
    $flag_error = true;

    }

 if($_POST["siteurl"] == "") {
    $siteurlErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["drp_uniqueSiteTraffic"] == "") {
    $drp_uniqueSiteTrafficErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["custentity_inventory_type"] == "") {
    $custentity_inventory_typeErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["custentity_creation_of_site"] == "") {
    $custentity_creation_of_siteErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["custentity_monthly_revenue"] == "") {
    $custentity_monthly_revenueErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }

  if($_POST["txt_firstName"] == "") {
    $txt_firstNameErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["txt_lastName"] == "") {
    $txt_lastNameErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["txt_address"] == "") {
    $txt_addressErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["txt_zipcode"] == "") {
    $txt_zipcodeErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["txt_city"] == "") {
    $txt_cityErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["state"] == "") {
    $stateErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["country"] == "") {
    $countryErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  if($_POST["txt_email"] == "") {
    $txt_emailErr = "<font color=red>Field is required</font>";
    $flag_error = true;
  }
  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
// Run the preg_match() function on regex against the email address
if (!preg_match($regex, $_POST["txt_email"]))
{
    $txt_emailErr = "<font color=red>Invalid Email</font>";
    $flag_error = true;
}
   $sql_checkemail = "SELECT email FROM register WHERE reg_id NOT IN ('".$_REQUEST['smeditid']."')";
//   echo $sql_checkemail;
    $result_checkEmail = mysql_query($sql_checkemail);
    while($arr_checkEmailRecords = mysql_fetch_array($result_checkEmail))
    {
//    echo '<br>db mail  '.$arr_checkEmailRecords['email'].'  txt mail'.$_POST['txt_email'].'</br>';
    if($arr_checkEmailRecords['email'] ==  $_POST['txt_email'])
    {
        $txt_emailErr = "<font color=red>Email already exists</font>";
        $flag_error = true;
//        echo 'error'.$flag_error;
//        break;
    }
    }
    
  if($_POST["txt_phone"] == "") {
    $txt_phoneErr = "<font color=red>Field is required</font>";
    $flag_error = true;

  }
  if($flag_error == true)
  {
      $error_header = "<p align=center><font color=red>Please check the errors</font></p>";
  }
      if($flag_error == false)
      {
            $sql_updateUserDetails = "UPDATE 
                                          register 
                                        SET

                                          company_name = '".$_POST['txt_company']."',
                                          siteurl = '".$_POST['siteurl']."',
                                          unique_traffic_site = '".$_POST['drp_uniqueSiteTraffic']."',
                                          inventory_type = '".$_POST['custentity_inventory_type']."',
                                          create_of_site = '".$_POST['custentity_creation_of_site']."',
                                          monthly_revenue = '".$_POST['custentity_monthly_revenue']."',
                                          title = '".$_POST['txt_title']."',
                                          first_name = '".$_POST['txt_firstName']."',
                                          last_name = '".$_POST['txt_lastName']."',
                                          address1 = '".$_POST['txt_address']."',
                                          address2 = '".$_POST['txt_address2']."',
                                          zip_code = '".$_POST['txt_zipcode']."',
                                          city = '".$_POST['txt_city']."',
                                          state = '".$_POST['state']."',
                                          country = '".$_POST['country']."',
                                          email = '".$_POST['txt_email']."',
                                          phone = '".$_POST['txt_phone']."',
                                          active = '".$_POST['drp_status']."' 
                                        WHERE reg_id = '".$_REQUEST['smeditid']."' ";
//            echo $sql_updateUserDetails;

            if(mysql_query($sql_updateUserDetails))
            {
                $success_message = "<p style='color:green' align=center><b>User details updated successfully !</b></p>";
            }
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
               <li><a href="../index.php"><b>Visit Web Site</b></a></li>
             <li class="active"><a href="registers_inquiry.php" ><b>Users</b></a></li>
              <li ><a href="contact_us_inquiry.php" ><b>Contact Inquiry</b></a></li>
          
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
          <h2>Edit User Details</h2>
          <form method="post" action="">
          
          <table width="550" cellpadding="5" cellspacing="2" style="font-size:14px;">
              <tbody>
                <tr>
                  <td colspan=""><strong>Site Information</strong></td>
                   <td><?php
echo $error_header;
  
if($flag_error == false)
{
      if(isset($_POST['btn_detailsupdate']))
      {
    echo $success_message;
     $_POST = "";
      }
//   
}
 
?></td>
                </tr>
                <tr>
                  <td width="196"><br></td>
                  <td width="342">&nbsp;</td>
                </tr>
                <tr>
                  <td> Company:</td>
                  <td><span><input type="text" id="txt_company" name="txt_company" value="<?=$_POST['txt_company']?>" size="25"> <?php echo $companyErr; ?></span></td>
                </tr>
                <tr>
                <tr>
                  <td> Site URL:</td>
                  <td><span style="white-space: nowrap" id="custentity_url_fs" class="effectStatic">
                          <input id="siteurl" value="<?=$_POST['siteurl']?>" name="siteurl" type="text" size="25"><?php echo $siteurlErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Unique Site Traffic:</td>
                  <td><span id='custentity_unique_site_traffic_fs' class='' style="white-space: nowrap;">
                    <select   name='drp_uniqueSiteTraffic' value="<?=$_POST['drp_uniqueSiteTraffic']?>"  id='drp_uniqueSiteTraffic' class='inputreq' flags='' valuewhenrendered='' onChange="">
                      <option value='' selected></option>
                      <option value='Less Than 50' <?php if($_POST['drp_uniqueSiteTraffic']=="Less Than 50"){ echo 'selected="selected"'; }?> >Less Than 50</option>
                      <option value='50 - 150' <?php if($_POST['drp_uniqueSiteTraffic']=="50 - 150"){ echo 'selected="selected"';} ?> >50 - 150</option>
                      <option value='150 - 500' <?php if($_POST['drp_uniqueSiteTraffic']=="150 - 500"){ echo 'selected="selected"';} ?> >150 - 500</option>
                      <option value='500 - 1,000' <?php if($_POST['drp_uniqueSiteTraffic']=="500 - 1,000"){ echo 'selected="selected"';} ?> >500 - 1,000</option>
                      <option value='1,000 - 2,000' <?php if($_POST['drp_uniqueSiteTraffic']=="1,000 - 2,000"){ echo 'selected="selected"';} ?> >1,000 - 2,000</option>
                      <option value='2,000 - 5,000' <?php if($_POST['drp_uniqueSiteTraffic']=="2,000 - 5,000"){ echo 'selected="selected"';} ?> >2,000 - 5,000</option>
                      <option value='5,000 - 10,000' <?php if($_POST['drp_uniqueSiteTraffic']=="5,000 - 10,000"){ echo 'selected="selected"';} ?> >5,000 - 10,000</option>
                      <option value='More than 10,000' <?php if($_POST['drp_uniqueSiteTraffic']=="More than 10,000"){ echo 'selected="selected"';} ?> >More than 10,000</option>
                    </select>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $drp_uniqueSiteTrafficErr; ?></span></span></td>
                </tr>
                <tr>
                  <td> Inventory Type:</td>
                  <td><span id='custentity_inventory_type_fs' style="white-space: nowrap;">
                    <select   name='custentity_inventory_type' value="<?=$_POST['custentity_inventory_type']?>" id='custentity_inventory_type' class='inputreq' flags='2268816605312' valuewhenrendered='' onChange="this.isvalid=(nlapiValidateField(null,'custentity_inventory_type'));if (!this.isvalid) return false;if(!this.noslaving) { setWindowChanged(window, true); }nlapiFieldChanged(null,'custentity_inventory_type');" iFlags='2268816605312'>
                      <option value='' selected></option>
                      <option value='Domainer'  <?php if($_POST['custentity_inventory_type']=="Domainer"){ echo 'selected="selected"'; }?> >Domainer</option>
                      <option value='Social Media Application'  <?php if($_POST['custentity_inventory_type']=="Social Media Application"){ echo 'selected="selected"'; }?> >Social Media Application</option>
                      <option value='Website'  <?php if($_POST['custentity_inventory_type']=="Website"){ echo 'selected="selected"'; }?> >Website</option>
                    </select>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $custentity_inventory_typeErr; ?></span></span></td>
                </tr>
                <tr>
                  <td> Creation of
                    Site:</td>
                  <td><span id='custentity_creation_of_site_fs' class='' style="white-space: nowrap;">
                    <select   name='custentity_creation_of_site' value="<?=$_POST['custentity_creation_of_site']?>" id='custentity_creation_of_site' class='inputreq' flags='2268816605312' valuewhenrendered='' onChange="this.isvalid=(nlapiValidateField(null,'custentity_creation_of_site'));if (!this.isvalid) return false;if(!this.noslaving) { setWindowChanged(window, true); }nlapiFieldChanged(null,'custentity_creation_of_site');" iFlags='2268816605312'>
                      <option value='' selected>Select</option>
                      <?php
                     
                      for($loop_year ='1995'; $loop_year <= '2016';$loop_year++)
                      {
//                         
                         ?>
                      <option value="<?= $loop_year?>" <?php if($_POST['custentity_creation_of_site'] == $loop_year) { echo 'selected="selected"'; }?> >
                          <?php echo $loop_year;?>
                      </option>
                      <?php
                      }
                          ?>
                    </select>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $custentity_creation_of_siteErr; ?></span></span></td>
                </tr>
                <tr>
                  <td> Monthly
                    Revenue:</td>
                  <td><span id='custentity_monthly_revenue_fs' class='' style="white-space: nowrap;">
                    <select   name='custentity_monthly_revenue' value="<?=$_POST['custentity_monthly_revenue']?>" id='custentity_monthly_revenue' class='inputreq' flags='2268816605312' valuewhenrendered='' onChange="this.isvalid=(nlapiValidateField(null,'custentity_monthly_revenue'));if (!this.isvalid) return false;if(!this.noslaving) { setWindowChanged(window, true); }nlapiFieldChanged(null,'custentity_monthly_revenue');" iFlags='2268816605312'>
                      <option value='' selected></option>
                      <option value='$0 - $50' <?php if($_POST['custentity_monthly_revenue']=="$0 - $50"){ echo 'selected="selected"'; }?> >$0 - $50</option>
                      <option value='$51 - $500' <?php if($_POST['custentity_monthly_revenue']=="$51 - $500"){ echo 'selected="selected"'; }?> >$51 - $500</option>
                      <option value='$501 - $1000' <?php if($_POST['custentity_monthly_revenue']=="$501 - $1000"){ echo 'selected="selected"'; }?> >$501 - $1000</option>
                      <option value='$1,001 - $5,000' <?php if($_POST['custentity_monthly_revenue']=="$1,001 - $5,000"){ echo 'selected="selected"'; }?> >$1,001 - $5,000</option>
                      <option value='$5,001 - $10,000' <?php if($_POST['custentity_monthly_revenue']=="$5,001 - $10,000"){ echo 'selected="selected"'; }?> >$5,001 - $10,000</option>
                      <option value='$10,001 - $50,000' <?php if($_POST['custentity_monthly_revenue']=="$10,001 - $50,000"){ echo 'selected="selected"'; }?> >$10,001 - $50,000</option>
                      <option value='$50,000 +' <?php if($_POST['custentity_monthly_revenue']=="$50,000 +"){ echo 'selected="selected"'; }?> >$50,000 +</option>
                    </select>
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
                          <input type="text" value="<?=$_POST['txt_title']?>" id="txt_title" name="txt_title" size="25">
                    </span></td>
                </tr>
                <tr>
                  <td> First
                    Name:</td>
                  <td><span style="white-space: nowrap" id="firstname_fs" class="effectStatic">
                          <input type="text" id="txt_firstName" name="txt_firstName" value="<?=$_POST['txt_firstName']?>" size="25"><?php echo $txt_firstNameErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Last
                    Name:</td>
                  <td><span style="white-space: nowrap" id="lastname_fs" class="effectStatic">
                          <input  type="text" id="txt_lastName" name="txt_lastName" value="<?=$_POST['txt_lastName']?>" size="25"><?php echo $txt_lastNameErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Address1:</td>
                  <td><span style="white-space: nowrap" id="address1_fs" class="effectStatic">
                          <input type="text" id="txt_address" name="txt_address" value="<?=$_POST['txt_address']?>" size="25"><?php echo $txt_addressErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Address2:</td>
                  <td><span style="white-space: nowrap" id="address2_fs" class="effectStatic">
                          <input type="text" id="txt_address2" name="txt_address2" value="<?=$_POST['txt_address2']?>" size="25"><?php echo $txt_address2Err; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Zipcode:</td>
                  <td><span style="white-space: nowrap" id="zipcode_fs" class="effectStatic">
                          <input type="text" id="txt_zipcode" name="txt_zipcode" value="<?=$_POST['txt_zipcode']?>" size="25"><?php echo $txt_zipcodeErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> City:</td>
                  <td><span style="white-space: nowrap" id="city_fs" class="effectStatic">
                          <input type="text" id="txt_city" name="txt_city" value="<?=$_POST['txt_city']?>" size="25"><?php echo $txt_cityErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> State:</td>
                  <td><span id='state_fs' class='' style="white-space: nowrap;">
                          <input type="text" id="txt_city" name="state" value="<?=$_POST['state']?>" size="25">
                
                    <span class='field_widget_helper_pos effectStatic'><?php echo $stateErr; ?></span></span></td>
                </tr>
                <tr>
                <tr>
                  <td> Country:</td>
                  <td><span id='country_fs' class='' style="white-space: nowrap;">
                   <select   name='country' value="<?=$_POST['country']?>" id='country' class='inputreq' flags='2267742732416' valuewhenrendered='US' onChange="this.isvalid=(nlapiValidateField(null,'country'));if (!this.isvalid) return false;if(!this.noslaving) { setWindowChanged(window, true); }if (Synccountry(true,null,null,null,null,null) == false) return false;if (getEventTarget(event)==this)this.focus();nlapiFieldChanged(null,'country');" iFlags='2267742732416'>
                                           
                      ?>

                                            <option value='' selected>Select</option>
<?php
                      $sql_getCountry = "SELECT * FROM country";
                      $result_getCountry = mysql_query($sql_getCountry,$con);
                      $loop_state = 1;
                      while($arr_countries = mysql_fetch_array($result_getCountry))
                      {
?>
                      <option value="<?= $arr_countries['rec_id']?>" <?php if($_POST['country'] == $arr_countries['rec_id']) { echo 'selected="selected"'; }?> >
<?php                               echo $arr_countries['country_name'];
?>
                      </option>
<?php
                      }
?>
                    </select>
                    <span class='field_widget_helper_pos effectStatic'> <?php echo $countryErr; ?></span></span></td>
                </tr>
                <tr>
                  <td> Email:</td>
                  <td><span style="white-space: nowrap" id="email_fs" class="effectStatic">
                          <input type="text" value="<?= $_POST['txt_email']?>" id="txt_email" name="txt_email" size="25"><?php echo $txt_emailErr; ?>
                    </span></td>
                </tr>
                <tr>
                  <td> Phone:</td>
                  <td><span style="white-space: nowrap" id="phone_fs" class="effectStatic">
                          <input type="text" id="txt_phone" value="<?=$_POST['txt_phone']?>" name="txt_phone" size="25"><?php echo $txt_phoneErr; ?>
                    </span></td>
                </tr>
                    <tr>
                  <td> Unique Site Traffic:</td>
                  <td><span id='custentity_unique_site_traffic_fs' class='' style="white-space: nowrap;">
                    <select   name='drp_status' value="<?=$_POST['drp_status']?>"  id='drp_status' class='inputreq' flags='' valuewhenrendered='' onChange="">
                      
                      <option value='1' <?php if($_POST['drp_status']=="1"){ echo 'selected="selected"'; }?> >Active</option>
                      <option value='0' <?php if($_POST['drp_status']=="0"){ echo 'selected="selected"';} ?> >Inactive</option>
                      
                    </select>
                    <span class='field_widget_helper_pos effectStatic'><?php echo $drp_uniqueSiteTrafficErr; ?></span></span></td>
                </tr>
               
              </tbody>
            </table></td>
        </tr>
      </table>
   
      <div></div>
            <div>
              <label class="fa-btn btn-1 btn-1e">
                <input type="submit" name="btn_detailsupdate" value="Update User Details">
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
        <p class="link"><span>&#169; All rights reserved | Digital Ad Media Limited</span><span>| <a href="../logout.php">Logout</span></p>
      </div>
    </div>
  </div>
</div>
</body>
</html>