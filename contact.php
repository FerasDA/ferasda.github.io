<?php

// Set email variables
$email_to = 'deiratany.1@osu.edu';
$email_subject = 'From deiratany.me contact form';

// Set required fields
$required_fields = array('fullname','email','message');

// set error messages
$error_messages = array(
  'fullname' => 'Please enter a Name to proceed.',
  'email' => 'Please enter a valid Email Address to continue.',
  'message' => 'Please enter your Message to continue.'
);

// Set form status
$form_complete = FALSE;

// configure validation array
$validation = array();

// check form submittal
if(!empty($_POST)) {
  // Sanitise POST array
  foreach($_POST as $key => $value) $_POST[$key] = remove_email_injection(trim($value));
  
  // Loop into required fields and make sure they match our needs
  foreach($required_fields as $field) {   
    // the field has been submitted?
    if(!array_key_exists($field, $_POST)) array_push($validation, $field);
    
    // check there is information in the field?
    if($_POST[$field] == '') array_push($validation, $field);
    
    // validate the email address supplied
    if($field == 'email') if(!validate_email_address($_POST[$field])) array_push($validation, $field);
  }
  
  // basic validation result
  if(count($validation) == 0) {
    // Prepare our content string
    $email_content = 'New Website Comment: ' . "\n\n";
    
    // simple email content
    foreach($_POST as $key => $value) {
      if($key != 'submit') $email_content .= $key . ': ' . $value . "\n";
    }
    
    // if validation passed ok then send the email
    mail($email_to, $email_subject, $email_content);
    
    // Update form switch
    $form_complete = TRUE;
  }
}

function validate_email_address($email = FALSE) {
  return (preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', $email))? TRUE : FALSE;
}

function remove_email_injection($field = FALSE) {
   return (str_ireplace(array("\r", "\n", "%0a", "%0d", "Content-Type:", "bcc:","to:","cc:"), '', $field));
}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!--[if lt IE 7]><html class="no-js ie ie6 lt-ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 7]>   <html class="no-js ie ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>   <html class="no-js ie ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>   <html class="no-js ie ie9 lt-ie10"><![endif]-->
<!--[if gt IE 9]><html class="no-js ie ie10"><![endif]-->
<!--[if !IE]><!-->
<html class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Feras Deiratany</title>
    <!-- Modernizr -->
    <script src="js/libs/modernizr-2.6.2.min.js"></script>
    <!-- jQuery-->
    <script type="text/javascript" src="js/libs/jquery-1.10.2.min.js"></script>
    <!-- framework css --><!--[if gt IE 9]><!-->
    <link type="text/css" rel="stylesheet" href="css/groundwork.css"><!--<![endif]-->
    <!--[if lte IE 9]>
  <link type="text/css" rel="stylesheet" href="/css/groundwork-core.css">
  <link type="text/css" rel="stylesheet" href="/css/groundwork-type.css">
  <link type="text/css" rel="stylesheet" href="/css/groundwork-ui.css">
  <link type="text/css" rel="stylesheet" href="/css/groundwork-anim.css">
  <link type="text/css" rel="stylesheet" href="/css/groundwork-ie.css">
  <![endif]-->
    
    <style type="text/css">
      .logo {
        position: relative;
        top: 0.5em;
      }
      .logo a, .logo a:visited {
        text-decoration: none;
        color: #2B2B2D;
      }
      .logo img {
        height: 2em;
        position: relative;
        top: 0.55em;
        margin-right: 0.3em;
      }
      
    </style>
  </head>
 
  <body>
    <header class="padded">
      <div class="container">
        <div class="row">
          <div class="one half">
            <h2 class="logo"><a href="index.html" target="_parent">Feras Deiratany</a></h2>
          </div>
        </div>
        <nav role="navigation" class="nav gap-top">
          <ul role="menubar">
            <li><a href="index.html">Home</a></li>
            <li><a href="work.html">Work</a></li>
            <li><a href="projects.html">Projects</a></li>
            <li><a href="interests.html">Interests</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </nav>
      </div>
    </header>
  <hr>
    <div class="container">
      <div class="padded">
        <div class="row">
          <div class="bounceInRight animated">
            <h1>Contact Me</h1>
            <p>Please use the form below to send me an email:</p>
            <form action="contact.php" method="post" id="comments_form">
              <fieldset>
                <legend>Contact Form</legend>
                <div class="row">
                  <div class="one small-tablet fourth padded no-pad-bottom-mobile">
                    <label for="name">Your Name</label>
                  </div>
                  <div class="three small-tablet fourths padded no-pad-top-mobile">
                    <input id="fullname" name="fullname" type="text" placeholder="Your Name" value="">
                  </div>
                </div>
                <div class="row">
                  <div class="one small-tablet fourth padded no-pad-bottom-mobile">
                    <label for="email">Your Email</label>
                  </div>
                  <div class="three small-tablet fourths padded no-pad-top-mobile">
                    <input id="email" name="email" type="text" placeholder="you@example.com" value="">
                  </div>
                </div>
                <div class="row">
                  <div class="one whole pad-left pad-right pad-top">
                    <label for="message">Your Message</label>
                  </div>
                </div>
                <div class="row">
                  <div class="one whole pad-left pad-right pad-bottom">
                    <textarea id="message" name="message" placeholder="Write me a message here..."></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="one whole padded align-right">
                    <button type="submit" id="submit" class="asphalt">Send Message</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  <hr>    
    <footer class="gap-top bounceInUp animated">
      <div class="box square">
        <div class="container padded">
          <div class="row">
            <div class="one half padded">
              <p>Copyright © 2015 "deiratany.me".  All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- javascript-->
    <script type="text/javascript" src="js/groundwork.all.js"></script>
    <!-- google analytics-->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
      _gaq.push(['_trackPageview']);
      (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>
