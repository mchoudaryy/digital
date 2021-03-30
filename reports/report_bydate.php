<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

error_reporting(1);
//ini_set("session.auto_start", 0);
include '../config.php';
//include './converter/action.php';
session_start();
if($_SESSION['sid_digimedia_report']!=session_id())
{
//    $URL = "login.php";
//    header('Location: '.$URL);
    echo '<script type="text/javascript">
                             window.location.href = "login.php"
                    </script>';
}
$chkdt = $_POST['DATE'];
$chkgrp = $_POST['chkgrp'];
$chkctr = $_POST['chkctr'];
if(!isset($_POST['sbt_search'])) $chkdt = 'DATE';
        
$grp[] = 'country';
$colspan =  count($grp);
$grp = implode(',',$grp);
$date=$_POST['DATE'];
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
<style>
    .table_reportSearch{
        width: 60%;
        text-align: center;
        
    }
    .table_reportData{
        width: 80%;
        text-align: center;
      
    }
</style>

<style>
.purple {
	width: 70%;
	text-align: center;
	border:1px solid #9B59B6;/*border:2px solid #9B59B6;*/
    }
.purple thead {
	background:none repeat scroll 0 0 rgba(9, 25, 50, 0.9);
}
.purple thead {
	color:white;
	height: 40px;
}
.purple .cor tr td {
	text-align:center;
	padding:5px 0;
}
 .purple tbody tr:nth-child(even) {
 background:#ECF0F1;
}
 .purple tbody tr:nth-child(odd) {
 background:#dedefc;
}
.purple tbody tr:hover {
	background:#BDC3C7;
	color:#3399ff;
}
#header-fixed {
	position: fixed;
	top: -1px;
	display:none;
	align: center;
	left: 25%;/*    height: 40px;
    text-align: center;
    border:1px solid #9B59B6;
    background:#9B59B6;
    color:white;*/
}
#header-fixed .cor td td {
	text-align:center;
	padding:5px 0;
}
#header-fixed thead {
	background:#9B59B6;
}
#header-fixed thead {
	color:white;
	height: 40px;
}
#header-fixed td {
	text-align:center;
	padding:5px 0;
}
</style>
<script>
         $(document).ready(function(){

var tableOffset = $("#table-1").offset().top;
var $header = $("#table-1 > thead").clone();
var $fixedHeader = $("#header-fixed").append($header);

$(window).bind("scroll", function() {
    var offset = $(this).scrollTop();
    
    if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
        $fixedHeader.show();
    }
    else if (offset < tableOffset) {
        $fixedHeader.hide();
    }
});
}); 
   
    </script>
<script>
    function CompareDate() {

       //Note: 00 is month i.e. January
       var d1date=document.getElementById("from_date").value;
       var d2date=document.getElementById("to_date").value;
       var d1 = d1date.split("-"); 
       var d2 = d2date.split("-"); 
       var dateOne = new Date(d1[0], d1[1], d1[2]); //Year, Month, Date

       var dateTwo = new Date(d2[0], d2[1], d2[2]); //Year, Month, Date
       if((d1date!="" && d1date!=null) && (d2date=="" || d1date==null))
       {
           alert("Please select 'To Date'");
           return false;
       }
       if((d2date!="" && d2date!=null) && (d1date=="" || d1date==null))
       {
           alert("Please select 'From Date'");
           return false;
       }
       if (dateOne > dateTwo) 
       {

            alert("'From Date' should not be higher than 'To Date'");
            return false;
       }

    }    
    </script>
<script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />
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
                  <li class="active"><a href="#" class="scroll">Report</a></li>
<?php
                      if($_SESSION['digimedia_user_type'] == 'supadmin')
                      {
?>
                      <li><a href="upload_report.php">Import Data</a></li>
<?php
                      }
?>            
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
      <!--<div class="col-md-4 company_ad"></div>-->
      <!--<div class="col-md-8">-->
        <div class="contact-form">
          <h2>Date: <?php echo $date; ?> Report.</h2>
            
          
          
      <table id="table-1" align='center' cellspacing='1' cellpadding="4" colspacing='0' class="purple">
          <thead>
          <tr>
            <!--<td>Sr No:</td>-->
            <td width="120">Publisher</td>
             <td width="120">Country</td>
            <td width="120">Installs</td>
            <td width="120">Rate</td>
            <td width="120">Total</td>
          </tr></thead>
         <?php
//         grp cdate country
		 $sql_getImpressionsData = "SELECT country,publisher,SUM(installs) AS total_installs,rate,SUM(total) AS tot "
                                            . "FROM cobundle WHERE cdate='$date'";
              
                    
//                        $sql_getImpressionsData .= " AND MONTH(date)='".$_POST['drp_month']."'";
//                    if($_POST['drp_year'])
//                        $sql_getImpressionsData .= " AND YEAR(date)='".$_POST['drp_year']."'";
//           
                        $sql_getImpressionsData .=  " GROUP BY $grp ";
                $sql_getImpressionsData .=  " ORDER BY cdate,country";
//				echo $sql_getImpressionsData;
		 $result_impressionsData = mysql_query($sql_getImpressionsData,$con);
                 $count_records = mysql_num_rows($result_impressionsData);
		 $int_loopId = 1;
                 if($count_records)
                 {
                    while($arr_impressionsData = mysql_fetch_array($result_impressionsData))
                    {
                    ?>
                       <tr style="text-align: center;height: 30px;">
                       <!--<td><?php // echo $int_loopId; ?></td>-->
                        <td><?php echo $arr_impressionsData['publisher']; ?></td>
            		<td><?php echo $arr_impressionsData['country']; ?></td>
            
            
                        <td align="center"><?php echo number_format($arr_impressionsData['total_installs']); ?></td>
                       <td><?php echo $arr_impressionsData['rate']; ?></td>
                       <td align="center"><?php echo number_format($arr_impressionsData['tot']); ?></td>
                       </tr>
                       <?php
                       $int_totalImpressions += $arr_impressionsData['total_installs'];
                       $int_totalValue += $arr_impressionsData['tot'];
                       $int_loopId++;
                    }
                   
                 }
                 else
                 {
?>
          <tr style="text-align: center;height: 30px;font-weight: bold;text-align: left;"><td colspan="4">Sorry no records found...!</td><td></td></tr>
<?php
                 }
		 ?>
                    <tr style="font-weight: bold;text-align: center;height: 35px;background-color: lightgrey;color:black; ">
                        <td colspan='<?php echo $colspan; ?>' align='right'> Total:&nbsp;&nbsp; </td>
                        <td></td>
                        <td align="center"><?php echo number_format($int_totalImpressions); ?></td>
                        <td></td>
                        <td align="center"><?php echo number_format($int_totalValue,2); ?></td>
                    </tr>
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
        <p class="link"><span>&#169; All rights reserved | Digital Ad Media Limited</span>
<?php
if($_SESSION['sid_digimedia_report'] == session_id()){
?>
               | &nbsp;&nbsp; <a href="logout.php" ><b>Log out</b></a>
            
<?php
}
 ?>        
        
        </p>
      </div>
    </div>
  </div>
</div>
</body>
</html>
