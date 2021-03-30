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
<script type="text/javascript">
function newPopup(url) {
    popupWindow = window.open(
        url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
</script>
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
            <li><a href="contact_us_inquiry.php" ><b>Contact Inquiry</b></a></li>
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
        <table width="80%" border="1px solid" align="center" cellpadding="0" cellspacing="0" class="bgwhite rtshadow ltshadow">
                <tr align="center" style="background: none repeat scroll 0 0 black;color: white;height: 43px">
                <td>Sr No</td>
                <td>Company Name</td>
                <td>Site URL </td>
                <td>Unique Site Traffic</td>
                
                <td>First Name</td>
                
                
                <td>Email</td>
                <td>Password</td>
                
                <td>Status</td>
                <td>Edit</td>
                <td>View More</td>
                
            </tr>
<?php
                $sql_getRegisterDetails = "SELECT * FROM register";
                $result_registerDetails = mysql_query($sql_getRegisterDetails,$con);
                $int_loopwhile = 1;
                while($row = mysql_fetch_array($result_registerDetails))    
                {
                    echo "<tr align='center'  height='43px'>";    
                    echo "<td>".$int_loopwhile."</td>";
                    if($row['company_name'])
                    {
                        echo "<td>".$row['company_name']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    if($row['siteurl'])
                    {
                        echo "<td>".$row['siteurl']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    if($row['unique_traffic_site'])
                    {
                        echo "<td>".$row['unique_traffic_site']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    
                    if($row['first_name'])
                    {
                        echo "<td>".$row['first_name']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    if($row['email'])
                    {
                        echo "<td>".$row['email']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    if($row['password'])
                    {
                        echo "<td>".$row['password']."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    
                    if($row['active']  == '1')
                    {
                        echo "<td>Active</td>";
                    }
                    elseif($row['active']  == '0')
                    {
                        echo "<td>Inactive</td>";
                    }
                    echo "<td><a href='registers_edit.php?smeditid=".$row['reg_id']."'><b>Edit</b></a></td>";
?>                   <td> <a href="JavaScript:newPopup('more_user_details.php?regusrid=<?= $row['reg_id']?>');"><b>View More</b></a></td>
<?php
                    
                    echo "</tr>";
                    
                    $int_loopwhile++;
                }
//                mysql_close($conn);
?>
            </table>
    
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