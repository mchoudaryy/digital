<?php//error_reporting(0);error_reporting(0);session_start();?><!DOCTYPE HTML><html><head><title>Welcome | Digital Ad Media</title><link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' /><link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><meta name="viewport" content="width=device-width, initial-scale=1"><!--[if lt IE 9]>     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><script type="text/javascript" src="js/jquery.min.js"></script><script type="text/javascript" src="js/bootstrap.js"></script><script type="text/javascript" src="js/bootstrap.min.js"></script></head><body><div>  <div class="container">    <div class="row header">      <div class="logo navbar-left">        <h1><a href="index.php"><img src="images/logo.jpg" width="287" height="88"> </a></h1>      </div>      <div class="clearfix"></div>    </div>    <div class="row h_menu">      <nav class="navbar navbar-default navbar-left" role="navigation">         <div class="navbar-header">          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>        </div>        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">          <ul class="nav navbar-nav">            <li><a href="index.php">Home</a></li>            <li><a href="advertisers.php">Advertisers</a></li>            <li><a href="publishers.php">Publishers</a></li>             <li class="active"><a href="data-services.php">Data Services</a></li>            <li><a href="contact.php">Contact</a></li><?php                  $path_to_root = "..";if($_SESSION['digitalmedia_sid'] != session_id() || $_SESSION['digitalmedia_sid']==""){?>              <li><a href="login.php">Login</a></li>              <li><a href="register.php">Sign up</a></li>    <?php                  }                    if($_SESSION['digitalmedia_user_type'] == 'admin')                    {?>                                          <li><a href="admin/registers_inquiry.php">Control Panel</a></li><?php                                            }                                 ?>          </ul>        </div>      </nav>    </div>    <div class="clearfix"></div>  </div></div><div class="main_bg">  </div><div class="main_btm">  <div class="container">    <div class="main row">        <div class="col-md-6 content_left"> <img src="images/pic4.JPG" alt="" class="img-responsive"> </div>      <div class="col-md-6 content_right">        <h4><strong>Real-Time Market Data</strong></h4> <br>                      <span style="font-size:20px; font-weight: bold;">Sustain a competitive edge with low latency data feeds and services</span>        <p class="para">Competing in the high-performance trading arena requires a broad universe of low and ultra-low latency financial information. Organizations must acquire globally normalized and aggregated market content from an ever-increasing number of sources, trading venues and asset classes, while keeping pace with the exponential growth of data rates and constant pressure to reduce latencies.<br><br>Digital Ad Media addresses these challenges, offering ultra-low latency direct raw data feeds from over 50 liquidity pools, and a low latency consolidated feed that aggregates content from over 450 sources in a normalized format. Digital Ad Media provides the content breadth, performance and market access required to power the latest algorithmic and electronic trading applications. These feeds leverage a highly sophisticated, latency-optimized infrastructure. Our cost-effective consolidated feed solution delivers a wide range of global financial information, including exchange and over-the-counter (OTC) data, contributed and historical content, news, corporate actions, and reference and fundamental data <br><br><h4><strong>Pricing Services</strong></h4> <br>          <span style="font-size:20px; font-weight: bold;">Essential pricing data from an extensive range of global markets</span>        <p class="para">Digital Ad Media collects, edits, maintains and delivers pricing and pricing-related data from more than 450 markets and exchanges globally. This end-of-day, intra-day and real-time data provides the mission-critical information needed to value diverse portfolios and power financial applications. The data includes bid and offer, last trade, open and close, high and low and volume data.<br><br>        </div>    </div>  </div></div><div class="footer_bg">  <div class="container">    <div class="row  footer">      <div class="copy text-center">        <p class="link"><span>&#169; All rights reserved | Digital Ad Media Limited</span></p>      </div>    </div>  </div></div></body></html>