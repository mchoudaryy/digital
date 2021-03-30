<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['sid_digimedia_report']!=session_id())
{
//    $URL = "login.php";
//    header('Location: '.$URL);
    echo '<script type="text/javascript">
                             window.location.href = "login.php"
                    </script>';
}
if(isset($_POST['submit']))
{
    $flag_impressionGenerator = false;
    require_once 'imp_rpt_generator.php';
    require_once 'fun_impgeneration.php';
    $target_path = "upload/";
    $target_path = $target_path . basename($_FILES['file']['name']);
    if($_FILES["file"]["error"] > 0) 
    {
        if($_FILES["file"]["error"] == 4)
        {
             $error_fileUpload = "<p style='color:red'><b>Please select text file to read data<b></p>";
             echo $error_fileUpload;
        }
    }
    else
    {
      if($_FILES["file"]["type"] == "application/vnd.ms-excel")
      {
          if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
             $flag_impressionGenerator = true;
          }
      }
      else
      {
        $error_fileUpload = "<p style='color:red'><b>Error reading file. Only xls files are allowed </b></p>";
         echo $error_fileUpload;
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
                  <li><a href="index.php" class="scroll">Report</a></li>
<?php
                      if($_SESSION['sourcemedia_user_type'] == 'supadmin')
                      {
?>
                            <li class="active"><a href="#">Import Data</a></li>
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
        <div class="contact-form">
<form action="#" method="post" enctype="multipart/form-data">
                        <div align='center'> 
                            Choose file
                                <input type="file" class="upload" name="file"  style="width:260px;" >
                        </div>
                          <br>
                        <div align='center'>
                        <label class="fa-btn btn-1 btn-1e" align>
                             <input type="submit" name="submit" value="Upload Data" class="btn1">
                        </label>
                        </div>

</form>
<?php
if($flag_impressionGenerator == true)
{
   echo "<p align=center style='color:green'><b>The file ".  basename($_FILES['file']['name'])." has been uploaded</p>";
   $content = 'upload/'.$_FILES["file"]["name"];
   $data = new Spreadsheet_Excel_Reader($content);
   $data_generatedImpression = fun_generateImpression($data);
//   header("Location:report.php");
}                              
?>
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