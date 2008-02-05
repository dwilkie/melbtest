<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
  FILE: melbtest_feedback.php

  A feedback form which captures feedback and emails results

  Notes:
  This page validates to XHTML strict.

  Author:
  David Wilkie (dwilkie@gmail.com)

  Modified:
  Version 0.1; 2008-01-20 Document created. - DCW
  Version 0.2; 2008-01-31 Fixed validation of email and company, updated div and class tags for styling,  modified feedback form to remember choices on invalid submissions, integrated emailing of results,
                                             added comments, added all feedback criteria and added other comments text area. - DCW
  Version 0.3; 2008-02-02 Initialised all variables and simplyfied code for displaying criteria into a loop. - DCW
  Version 0.4; 2008-02-04 Modified criterion and rating numbers to make them more user readable, added comments to feedback form creation,
                                              added new-lines to php outputs for readability and started modifying email content. - DCW
  Version 0.5; 2008-02-05 Added validation to ensure all feedback criteria is rated, finished email content, moved all dynamic data into single php block, added validation for additional comments section,
                                              added validation for blank contact name and email, modified code to clear form fields on successful submission, added reset button, added include for navbar,
                                              modified error messages to contain internal links to fields, added footer to external ssi and included it in this document and added more comments to code. - DCW
  todo:
  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Melbourne Testing Services Feedback Form</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
      //add navbar
      include("navex.ssi"); 
    ?>
    <div class ="content">
      <h1>Melbourne Testing Services Feedback Form</h1>
      <!--start dynamic content-->
      <?php
        // criteria for feedback (add more here)
        $criteria[0] = "Friendiness of staff";
        $criteria[1] = "Appropriate knowledge of staff on initial enquiry";
        $criteria[2] = "Efficient handling of testing request";
        $criteria[3] = "Professionalism";
        $criteria[4] = "Efficiency of turnaround time";
        $criteria[5] = "Reporting";
        $criteria[6] = "Appropriate explanation of test results";
        $criteria[7] = "After testing communication";
        
        // rating choices for feedback (add more here)
        $ratings[0] = "N/A";
        $ratings[1] = "Low";
        $ratings[2] = "Medium";
        $ratings[3] = "High";
        
        //function for validating names (only accepts characters from A-Z)
        function validate_name($rString)
        {
          $mod_string = str_replace(' ', '', $rString);
          $pattern = "^[a-zA-Z]+$";
          return ereg($pattern, $mod_string);
        }
        
        //function for validating strings (does not allow angled brackets
        function validate_string($rString)
        {
          $mod_string = str_replace(' ', '', $rString);
          $pattern = "^[^<>]+$";
          return ereg($pattern, $mod_string);
        }        

        //function for validating email addresses
        function validate_email($rString)
        {
          $pattern = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$";
          return ereg($pattern, $rString);
        }

        //returns the text to display for an invalid name
        function valid_name_text()
        {
          return 'Can only contain letters from A-Z';
        }
        
        //returns the text to display for an invalid string
        function valid_string_text()
        {
          return 'Must not contain angle brackets (&lt; &gt;)';
        }        
        
        //check if submit button has been pressed by user
        if (isset($_POST['submit_form']))
        {
          if ($_POST['submit_form'])
          {
            //the user has submitted the form so validate all fields
            $error = false;
            $error_text = "";

            //validate contact name
            if (!empty($_POST['contact_name']))
            {            
              if (!validate_name($_POST['contact_name']))
              {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Contact name not valid - '.valid_name_text().'. <a href="#contact_name">Fix</a></li>';
              }
            }
            else
            {
              $error = true;
              $error_text = $error_text."\r\n".'<li>Contact name is blank. <a href="#contact_name">Complete</a></li>';
            }
            
            //validate the company
            if (!empty($_POST['company']))
            {
              if (!validate_name($_POST['company']))
              {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Company not valid - '.valid_name_text().'. <a href="#company">Fix</a></li>';
              }
            }
            
            //validate the email address
            if (!empty($_POST['email']))
            {
              if (!validate_email($_POST['email']))
              {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Email address is not valid. <a href="#email">Fix</a></li>';
              }
            }
            else
            {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Email address is blank. <a href="#email">Complete</a></li>';
            }
            
            //validate the comments
            if (!empty($_POST['other_comments']))
            {
              if (!validate_string($_POST['other_comments']))
              {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Comments contain invalid characters - '.valid_string_text().'. <a href="#other_comments">Fix</a></li>';
              }
            }

            //ensure that all feedback criteria is filled out
            $criterion_nr = 1;
            foreach ($criteria as $criterion)
            {
              if (!isset($_POST["criteria_".$criterion_nr]))
              {
                $error = true;
                $error_text = $error_text."\r\n".'<li>Feedback item #'.$criterion_nr.' ('.$criterion.') not completed. <a href="#criteria_'.$criterion_nr.'_1">Complete</a></li>';
              }
              $criterion_nr += 1;
            }
            
            if($error)
            {
              //there were problem(s) with the input so display the errors to the user
              echo '<div class="errors">'."\r\n".'<p>'."\r\n".'Could not submit form. Please fix the following errors:'."\r\n".'</p>'."\r\n".'<ol>'."\r\n".substr($error_text, 2).'</ol>'."\r\n".'</div>';
            }
            else
            {
              //no problems with the input so send the email
              echo '<p class="success">Successfully submitted form.</p>';

              // change email destination options here
              $feedback_destination = 'leannewilkie@melbtest.com.au';
              $recipient_first_name = 'Leanne';
              $recipient_surname = 'Wilkie';

              // subject
              $subject = 'Feedback from MTS website';

              // start of message
              $message = '
              <html>
                <head>
                  <title>Feedback from MTS website</title>
                </head>
                <body>
                  <p>
                    Hi '.$recipient_first_name.',<br /><br />
                    I have left feedback on your site. The details are as follows: <br /><br />';

                    // contact name
                    $message .= 'My name:&nbsp;'.$_POST['contact_name'].'<br />';
                    
                    if (!empty($_POST['company']))
                    {
                      //company (if entered)
                      $message .= 'Company:&nbsp;'.$_POST['company'].'<br />';
                    }
                    //email
                    $message .= 'My email:&nbsp;<a href="mailto:'.$_POST['email'].'?subject=RE: '.$subject.'">'.$_POST['email'].'</a><br /><br />';
                    
                    //feedback
                    $message .= '<strong>My feedback:</strong><br />';
                    
                    $criterion_nr = 1;
                    foreach ($criteria as $criterion)
                    {
                      $rating_index = $_POST["criteria_".$criterion_nr]-1;
                      $message .= '<em>'.$criterion_nr.'.&nbsp;'.$criterion.':</em>&nbsp;<strong>'.$ratings[$rating_index].'</strong><br />';
                      $criterion_nr += 1;
                    }
                    
                    //other comments
                    if (!empty($_POST['other_comments']))
                    {
                      $message .= '<br /><strong>Other comments:</strong><br />';
                      $message .= $_POST['other_comments'];
                    }
                    
                    //end of message
                    $message .= '
                    <br /><br />
                    Kind regards,<br /><br />'.$_POST['contact_name'].'
                  </p>
                </body>
              </html>
              ';

              // to send html mail, the content-type header must be set
              $headers  = 'MIME-Version: 1.0'."\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
              $headers .= 'To: '.$recipient_first_name.' '.$recipient_surname.' <'.$feedback_destination.'>'."\r\n";
              $headers .= 'From: '.$_POST['contact_name'].' <'.$_POST['email'].'>'."\r\n";

              mail($feedback_destination,$subject,$message,$headers);
            }
          }
        }
        //start form
        echo '<form class="feedback" action="'.$_SERVER['PHP_SELF'].'" method="post">'."\r\n";
          //form border
          echo '<fieldset class = "main">'."\r\n";
            //legend
            echo '<legend>MTS Feedback Form</legend>'."\r\n";

            //customer details section
            echo '<h2>Customer Details</h2>'."\r\n";
            echo '<p class= "customer_details">'."\r\n";
            
              //contact name
              echo '<label class = "text" for = "contact_name">*Contact Name:</label>'."\r\n";
              if (isset($_POST["contact_name"]) && $error)
              {
                echo '<input type = "text" id="contact_name" name="contact_name" value = "'.$_POST["contact_name"].'" />'."\r\n";
              }
              else
              {
                echo '<input type = "text" id="contact_name" name="contact_name" />'."\r\n";
              }
              echo '<br />'."\r\n";
              
              //company
              echo '<label class = "text" for = "company">Company:</label>'."\r\n";
              if (isset($_POST["company"]) && $error)
              {
                echo '<input type = "text" id="company" name="company" value = "'.$_POST["company"].'" />'."\r\n";
              }
              else
              {
                echo '<input type = "text" id="company" name="company" />'."\r\n";
              }
              echo '<br />'."\r\n";
              
              //email
              echo '<label class = "text" for = "email">*Email:</label>'."\r\n";
              if (isset($_POST["email"]) && $error)
              {
                echo '<input type = "text" id="email" name="email" value = "'.$_POST["email"].'" />'."\r\n";
              }
              else
              {
                echo '<input type = "text" id="email" name="email" />'."\r\n";
              }
            echo '</p>'."\r\n";
            
            //feedback section
            echo '<h2>Feedback</h2>'."\r\n";
            echo '<p class = "feedback_criteria">'."\r\n";

            $criterion_nr = 1;
            
            foreach ($criteria as $criterion)
            {
              // output a comment e.g. <!-- Criterion 1 (Friendliness of staff) -->
              echo '<!--Criterion '.$criterion_nr.' ('.$criterion.')-->'."\r\n";
              
              // output the actual criteria followed by a colon (:)
              echo $criterion_nr.'.&nbsp;'.$criterion.': <br />'."\r\n";
              
              $rating_nr = 1;

              foreach ($ratings as $rating)
              {
                // output a comment e.g. <!-- Rating 1 (N/A) -->
                echo '<!--Rating '.$rating_nr.' ('.$rating.')-->'."\r\n";
                
                // check if the current criteria has been already rated by the user
                if (isset($_POST["criteria_".$criterion_nr]) && $error)
                {
                  // this criteria has been already rated so check if the user selected the current rating
                  if ($_POST["criteria_".$criterion_nr]==$rating_nr)
                  {
                    // it was selected so select it again (so the user doesn't lose there selection)
                    echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" checked = "true" />'."\r\n";
                  }
                  else
                  {
                    // it wasnt selected so leave it unchecked
                    echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" />'."\r\n";
                  }
                }
                else
                {
                  // the user has not yet rated this criteria so leave it unchecked
                  echo '<input type="radio" id="criteria_'.$criterion_nr.'_'.$rating_nr.'" name="criteria_'.$criterion_nr.'" value = "'.$rating_nr.'" />'."\r\n";
                }
                
                // create the label for the rating
                echo '<label class = "button" for="criteria_'.$criterion_nr.'_'.$rating_nr.'">'.$rating.'</label>'."\r\n";
                $rating_nr += 1;
              }
              echo '<br /><br />'."\r\n";
              $criterion_nr += 1;
            }
            echo '</p>'."\r\n";
            
            //other comments
            echo '<!--other comments -->'."\r\n";
            echo '<p class = "feedback_criteria">'."\r\n";
              echo 'Other comments: <br />'."\r\n";
              if(isset($_POST["other_comments"]) && $error)
              {
                echo '<textarea id="other_comments" name="other_comments" rows="10" cols="70" >'.$_POST["other_comments"].'</textarea>'."\r\n";
              }
              else
              {
                echo '<textarea id="other_comments" name="other_comments" rows="10" cols="70" ></textarea>'."\r\n";
              }
            echo '</p>'."\r\n";
            //submit button
            echo '<p class = "feedback_criteria">'."\r\n";
              echo '<input type = "submit" id = "submit_form" name = "submit_form" value= "Submit" />'."\r\n";
              echo '<input type = "reset" id = "reset_form" name = "reset_form" value= "Reset" />'."\r\n";
            echo '</p>'."\r\n";
        echo '</fieldset>'."\r\n";
      echo '</form>'."\r\n";
    ?>
    <!-- end dynamic content-->
    </div>
    <!--footer section-->
    <?php
      //add footer
      include("footer.ssi"); 
    ?>
  </body>
</html>