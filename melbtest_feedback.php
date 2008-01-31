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
    Version 0.2; 2008-01-31 Fixed validation of email and company, updated div and class tags for styling,  modified feedback form to remember choices on invalid submissions, integrated emailing of results,
                                               added comments, added all feedback criteria and added other comments text area.

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
                    $pattern = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$";
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
                    if (!empty($_POST['company']))
                    {
                        if (!validate_name($_POST['company']))
                        {
                            $error = true;
                            $error_text = $error_text."\r\n".'<li>Company not valid - '.valid_name_text().'</li>';
                        }
                    }
                    if (!validate_email($_POST['email']))
                    {
                        $error = true;
                        $error_text = $error_text."\r\n".'<li>Email not valid</li>';
                    }
                    if($error)
                    {
                        echo '<div class="errors">'."\r\n".'<p>'."\r\n".'Could not submit form. Please fix the following errors:'."\r\n".'</p>'."\r\n".'<ol>'."\r\n".substr($error_text, 2).'</ol>'."\r\n".'</div>';
                    }
                    else
                    {
                        echo '<p class="success">Successfully submitted form.</p>';

                        $to  = 'dwilkie@gmail.com';

                        // subject
                        $subject = 'Feedback from MTS website';

                        // message
                        $message = '
                        <html>
                        <head>
                          <title>Feedback from MTS website</title>
                        </head>
                        <body>
                          <p>This is a test email</p>
                        </body>
                        </html>
                        ';

                        // To send HTML mail, the Content-type header must be set
                        $headers  = 'MIME-Version: 1.0'."\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                        mail($to,$subject,$message,$headers);
                    }
                }
            ?>
            <form class="feedback" action=<?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
                <fieldset class = "main">
                    <legend>MTS Feedback Form</legend>
                    <fieldset class ="sub">
                        <legend>Customer Details</legend>
                        <p class= "customer_details">
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
                        <!--Friendlieness of staff (criteria_1) -->
                        <p class = "feedback_criteria">
                            Friendiness of staff: <br />
                            <?php
                             // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_1"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_1_na" name="criteria_1" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_1_na" name="criteria_1" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_1_na">N/A</label>
                            <?php
                              if ($_POST["criteria_1"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_1_low" name="criteria_1" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_1_low" name="criteria_1" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_1_low">Low</label>
                            <?php
                              if ($_POST["criteria_1"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_1_medium" name="criteria_1" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_1_medium" name="criteria_1" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_1_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_1"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_1_high" name="criteria_1" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_1_high" name="criteria_1" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_1_high">High</label>
                        </p>
                        <!--Appropriate knowledge of staff on initial enquiry( criteria_2) -->
                        <p class = "feedback_criteria">
                            Appropriate knowledge of staff on initial enquiry: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_2"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_2_na" name="criteria_2" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_2_na" name="criteria_2" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_2_na">N/A</label>
                            <?php
                              if ($_POST["criteria_2"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_2_low" name="criteria_2" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_2_low" name="criteria_2" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_2_low">Low</label>
                            <?php
                              if ($_POST["criteria_2"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_2_medium" name="criteria_2" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_2_medium" name="criteria_2" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_2_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_2"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_2_high" name="criteria_2" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_2_high" name="criteria_2" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_2_high">High</label>
                        </p>
                        <!--Efficient handling of testing request (criteria_3) -->
                        <p class = "feedback_criteria">
                            Efficient handling of testing request: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_3"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_3_na" name="criteria_3" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_3_na" name="criteria_3" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_3_na">N/A</label>
                            <?php
                              if ($_POST["criteria_3"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_3_low" name="criteria_3" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_3_low" name="criteria_3" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_3_low">Low</label>
                            <?php
                              if ($_POST["criteria_3"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_3_medium" name="criteria_3" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_3_medium" name="criteria_3" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_3_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_3"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_3_high" name="criteria_3" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_3_high" name="criteria_3" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_3_high">High</label>
                        </p>
                        <!--Professionalism (criteria_4) -->
                        <p class = "feedback_criteria">
                            Professionalism: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_4"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_4_na" name="criteria_4" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_4_na" name="criteria_4" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_4_na">N/A</label>
                            <?php
                              if ($_POST["criteria_4"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_4_low" name="criteria_4" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_4_low" name="criteria_4" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_4_low">Low</label>
                            <?php
                              if ($_POST["criteria_4"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_4_medium" name="criteria_4" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_4_medium" name="criteria_4" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_4_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_4"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_4_high" name="criteria_4" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_4_high" name="criteria_4" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_4_high">High</label>
                        </p>
                        <!--Efficiency of turnaround time (criteria_5) -->
                        <p class = "feedback_criteria">
                            Efficiency of turnaround time: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_5"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_5_na" name="criteria_5" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_5_na" name="criteria_5" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_5_na">N/A</label>
                            <?php
                              if ($_POST["criteria_5"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_5_low" name="criteria_5" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_5_low" name="criteria_5" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_5_low">Low</label>
                            <?php
                              if ($_POST["criteria_5"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_5_medium" name="criteria_5" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_5_medium" name="criteria_5" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_5_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_5"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_5_high" name="criteria_5" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_5_high" name="criteria_5" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_5_high">High</label>
                        </p>
                        <!--Reporting (criteria_6) -->
                        <p class = "feedback_criteria">
                            Reporting: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_6"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_6_na" name="criteria_6" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_6_na" name="criteria_6" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_6_na">N/A</label>
                            <?php
                              if ($_POST["criteria_6"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_6_low" name="criteria_6" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_6_low" name="criteria_6" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_6_low">Low</label>
                            <?php
                              if ($_POST["criteria_6"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_6_medium" name="criteria_6" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_6_medium" name="criteria_6" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_6_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_6"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_6_high" name="criteria_6" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_6_high" name="criteria_6" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_6_high">High</label>
                        </p>
                        <!--Appropriate explanation of test results (criteria_7) -->
                        <p class = "feedback_criteria">
                            Appropriate explanation of test results: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_7"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_7_na" name="criteria_7" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_7_na" name="criteria_7" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_7_na">N/A</label>
                            <?php
                              if ($_POST["criteria_7"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_7_low" name="criteria_7" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_7_low" name="criteria_7" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_7_low">Low</label>
                            <?php
                              if ($_POST["criteria_7"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_7_medium" name="criteria_7" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_7_medium" name="criteria_7" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_7_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_7"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_7_high" name="criteria_7" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_7_high" name="criteria_7" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_7_high">High</label>
                        </p>
                        <!--After testing communication (criteria_8) -->
                        <p class = "feedback_criteria">
                            After testing communication: <br />
                            <?php
                              // Check which if this radio button was selected before the submit button was pressed
                              if ($_POST["criteria_8"]=="na")
                              {
                                  // it was selected so select it again (so the user doesn't lose there selection)
                                  echo '<input type="radio" id="criteria_8_na" name="criteria_8" value = "na" checked = "true" />';
                              }
                              else
                              {
                                  // it wasnt selected so leave it unchecked
                                  echo '<input type="radio" id="criteria_8_na" name="criteria_8" value = "na" />';
                              }
                            ?>
                            <label class = "button" for="criteria_8_na">N/A</label>
                            <?php
                              if ($_POST["criteria_8"]=="low")
                              {
                                  echo '<input type="radio" id="criteria_8_low" name="criteria_8" value = "low" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_8_low" name="criteria_8" value = "low" />';
                              }
                            ?>
                            <label class = "button" for="criteria_8_low">Low</label>
                            <?php
                              if ($_POST["criteria_8"]=="medium")
                              {
                                  echo '<input type="radio" id="criteria_8_medium" name="criteria_8" value = "medium" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_8_medium" name="criteria_8" value = "medium" />';
                              }
                            ?>
                            <label class = "button" for="criteria_8_medium">Medium</label>
                            <?php
                              if ($_POST["criteria_8"]=="high")
                              {
                                  echo '<input type="radio" id="criteria_8_high" name="criteria_8" value = "high" checked = "true" />';
                              }
                              else
                              {
                                  echo '<input type="radio" id="criteria_8_high" name="criteria_8" value = "high" />';
                              }
                            ?>
                            <label class = "button" for="criteria_8_high">High</label>
                        </p>
                        <!--Other comments -->
                        <p class = "feedback_criteria">
                            Other comments: <br />
                            <?php
                                echo '<textarea id="other_comments" name="other_comments" rows="10" cols="70" >'.$_POST["other_comments"].'</textarea>';
                            ?>
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
