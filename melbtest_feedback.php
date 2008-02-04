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
    Version 0.3; 2008-02-02 Initialised all variables and simplyfied code for displaying criteria into a loop

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
                
                if (isset($_POST['submit_form']))
                {
                  if ($_POST['submit_form'])
                  {
                      $error = false;
                      $error_text = "";

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
                                if (isset($_POST["contact_name"]))
                                {
                                  echo '<input type = "text" id="contact_name" name="contact_name" value = "'.$_POST["contact_name"].'" />';
                                }
                                else
                                {
                                  echo '<input type = "text" id="contact_name" name="contact_name" />';
                                }
                            ?>
                            <br />
                            <label class = "text" for = "company">Company:</label>
                            <?php
                                if (isset($_POST["company"]))
                                {
                                  echo '<input type = "text" id="company" name="company" value = "'.$_POST["company"].'" />';
                                }
                                else
                                {
                                  echo '<input type = "text" id="company" name="company" />';
                                }
                            ?>
                            <br />
                            <label class = "text" for = "email">*Email:</label>
                            <?php
                                if (isset($_POST["email"]))
                                {
                                  echo '<input type = "text" id="email" name="email" value = "'.$_POST["email"].'" />';
                                }
                                else
                                {
                                  echo '<input type = "text" id="email" name="email" />';
                                }
                            ?>
                        </p>
                    </fieldset>
                    <fieldset class ="sub">
                        <legend>Feedback</legend>
                        <!--Friendlieness of staff (criteria_1) -->
                        <p class = "feedback_criteria">
                        <?php
                              $criterion_nr = 0;
                              
                              $criteria[0] = "Friendiness of staff";
                              $criteria[1] = "Appropriate knowledge of staff on initial enquiry";
                              $criteria[2] = "Efficient handling of testing request";
                              $criteria[3] = "Professionalism";
                              $criteria[4] = "Efficiency of turnaround time";
                              $criteria[5] = "Reporting";
                              $criteria[6] = "Appropriate explanation of test results";
                              $criteria[7] = "After testing communication";
                              
                              $ratings[0] = "N/A";
                              $ratings[1] = "Low";
                              $ratings[2] = "Medium";
                              $ratings[3] = "High";
                              
                              foreach ($criteria as $criterion)
                              {
                                echo $criterion.':<br />';
                                
                                $rating_nr = 0;

                                foreach ($ratings as $rating)
                                {
                                  if (isset($_POST["criteria_".$criterion_nr]))
                                  {
                                    if ($_POST["criteria_".$criterion_nr]==$rating_nr)
                                    {
                                      // it was selected so select it again (so the user doesn't lose there selection)
                                      echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" checked = "true" />';
                                    }
                                    else
                                    {
                                      // it wasnt selected so leave it unchecked
                                      echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" />';
                                    }
                                  }
                                  else
                                  {
                                    echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" />';
                                  }
                                  echo '<label class = "button" for="criteria_'.$criterion_nr.'_'.$rating_nr.'">'.$rating.'</label>';
                                  $rating_nr += 1;
                                }
                                echo '<br /><br />';
                                $criterion_nr += 1;
                              }
                            ?>
                            <!--Other comments -->
                            <p class = "feedback_criteria">
                                Other comments: <br />
                                <?php
                                  if(isset($_POST["other_comments"]))
                                  {
                                    echo '<textarea id="other_comments" name="other_comments" rows="10" cols="70" >'.$_POST["other_comments"].'</textarea>';
                                  }
                                  else
                                  {
                                    echo '<textarea id="other_comments" name="other_comments" rows="10" cols="70" ></textarea>';
                                  }
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
