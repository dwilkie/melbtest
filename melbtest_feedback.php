<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
FILE: melbtest_feedback.php

A feedback form which captures feedback and emails results

Notes:
This page validates to XHTML strict.

Author:
    David Wilkie (dwilkie@gmail.com)

    Modified:
    Version 0.1; 2008-01-20 Document created - DCW

    todo:
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Melbourne Testing Services Feedback Form</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div class ="content">
            <h1>Melbourne Testing Services Feedback Form</h1>
            <?php
                function validate_string($rString)
                {
                    $pattern = "^[^\<\>]+$";
                    return ereg($pattern, $rString);
                }

                function validate_name($rString)
                {
                    $mod_string = str_replace(' ', '', $rString);
                    $pattern = "^[a-zA-Z]+$";
                    return ereg($pattern, $mod_string);
                }

                function validate_email($rString)
                {
                    $pattern = "^[a-zA-Z\_\-]+\.?[a-zA-Z\_\-]+@siemens\.com$";
                    return ereg($pattern, $rString);
                }

                function valid_string_text()
                {
                    return 'Cannot contain &lt; or &gt;';
                }

                function valid_name_text()
                {
                    return 'Must only contain letters from A-Z';
                }

                $error = false;

                if ($_POST['submit_form'])
                {
                    if (!validate_name($_POST['contact_name']))
                    {
                        $error = true;
                        $error_text = $error_text."\r\n".'<li>Contact Name not valid - '.valid_name_text().'</li>';
                    }
                    if (!validate_name($_POST['company']))
                    {
                        $error = true;
                        $error_text = $error_text."\r\n".'<li>Company not valid - '.valid_name_text().'</li>';
                    }
                    if (!validate_email($_POST['email']))
                    {
                        $error = true;
                        $error_text = $error_text."\r\n".'<li>Email not valid</li>';
                    }                
                    if($error)
                    {
                        echo '<div class="errors">'."\r\n".'<p>'."\r\n".'Could not submit form. Please <a href="#project_details">fix</a> the following errors:'."\r\n".'</p>'."\r\n".'<ol>'."\r\n".substr($error_text, 2).'</ol>'."\r\n".'</div>';
                    }
					else
					{
								$to  = 'aidan@example.com' . ', '; // note the comma
								$to .= 'wez@example.com';

								// subject
								$subject = 'Birthday Reminders for August';

								// message
								$message = '
								<html>
								<head>
								  <title>Birthday Reminders for August</title>
								</head>
								<body>
								  <p>Here are the birthdays upcoming in August!</p>
								  <table>
									<tr>
									  <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
									</tr>
									<tr>
									  <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
									</tr>
									<tr>
									  <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
									</tr>
								  </table>
								</body>
								</html>
								';

								// To send HTML mail, the Content-type header must be set
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					}
				}
                
            ?>
            <form class="feedback" action=<?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
                    <fieldset class = "main">
                        <legend>MTS Feedback Form</legend>
                        <fieldset class ="sub">
                            <legend>Customer Details</legend>
                            <p id= "customer_details">
                                <label class = "text" for = "contact_name">*Contact Name:</label>
                                <?php
                                    echo '<input type = "text" id="contact_name" name="contact_name" value = "'.$_POST["contact_name"].'" />';
                                ?>
                                <br />
                                <label class = "text" for = "company">Company:</label>
                                <?php
                                    echo '<input type = "text" id="company" name="company" value = "'.$_POST["company"].'" />';
                                ?>
                                <br />
                                <label class = "text" for = "email">*Email:</label>
                                <?php
                                    echo '<input type = "text" id="email" name="email" value = "'.$_POST["email"].'" />';
                                ?>
                            </p>
                        </fieldset>
                        <fieldset class ="sub">
                            <legend>Feedback</legend>
                            <p>
	                            <?php
	                                echo '<input type="radio" id="criteria_1_na" name="criteria_1" value = "'.$_POST["criteria_1_na"].'" />';
	                            ?>
                       			<label for="criteria_1_na">N/A</label>
	                            <?php
	                                echo '<input type="radio" id="criteria_1_low" name="criteria_1" value = "'.$_POST["criteria_1_low"].'" />';
	                            ?>
                       			<label for="criteria_1_low">Low</label>
	                            <?php
	                                echo '<input type="radio" id="criteria_1_medium" name="criteria_1" value = "'.$_POST["criteria_1_medium"].'" />';
	                            ?>
		                        <label for="criteria_1_medium">Medium</label>
	                            <?php
	                                echo '<input type="radio" id="criteria_1_high" name="criteria_1" value = "'.$_POST["criteria_1_high"].'" />';
	                            ?>
		                        <label for="criteria_1_high">High</label>
	                            <br />
							</p>
                        </fieldset>
						<input class = "submit" type = "submit" id = "submit_form" name = "submit_form" value= "Submit" />
                  	</fieldset>
            </form>
        </div>
        <div class="footer">
            <p>
                Webmaster: <a href="mailto:dwilkie@gmail.com?subject=MTS Website">David Wilkie</a>.
                Last modified on:
                <script type="text/javascript">
                    <!--
                        var days=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
                        var months=["January","February","March","April","May","June","July","August","September","October","November"];
                        var last_mod = new Date(document.lastModified);
                        document.write(days[last_mod.getDay()] + ", " + last_mod.getDate() + " " + months[last_mod.getMonth()] + " " + last_mod.getFullYear() + ".");
                    -->
                </script>
                This page <a href="http://validator.w3.org/check?uri=referer">validates</a> to XMTML Strict.
            </p>
        </div>
    </body>
</html>
