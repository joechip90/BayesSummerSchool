<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bayesian Modelling Summer School</title>
	<link rel="stylesheet" href="./css/main.css" type="text/css" />
</head>
<body>
	<!-- Elements to appear at the top of the website -->
	<div class="top_matter">
    	<div class="title_sec">
        	<div class="main_title">International Summer School on Bayesian Modelling</div>
            <div class="sub_title">An Introduction for Ecologists and Environmental Scientists</div>
        </div>
    	<div class="section_line"></div>
        <div class="date_sec">25<sup>th</sup> - 29<sup>th</sup> September 2017</div>
	</div>
    <!-- Elements to appear at the middle of the website -->
    <div class="mid_matter">
    	<!-- Elements to appear in the sidebar -->
    	<div class="sidebar">
        	<div class="sidebar_element" id="se1"><a href="index.html">Home</a></div>
            <div class="sidebar_element" id="se2"><a href="location.html">Location</a></div>
            <div class="sidebar_element" id="se3"><a href="tutors.html">Tutors</a></div>
            <div class="sidebar_element" id="se4"><a href="programme.html">Programme</a></div>
            <div class="sidebar_current" id="se5">Apply</div>
        </div>
        <!-- Main contents of the page -->
        <div class="main_text">
        	<?php
				// Check the existence and validity of each of the required elements in the application form
				$check_name = isset($_REQUEST["app_name"]) && $_REQUEST["app_name"] != "";
				$check_email = isset($_REQUEST["app_email"]) && isset($_REQUEST["app_rtemail"]) && $_REQUEST["app_email"] != "" && $_REQUEST["app_rtemail"] != "" && $_REQUEST["app_email"] == $_REQUEST["app_rtemail"];
				$check_address = isset($_REQUEST["app_address"]) && $_REQUEST["app_address"] != "";
				$check_research = isset($_REQUEST["app_research"]) && $_REQUEST["app_research"] != "";
				$check_motivation = isset($_REQUEST["app_motivation"]) && $_REQUEST["app_motivation"] != "";
				$check_gender = isset($_REQUEST["app_gender"]);
				$check_pos = isset($_REQUEST["app_pos"]);
				$check_R = isset($_REQUEST["app_R"]);
				
				$mob_str = "";
				if(isset($_REQUEST["app_mobile"]))
				{
					$mob_str = strip_tags($_REQUEST["app_mobile"]);
				}
				$comments_str = "";
				if(isset($_REQUEST["app_comments"]))
				{
					$comments_str = strip_tags($_REQUEST["app_comments"]);
				}
				
				if($check_name && $check_email && $check_address && $check_research && $check_motivation && $check_gender && $check_pos && $check_R)
				{	// Send email to the applicant confirming their application
					$admin_email = "Joseph.Chipperfield@nmbu.no";
					$message_str = "Dear applicant,\n\nThank you for your interest in the International Summer School in Bayesian Modelling.  We have had a high demand for places on the course in the past and so we will undertake an initial review of the applications to ensure that we can prioritise places for those participants that will benefit most from attending.  Applications will be reviewed at midday on 30th July 2017 and you will be notified of the outcome of your application within two weeks of this date.\n\nYour provided details are given below:\n\n\tName: " . strip_tags($_REQUEST["app_name"]) . "\n\tEmail: " . strip_tags($_REQUEST["app_email"]) . "\n\tAddress: " . strip_tags($_REQUEST["app_address"]) . "\n\tMobile: " . $mob_str . "\n\tGender: " . strip_tags($_REQUEST["app_gender"]) . "\n\tPosition: " . strip_tags($_REQUEST["app_pos"]) . "\n\tR Experience: " . strip_tags($_REQUEST["app_R"]) . "\n\tResearch Area: " . strip_tags($_REQUEST["app_research"]) . "\n\tMotivation: " . strip_tags($_REQUEST["app_motivation"]) . "\n\tComments: " . $comments_str . "\n\nIf you have any further questions about the course or application process, then feel free to email Joseph.Chipperfield@bio.uib.no for any assistance.  We will keep you updated on any further developments.  Thank you again for your application!\n\nThe organisers: Joe Chipperfield, Florian Hartig, and Joern Pagel";
					$headers_str = "From: " . $admin_email . "\r\nReply-To: " . $admin_email . "\r\nCc: " . $admin_email;
					$check_mail = mail($_REQUEST["app_email"], "Application: Bayesian Course Lygra 25th-29th September 2017", $message_str, $headers_str);
					if($check_mail)
					{
			?>
            <!-- All required elements are given appropriately -->
            <h1>Application Complete</h1>
            <p>Your application has been submitted.  Thank you for your interest.  You should receive a confirmation email within 24 hours.  If you do not receive your confirmation email please contact <a href="mailto:joseph.chipperfield@nmbu.no">Joe Chipperfield</a>.</p>
            <p>Applications will be reviewed at midday on 30<sup>th</sup> June 2017 and the successful candidates will be notified within two weeks of this date.  If you are applying after the 30<sup>th</sup> June, then you will admitted if we have available places after the initial selection process.  In these cases, you will be notified either within two days of receiving your application or after the 30<sup>th</sup> June, whichever is the latest.  Thank you for your application!</p>
            <p><a href="index.html">Return to course information</a></p>
            <?php
					}
					else
					{
			?>
            <!-- Unable to send confirmation email -->
            <h1>Application Error</h1>
            <p>An error has occurred that means that we are unable to process your application at this time.  Please check that your supplied email address is correct.  If your address is correct then it could be due to our processing server being offline: please try again later.  If this error continues to occur then contact <a href="mailto: joseph.chipperfield@nmbu.no">Joe Chipperfield</a> for support.  Click <a href="apply.html">here</a> to return to the application form.</p>
            <p>Full details of the error is shown below:</p>
            <?php
						print_r(error_get_last());
					}
				}
				else
				{
			?>
            <!-- At least one of the required elements have not been given -->
            <h1>Application Form</h1>
            <p>Some elements of the application form were not filled in correctly.  These have been highlighed below:</p>
            <form method="post" action="apply.php"><table class="form_table">
            	 <tr>
            	     <td class="form_label">Name:</td>
                     <!-- Name is correctly entered -->
                     <?php
					 	if($check_name)
						{
							echo "<td><input type=\"text\" name=\"app_name\" id=\"app_name\" value=\"", strip_tags($_REQUEST["app_name"]), "\"/></td>";
						}
						else
						{
					 ?>
                     <!-- Name is incorrectly entered -->
                     <td><input type="text" name="app_name" id="app_name" class="app_invalid" /></td>
                     <?php
						}
					 ?>
                     <td class="form_desc">(required)</td>
            	 </tr>
            	 <tr>
            	   	 <td class="form_label">E-mail:</td>
                     <!-- Email is correctly entered -->
                     <?php
					 	if($check_email)
						{
							echo "<td><input type=\"text\" name=\"app_email\" id=\"app_email\" value=\"", strip_tags($_REQUEST["app_email"]), "\"/></td>";
						}
						else
						{
					 ?>
                     <!-- Email is incorrectly entered -->
            	     <td><input type="text" name="app_email" id="app_email" class="app_invalid" /></td>
                     <?php
						}
					 ?>
            	     <td class="form_desc">(required)</td>
            	 </tr>
            	 <tr>
            	   	 <td class="form_label">Retype e-mail:</td>
                     <!-- Email is correctly entered -->
                     <?php
					 	if($check_email)
						{
							echo "<td><input type=\"text\" name=\"app_email\" id=\"app_email\" value=\"", strip_tags($_REQUEST["app_rtemail"]), "\"/></td>";
						}
						else
						{
					 ?>
                     <!-- Email is incorrectly entered -->
            	     <td><input type="text" name="app_rtemail" id="app_rtemail" class="app_invalid"/></td>
                     <?php
						}
					 ?>
               	     <td class="form_desc">(required)</td>
             	 </tr>
             	 <tr>
             	  	 <td class="form_label">Mobile phone:</td>
                     <?php
					 	echo "<td><input type=\"text\" name=\"app_mobile\" id=\"app_mobile\" value=\"", strip_tags($_REQUEST["app_mobile"]), "\"/></td>";
					 ?>
               	     <td class="form_desc">(optional: used for contact during the course)</td>
                </tr>
                <tr>
                	<td class="form_label">Address:</td>
                    <td>
                    <?php
						if($check_address)
						{
							echo "<textarea col=20 row=5 name=\"app_address\" id=\"app_address\">" . strip_tags($_REQUEST["app_address"]) . "</textarea>";
						}
						else
						{
					?>
                    <!-- Address is incorrectly entered -->
                    <textarea col=20 row=5 name="app_address" id="app_address" class="app_invalid"></textarea>
                    <?php
						}
					?>
                    </td>
                    <td class="form_desc">(required)</td>
                </tr>
                <tr>
                	<td class="form_label">Gender:</td>
                    <td>
                    	<select name="app_gender" id="app_gender">
                        	<?php
								if(isset($_REQUEST["app_gender"]))
								{
									if($_REQUEST["app_gender"] == "female")
									{
							?>
                        	<option value="female" selected>Female</option>
                            <option value="male">Male</option>
                            <?php
									}
									else
									{
							?>
                            <option value="female">Female</option>
                            <option value="male" selected>Male</option>
                            <?php
									}
								}
								else
								{
							?>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <?php
								}
							?>
                        </select>
                    </td>
                    <td class="form_desc">(required: used for allocation of accommodation)</td>
                </tr>
                <tr>
                	<td class="form_label">Position:</td>
                    <td>
                    	<select name="app_pos" id="app_pos">
                        	<?php
								if(isset($_REQUEST["app_pos"]))
								{
									if($_REQUEST["app_pos"] == "other")
									{
										echo "<option value=\"other\" selected>Other</option>";
									}
									else
									{
										echo "<option value=\"other\">Other</option>";
									}
									if($_REQUEST["app_pos"] == "undergrad")
									{
										echo "<option value=\"undergrad\" selected>Undergraduate</option>";
									}
									else
									{
										echo "<option value=\"undergrad\">Undergraduate</option>";
									}
									if($_REQUEST["app_pos"] == "masters")
									{
										echo "<option value=\"masters\" selected>Masters Student</option>";
									}
									else
									{
										echo "<option value=\"masters\">Masters Student</option>";
									}
									if($_REQUEST["app_pos"] == "phd")
									{
										echo "<option value=\"phd\" selected>PhD Student</option>";
									}
									else
									{
										echo "<option value=\"phd\">PhD Student</option>";
									}
									if($_REQUEST["app_pos"] == "postdoc")
									{
										echo "<option value=\"postdoc\" selected>Post-Doc</option>";
									}
									else
									{
										echo "<option value=\"postdoc\">Post-Doc</option>";
									}
									if($_REQUEST["app_pos"] == "ra")
									{
										echo "<option value=\"ra\" selected>Research Assistant</option>";
									}
									else
									{
										echo "<option value=\"ra\">Research Assistant</option>";
									}
									if($_REQUEST["app_pos"] == "scientist")
									{
										echo "<option value=\"scientist\" selected>Research Scientist</option>";
									}
									else
									{
										echo "<option value=\"scientist\">Research Scientist</option>";
									}
									if($_REQUEST["app_pos"] == "lecturer")
									{
										echo "<option value=\"lecturer\" selected>Lecturer</option>";
									}
									else
									{
										echo "<option value=\"lecturer\">Lecturer</option>";
									}
									if($_REQUEST["app_pos"] == "prof")
									{
										echo "<option value=\"prof\" selected>Professor</option>";
									}
									else
									{
										echo "<option value=\"prof\">Professor</option>";
									}
								}
								else
								{
							?>
                            <option value="other">Other</option>
                            <option value="undergrad">Undergraduate</option>
                            <option value="masters">Masters Student</option>
                            <option value="phd">PhD Student</option>
                            <option value="postdoc">Post-Doc</option>
                            <option value="ra">Research Assistant</option>
                            <option value="scientist">Research Scientist</option>
                            <option value="lecturer">Lecturer</option>
                            <option value="prof">Professor</option>
                            <?php
								}
							?>
                        </select>
                    </td>
                    <td class="form_desc">(required)</td>
                </tr>
                <tr>
                	<td class="form_label">R experience:</td>
                    <td>
                    	<select name="app_R" id="app_R">
	                        <?php
								if(isset($_REQUEST["app_R"]))
								{
									if($_REQUEST["app_R"] == "none")
									{
										echo "<option value=\"none\" selected>None</option>";
									}
									else
									{
										echo "<option value=\"none\">None</option>";
									}
									if($_REQUEST["app_R"] == "beginner")
									{
										echo "<option value=\"beginner\" selected>Beginner</option>";
									}
									else
									{
										echo "<option value=\"beginner\">Beginner</option>";
									}
									if($_REQUEST["app_R"] == "intermediate")
									{
										echo "<option value=\"intermediate\" selected>Intermediate</option>";
									}
									else
									{
										echo "<option value=\"intermediate\">Intermediate</option>";
									}
									if($_REQUEST["app_R"] == "expert")
									{
										echo "<option value=\"expert\" selected>Expert</option>";
									}
									else
									{
										echo "<option value=\"expert\">Expert</option>";
									}
								}
								else
								{
							?>
                            <option value="none">None</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="expert">Expert</option>
                            <?php
								}
							?>
                        </select>
                    </td>
                    <td class="form_desc">(required)</td>
                </tr>
                <tr>
                	<td class="form_label">Research area:</td>
                    <td>
                    <?php
						if($check_research)
						{
							echo "<textarea col=20 row=5 name=\"app_research\" id=\"app_research\">" . strip_tags($_REQUEST["app_research"]) . "</textarea>";
						}
						else
						{
					?>
                    	<textarea col=20 row=5 name="app_research" id="app_research" class="app_invalid"></textarea>
                    <?php
						}
					?>
                    </td>
                    <td class="form_desc">(required: brief statement of research area)</td>
                </tr>
                <tr>
                	<td class="form_label">Motivation:</td>
                    <td>
                    <?php
						if($check_motivation)
						{
							echo "<textarea col=20 row=5 name=\"app_motivation\" id=\"app_motivation\">" . strip_tags($_REQUEST["app_motivation"]) . "</textarea>";
						}
						else
						{
					?>
                    	<textarea col=20 row=5 name="app_motivation" id="app_motivation" class="app_invalid"></textarea>
                    <?php
						}
					?>
                  	</td>
                    <td class="form_desc">(required: brief statement of your reasons for interest in Bayesian methods)</td>
                </tr>
                <tr>
                	<td class="form_label">Comments:</td>
                    <td><textarea col=20 row=5 name="app_comments" id="app_comments">
                    	<?php
							if(isset($_REQUEST["app_address"]))
							{
								echo strip_tags($_REQUEST["app_address"]);
							}
						?>
                    </textarea></td>
                    <td class="form_desc">(optional: dietary requirements, accessibility needs etc.)</td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" value="Submit Application" name="app_submit" /></td>
                    <td></td>
                </tr>
            </table></form>
            <?php
				}
			?>
            </div>
        </div>
    </div>
    <!-- Elements to appear at the bottom of the website -->
    <div class="bottom_matter">
    	<!-- Division containing University icons -->
        <div class="logo_area">
        <span class="logo_text">This course is run in partnership with and supported by:</span>
        <table class="logo_table">
           	<tr>
               	<td><a class="image_link" href="https://www.nmbu.no/en"><img src="./images/NMBULogo.jpg" alt="Norwegian University of Life Sciences"/></a></td>
                <td><a class="image_link" href="http://www.uni-regensburg.de/index.html.en"><img src="./images/RegensburgLogo.jpg" alt="University of Regensburg"/></a></td>
                <td><a class="image_link" href="https://www.uni-hohenheim.de/en/english"><img src="./images/HohenheimLogo.jpg" alt="University of Hohenheim"/></a></td>
            </tr>
        </table></div>
    	<div class="bottom_banner"></div>
    	<div class="section_line"></div>
        <div class="copyright_notice">Website: &copy; 2017 <a href="mailto:joseph.chipperfield@nmbu.no">Joseph Chipperfield</a></div>
        <div class="copyright_notice">Photographs: &copy; 2017 Amy Eycott and Tessa Bargmann</div>
    </div>
</body>
</html>