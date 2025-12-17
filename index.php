<?php
ob_start();

// Include Functions
require_once("./includes/functions.inc.php");

// Form display variable
$output_form = true;

// Form Error Text
$errorText = '';

// Email Send To Variables
$emailTo = 'frank@frankjamison.com';
$emailSubject = 'FCJamison.com Contact Form Submission';
$emailMessage = '';

// Form Input Variables
$firstName = '';
$lastName = '';
$emailAddress = '';
$comment = '';

// Validated Input Variables
$validFirstName = '';
$validLastName = '';
$validEmailAddress = '';
$validComment = '';

//RegEx Patterns
$regExFirstName = '/^[a-zA-Z]{2,15}$/';
$regExLastName = '/^[a-zA-Z]{2,15}$/';
$regExEmailAddress = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
$regExComment = '/^.{2,}$/';

if (isset($_POST['submit'])) { // data posted

	// Get Form Input
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$emailAddress = trim($_POST['emailAddress']);
	$comment = trim($_POST['comment']);

	// Check for Empty Fields
	if (
		empty($_POST['firstName']) ||
		empty($_POST['lastName']) ||
		empty($_POST['emailAddress']) ||
		empty('comment')
	) {
		$errorText .= "\t\t\t\t\t<p>All fields are required.</p>\r";

		// Display Form
		$output_form = true;

	} else { // All fields have content

		// Validate Required Input
		$validFirstName = fieldValidation($regExFirstName, $firstName);
		$validLastName = fieldValidation($regExLastName, $lastName);
		$validEmailAddress = fieldValidation($regExEmailAddress, $emailAddress);
		$validComment = fieldValidation($regExComment, $comment);

		// Check for false values
		if (
			$validFirstName == false ||
			$validLastName == false ||
			$validEmailAddress == false ||
			$validComment == false
		) {

			// Display Error Text
			if ($validFirstName == false) {
				$errorText .= "\t\t\t\t\t<p>Please enter a <em>First Name</em> between 2 and 15 characters.</p>\r";
			}

			if ($validLastName == false) {
				$errorText .= "\t\t\t\t\t<p>Please enter a <em>Last Name</em> between 2 and 15 characters.</p>\r";
			}

			if ($validEmailAddress == false) {
				$errorText .= "\t\t\t\t\t<p>Please enter a valid <em>Email Address</em>.</p>\r";
			}

			if ($validComment == false) {
				$errorText .= "\t\t\t\t\t<p>Please enter at least two characters in the <em>Comment</em> field.</p>\r";
			}

			// Display Form
			$output_form = true;
		} else { // All input is valid

			$emailMessage = "Form details below.\n\n";
			$emailMessage .= "First Name: " . clean_string($validFirstName) . "\n";
			$emailMessage .= "Last Name: " . clean_string($validLastName) . "\n";
			$emailMessage .= "Email: " . clean_string($validEmailAddress) . "\n";
			$emailMessage .= "Comment: " . clean_string($comment) . "\n";

			// create email headers
			$headers = 'From: ' . $emailAddress . "\r\n" .
				'Reply-To: ' . $emailAddress . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			@mail($emailTo, $emailSubject, $emailMessage, $headers);

			// Do not display form
			$output_form = false;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Frank Jamison | Portfolio</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">

	<!-- Bootstrap and Font Awesome css-->
	<link rel="stylesheet" type="text/css"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Google fonts - Montserrat for headings, Cardo for copy-->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Cardo:400,400italic,700">

	<!-- theme stylesheet-->
	<link rel="stylesheet" type="text/css" href="css/style.default.css" id="theme-stylesheet">

	<!-- ekko lightbox-->
	<link rel="stylesheet" type="text/css" href="css/ekko-lightbox.css">

	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<!-- Favicon-->
	<link rel="shortcut icon" href="favicon.png">

	<!-- Tweaks for older IEs--><!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>

<body data-spy="scroll" data-target="#navigation" data-offset="120">

	<!-- introduction-->
	<section id="intro" style="background-image: url('img/streambw.jpg');" class="intro">
		<div class="overlay"></div>
		<div class="content">
			<div class="container clearfix">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-sm-12">
						<p class="italic">Oh, hello there, nice to meet you!</p>
						<h1>I am Frank Jamison... <br>Website Developer</h1>
						<p class="italic">This is my portfolio of completed website development and programming
							projects.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Introduction End -->

	<!-- Navigation Bar -->
	<header class="header">
		<div class="sticky-wrapper">
			<div role="navigation" class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" title="Website Navigation" data-toggle="collapse"
							data-target=".navbar-collapse" class="navbar-btn btn-sm navbar-toggle"
							alt="Frank Jamison logo">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#intro" class="navbar-brand scroll-to"><img src="img/logo-frank-jamison-40.png"
								alt="Frank Jamison Logo"></a>
					</div>
					<div id="navigation" class="collapse navbar-collapse navbar-right">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#intro">Home</a></li>
							<li><a href="#about">About </a></li>
							<li><a href="#services">Skills</a></li>
							<li><a href="#portfolio">Portfolio</a></li>
							<li><a href="#goals">Goals</a></li>
							<li><a href="#contact">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Navigation Bar -->

	<!-- About-->
	<section id="about" class="text">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="heading">About me</h2>
					<p class="lead">My Background</p>
					<p>Thank you for taking the time to view my online portfolio. As you know, my name is Frank Jamison,
						and I am a web developer and computer programmer living in Hemet, California. </p>
					<p>My educational background includes associate degrees in Math/Science, Humanities, Liberal Arts
						Studies, and Social/Behavioral Science from Mt. San Jacinto College in San Jacinto, California;
						a bachelor's degree in Computer Science from National University in La Jolla, CA; and a
						Certificate in Web Development from UC Davis in Davis, California. I am currently working toward
						a master's degree in Information Technology with a concentration in Web Design at Southern New
						Hampshire University in Manchester, New Hampshire that I hope to complete this year.</p>
					<p>I enjoy membership in such national organizations as the American Association for the Advancement
						of Science, the National Society of Leadership and Success, the Interaction Design Foundation,
						and the Society for Technical Communication. I have also held memberships with with both the
						Association for Computing Machinery and the Institute of Electrical and Electronics Engineers.
					</p>
					<p>I am currently employed as an associate application developer in the IT department at Broadridge
						Advisor Solutions in San Diego, CA.</p>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<p><img src="img/frankbw.jpg" alt="Frank Jamison" class="img-responsive img-circle"></p>
				</div>
			</div>
		</div>
	</section>
	<!-- About end-->

	<!-- Services-->
	<section id="services" style="background-color: #eee">
		<div class="container">
			<div class="row services">
				<div class="col-md-12">
					<h2 class="heading">Skills</h2>
					<div class="row">
						<div class="col-sm-4">
							<div class="box">
								<div class="icon"><i class="fa fa-desktop"></i></div>
								<h4>Front-End Development</h4>
								<p>I am skilled in the use of HTML, CSS, and JavaScript having studied at SNHU, UC
									Davis, and various other online learning institutions. </p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<div class="icon"><i class="fa fa-print"></i></div>
								<h4>Server-Side Programming</h4>
								<p>I am at the beginning stages of learning back-end server programming in languages
									such as ColdFusion, C#, and SQL.</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<div class="icon"><i class="fa fa-globe"></i></div>
								<h4>Search Engine Optimization</h4>
								<p>I am well versed in Search Engine Optimization and have studied how to become an SEO
									Expert at Lynda.com </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Services end-->

	<!-- Portfolio / gallery-->
	<section id="portfolio" class="gallery">
		<div class="container clearfix">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 col-lg-8">
							<h2 class="heading">Portfolio</h2>
							<p>Here is a small sampling of some of the projects I have completed... </p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/171WEB501-Final-Project/index.html"
									title="UC Davis 171WEB501 Final Project" target="_blank"><img
										src="img/Portfolio-171WEB501-Final.png" alt="UC Davis 171WEB501 Final Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">UC Davis<br>Creating Functional Websites<br>Final Project</h5>
									<a href="portfolio/source-code/171WEB501-Final-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/172WEB511-Guessing-Game/index.html"
									title="UC Davis 172WEB511 JavaScript Guessing Game" target="_blank"><img
										src="img/Portfolio-172WEB511-JavaScript-Guessing-Game.png"
										alt="UC Davis 172WEB511 JavaScript Guessing Game" class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">UC Davis<br>Web Programming with JavaScript<br>Guessing Game
									</h5>
									<a href="portfolio/source-code/172WEB511-Guessing-Game.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/172WEB511-Final-Project/index.html"
									title="UC Davis 172WEB511 Final Project" target="_blank"><img
										src="img/Portfolio-171WEB511-Final.png" alt="UC Davis 171WEB511 Final Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">UC Davis<br>Web Programming with JavaScript<br>Final Project
									</h5>
									<a href="portfolio/source-code/172WEB511-Final-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/173WEB512-Final-Project/index.php"
									title="UC Davis 173WEB512 Final Project" target="_blank"><img
										src="img/Portfolio-173WEB512-Final.png" alt="UC Davis 173WEB512 Final Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">UC Davis<br>Server-Side Scripting with PHP<br>Final Project</h5>
									<a href="portfolio/source-code/173WEB512-Final-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/stat-roller/stat-roller.html" title="JavaScript Stat Roller"
									target="_blank"><img src="img/Portfolio-Javascript-Stat-Roller.png"
										alt="Personal Project JavaScript D&D Stat Roller" class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Personal Project<br>JavaScript<br>D&amp;D Stat Roller</h5>
									<a href="portfolio/source-code/JavaScript-Stat-Roller.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/Lynda-CSS-Essential-Training-Project/"
									title="Lynda.com CSS Essential Training Resume Project" target="_blank"><img
										src="img/Portfolio-Lynda-CSS-Essential-Training-Project.png"
										alt="Lynda.com CSS Essential Training Resume Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Lynda.com<br>CSS Essential Training<br>Resume Project</h5>
									<a href="portfolio/source-code/Lynda-CSS-Essential-Training-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/Lynda-JavaScript-Essential-Training-Analog-Clock-Project/"
									title="Lynda.com JavaScript Essential Training Analog Clock Project"
									target="_blank"><img
										src="img/Portfolio-Lynda-JavaScript-Essewntial-Training-Analog-Clocks.png"
										alt="Lynda.com JavaScript Essential Training Analog Clock Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Lynda.com<br>JavaScript Essential Training<br>Analog Clock
										Project</h5>
									<a href="portfolio/source-code/Lynda-JavaScript-Essential-Training-Analog-Clock-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/Lynda-JavaScript-Essential-Training-Typing-Speed-Tester/"
									title="Lynda.com JavaScript Essential Training Typing Speed Tester"
									target="_blank"><img
										src="img/Portfolio-Lynda-JavaScript-Essential-Training-Typing-Speed-Tester.png"
										alt="Lynda.com JavaScript Essential Training Typing Speed Tester Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Lynda.com<br>JavaScript Essential Training<br>Typing Speed
										Tester Project</h5>
									<a href="portfolio/source-code/Lynda-JavaScript-Essential-Training-Typing-Speed-Tester.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/Lynda-JavaScript-Essential-Training-Responsive-Images/"
									title="Lynda.com JavaScript Essential Training Responsive Images Project"
									target="_blank"><img
										src="img/Portfolio-Lynda-JavaScript-Essential-Training-Responsive-Images-Project.png"
										alt="Lynda.com JavaScript Essential Training Responsive Images Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Lynda.com<br>JavaScript Essential Training<br>Responsive Images
										Project</h5>
									<a href="portfolio/source-code/Lynda-JavaScript-Essential-Training-Responsive-Images-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/174WEB515-Final-Project/" title="UC Davis 174WEB515 Final Project"
									target="_blank"><img src="img/Portfolio-174WEB515-Final.png"
										alt="UC Davis 174WEB515 Final Project" class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">UC Davis<br>Creating Web Applications with AJAX<br>Final Project
									</h5>
									<a href="portfolio/source-code/174WEB515-Final-Project.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box">
								<a href="portfolio/Lynda-PHP-with-MySQL-Essential-Training/public/"
									title="Lynda.com PHP with MySQL Essential Training CMS Project" target="_blank"><img
										src="img/Portfolio-Lynda-PHP-with-MySQL-Essential-Training.png"
										alt="Lynda.com PHP with MySQL Essential Training CMS Project"
										class="img-responsive"></a>
								<div class="projectTitle">
									<h5 class="project">Lynda.com<br>PHP with MySQL Essential Training<br>Content
										Management System Project</h5>
									<a href="portfolio/source-code/Lynda-PHP-with-MySQL-Essential-Training.zip"
										title="Download Source Code">
										<img src="img/download.jpg" alt="Download Source Code" class="download">
									</a>
								</div>
							</div>
						</div>
						<!--
							<div class="col-sm-4">
								<div class="box">
									<a href="portfolio/Lynda-JavaScript-Essential-Training-Responsive-Images/" title="Lynda.com JavaScript Essential Training Responsive Images Project" target="_blank"><img src="img/Portfolio-Lynda-JavaScript-Essential-Training-Responsive-Images-Project.png" alt="Lynda.com JavaScript Essential Training Responsive Images Project" class="img-responsive"></a>
									<div class="projectTitle">
										<h5 class="project">Lynda.com<br>JavaScript Essential Training<br>Responsive Images Project</h5>
										<a href="portfolio/source-code/Lynda-JavaScript-Essential-Training-Responsive-Images-Project.zip" title="Download Source Code">
											<img src="img/download.jpg" alt="Download Source Code" class="download">
										</a>
									</div>
								</div>
							</div>
							-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Portfolio / gallery end-->

	<!-- Goals for 2019 page-->
	<section id="goals" style="background-color: #333;" class="text-page section-inverse">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="heading">Goals for 2019</h2>
					<div class="row">
						<div class="col-sm-6">
							<p>I have made it my personal goal in 2019 to complete mymaster's degree at Southern New
								Hampshire University. This requires successful completion of the following courses:</p>
							<ul>
								<li>IT648 Website Optimization</li>
								<li>IT700 Capstone in Info Technology</li>
							</ul>
							<p>In addition, I plan getting certified as an AWS Cloud Practitioner and AWS Certified
								Developer Associate, as well as completeing online training courses in C# and
								ColdFusion.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Goals Page -->

	<!-- contact-->
	<section id="contact" style="background-color: #fff;" class="text-page">
		<div class="container">
			<div class="row">

				<div class="col-md-12">

					<h2 class="heading">Contact</h2>
					<?php
					if ($output_form) {
						?>
						<div class="row">
							<div class="col-md-6">

								<?= $errorText ?>

								<form action="<?= $_SERVER['PHP_SELF'] . '#contact' ?>" method="post"
									enctype="multipart/form-data">

									<div class="controls">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="firstName">Your first name *</label>
													<input type="text" name="firstName" id="firstName"
														placeholder="Enter your first name" required="required"
														class="form-control">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="lastName">Your last name *</label>
													<input type="text" name="lastName" id="lastName"
														placeholder="Enter your  last name" required="required"
														class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="emailAddress">Your email address *</label>
											<input type="email" name="emailAddress" id="emailAddress"
												placeholder="Enter your  email address" required="required"
												class="form-control">
										</div>
										<div class="form-group">
											<label for="comment">Your message for me *</label>
											<textarea rows="4" name="comment" id="comment" placeholder="Enter your message"
												required="required" class="form-control"></textarea>
										</div>
										<div class="text-center">
											<input type="submit" name="submit" value="Send message"
												class="btn btn-primary btn-block">
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-6">
								<p>If you like my portfolio and wish to contact me about an employment opportunity, please
									fill out the contact form and I will get back to you as soon as possible.</p>
								<p class="social">
									<!--<a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="gplus"><i class="fa fa-google-plus"></i></a><a href="#" title="" class="instagram"><i class="fa fa-instagram"></i></a><a href="#" title="" class="email"><i class="fa fa-envelope"></i></a>-->
								</p>
							</div>
						</div>

						<?php
					} else {
						?>

						<h5>Thank you for submitting my contact form! I will get back to you within 24 hours.</h5>

						<?php
						header("refresh:5; url=https://fcjamison.com/index.php#contact");
					}
					?>

				</div>
			</div>
		</div>
	</section>
	<!--<div id="map"></div>-->
	<footer style="background-color: #111;" class="section-inverse">
		<div class="container">
			<div class="row copyright">
				<div class="col-md-6">
					<p>&copy;2019 Frank Jamison</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Javascript files-->
	<!-- jQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>-->
	<!-- Bootstrap CDN-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!-- jQuery Cookie - For Demo Purpose-->
	<!--<script src="js/jquery.cookie.js"></script>-->
	<!-- Lightbox-->
	<script src="js/ekko-lightbox.js"> </script>
	<!-- Sticky + Scroll To scripts for navbar-->
	<script src="js/jquery.sticky.js"></script>
	<script src="js/jquery.scrollTo.min.js"></script>
	<!-- google maps-->
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYmNwdFLJ4ZadhEI0Evi9hYF69l9NTLZc"></script>-->
	<!-- to use it on your site, generate your own API key for Google Maps and paste it above -->
	<!--<script src="js/gmaps.js"></script>-->
	<!-- main script-->
	<script src="js/front.js"></script>

</body>

</html>