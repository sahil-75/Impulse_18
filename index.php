<!--Developed by SAHIL G. KALYANI-->

<?php

define ('SITE_ROOT', realpath(dirname(__FILE__)));

$fullname = $stream = $year = $college = $email = $phone = $pic = "";
$voice = $dance = $ramp = $drama = $jam = "0"; $events="1";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST["fullname"]))
    {
        function validateFormData($formdata)
        {
            $formdata = trim(stripcslashes(htmlspecialchars($formdata)));
            return $formdata;
        }

        $fullname = strtoupper(validateFormData($_POST["fullname"]));
        $stream = validateFormData($_POST["stream"]);
        $year = validateFormData($_POST["year"]);
        $college = strtoupper(validateFormData($_POST["college"]));
        $email = validateFormData($_POST["email"]);
        $phone = validateFormData($_POST["phone"]);

        if(isset($_POST["voice"]))
            $voice = "1";

        if(isset($_POST["dance"]))
            $dance = "1";

        if(isset($_POST["ramp"]))
            $ramp = "1";

        if(isset($_POST["drama"]))
            $drama = "1";

        if(isset($_POST["jam"]))
            $jam = "1";

        if(!isset($_POST["voice"]) && !isset($_POST["dance"]) && !isset($_POST["ramp"]) && !isset($_POST["drama"]) && !isset($_POST["jam"]))
        {
            $events = 0;
        }

        if($fullname && $stream && $year && $college && $email && $phone && $events)
        {
            //Connect to database

            //FOR WAMP SERVER
            $server     = "localhost";
            $username   = "root";
            $password   = "";
            $db         = "my_first_database";

            $conn = mysqli_connect($server, $username, $password, $db);

            if(!$conn)
            {
                die("Connection failed: ". mysqli_connect_error()."<br>");
            }

            $query1 = "SELECT * FROM users WHERE email='$email'";
            $result1 = mysqli_query($conn, $query1);

            $query2 = "SELECT * FROM users WHERE phone='$phone'";
            $result2 = mysqli_query($conn, $query2);

            if(mysqli_num_rows($result1)>0)
            {
                $message = "Email or phone number has already been used. To edit the details, contact the Website Administrator";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            elseif(mysqli_num_rows($result2)>0)
            {
                $message = "Email or phone number has already been used. To edit the details, contact the Website Administrator";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else
            {
                //Create SQL query
                $query = "INSERT INTO `users` (`fullname`, `email`, `phone`, `stream`, `year`, `college`, `voice`, `dance`, `ramp`, `drama`, `jam`)
                VALUES ('$fullname', '$email', '$phone', '$stream', '$year', '$college', '$voice', '$dance', '$ramp', '$drama', '$jam')";

                if(mysqli_query($conn,$query))
                {
                    $message = "Registered Successfully!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                elseif(mysqli_error($conn))
                {
                    $message = "Fatal Error. Please try again!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }

            mysqli_close($conn);
        }
    }
    else if(isset($_POST["f_fullname"]))
    {
        function validateFormData($formdata)
        {
            $formdata = trim(stripcslashes(htmlspecialchars($formdata)));
            return $formdata;
        }

        $fullname = strtoupper(validateFormData($_POST["f_fullname"]));
        $stream = validateFormData($_POST["f_stream"]);
        $year = validateFormData($_POST["f_year"]);
        $college = strtoupper(validateFormData($_POST["f_college"]));
        $email = validateFormData($_POST["f_email"]);
        $phone = validateFormData($_POST["f_phone"]);
        
        $picTmpName = $_FILES["f_pic"]['tmp_name'];
        $picExt = explode('.',$_FILES["f_pic"]['name']);
        $picActualExt = strtolower(end($picExt));
        $picNewName = $fullname.".".$picActualExt;
        $picDestination = "C:/wamp64/www/PHP_Projects/Impulse_18/uploads/".$picNewName;
        
        $destination_path = getcwd().DIRECTORY_SEPARATOR."uploads/".basename($picNewName);
        @move_uploaded_file($_FILES['f_pic']['tmp_name'], $destination_path);
        
        if($fullname && $stream && $year && $college && $email && $phone && $events)
        {
            //Connect to database

            //FOR WAMP SERVER
            $server     = "localhost";
            $username   = "root";
            $password   = "";
            $db         = "my_first_database";

            $conn = mysqli_connect($server, $username, $password, $db);

            if(!$conn)
            {
                die("Connection failed: ". mysqli_connect_error()."<br>");
            }

            $query1 = "SELECT * FROM facepulse WHERE email='$email'";
            $result1 = mysqli_query($conn, $query1);

            $query2 = "SELECT * FROM facepulse WHERE phone='$phone'";
            $result2 = mysqli_query($conn, $query2);
            
            if(mysqli_num_rows($result1)>0)
            {
                $message = "Email or phone number has already been used. To edit the details, contact the Website Administrator";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else if(mysqli_num_rows($result2)>0)
            {
                $message = "Email or phone number has already been used. To edit the details, contact the Website Administrator";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else
            {
                //Create SQL query
                $query = "INSERT INTO `facepulse` (`fullname`, `email`, `phone`, `stream`, `year`, `college`)
                VALUES ('$fullname', '$email', '$phone', '$stream', '$year', '$college')";

                if(mysqli_query($conn,$query))
                {
                    $message = "Registered Successfully!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                elseif(mysqli_error($conn))
                {
                    $message = "Fatal Error. Please try again!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }

            mysqli_close($conn);
        }
    }
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Official Website of Impulse '18">
    <meta name="author" content="Sahil Kalyani">
  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/slider.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bad+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nova+Flat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        *
        {
            color: white;
        }
        body
        {
            background: #8e3cfe !important;
        }
    </style>
      
    <title>Impulse '18</title>
  </head>

  <body onload="hideloader()">
    
    <div id="loader" style="background: #111">
      <h4 style="padding-top: 40px; font-size: 2.5em;"><strong>IMPULSE '18</strong></h4>
      <div class="row" style="padding-top: 80px;">
        <div class="col-md-5 col-xs-2"></div>
        <div class="col-md-2 col-xs-8">
          <div id="circle">
            <img src="img/bgimg.png" width="100%" style="background-radius: 100px" id="circle_img">
          </div>
        </div>
      </div>
      
      <h4 style="padding-top: 60px; font-size: 2em;">Loading... Please Wait!</h4>
      <h4 style="padding-top: 40px; font-size: 1.5em;">BEST VIEWED IN GOOGLE CHROME</h4>
      <h4 style="padding-top: 5px; font-size: 1.5em;">USE HEADPHONES FOR AN IMMERSIVE EXPERIENCE</h4>
    </div>

    <style type="text/css">
      body
      {
        background: black;
      }

      #loader h3,h4
      {
        font-family: 'Dosis', sans-serif;
        font-weight: 100;
      }

      #circle
      {
        border-radius: 50%;
        /*border: solid 10px;
        border-color: #3c3b3b;
        border-bottom-color: white;
        transition: all 0s ease;

        -webkit-animation: spin linear infinite 1s;
        -moz-animation: spin linear infinite 1s;
        -o-animation: spin linear infinite 1s;
        animation: spin linear infinite 1s;*/
      }

      #circle_img
      {
        /*-webkit-transition: none;
        -moz-transition: none;
        -o-transition: none;
        -ms-transition: none;
        transition: none;*/
        
        -webkit-animation: zoom linear infinite 2s;
        -moz-animation: zoom linear infinite 2s;
        -o-animation: zoom linear infinite 2s;
        animation: zoom linear infinite 2s;
      }

      @keyframes spin
      {
        0%
        {
          border-color: #3c3b3b;
          border-bottom-color: white;
        }

        25%
        {
          border-color: #3c3b3b;
          border-left-color: white;
        }
        
        50%
        {
          border-color: #3c3b3b;
          border-top-color: white;
        }

        75%
        {
          border-color: #3c3b3b;
          border-right-color: white;
        }
      }
      
      @keyframes zoom
      {
        0%
        {
          transform: scale(1);
        }

        25%
        {
          transform: scale(1.2);
        }
        
        50%
        {
          transform: scale(1.3);
        }

        75%
        {
          transform: scale(1.2);
        }

        100%
        {
          transform: scale(1);
        }
      }
      
      a[aria-expanded="true"]
      {
         background: #2ECC71 !important;
         color: white !important;
      }
      a
      {
         text-decoration: none;
         color: white;
      }
      input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button,
      input[type=date]::-webkit-inner-spin-button, 
      input[type=date]::-webkit-outer-spin-button
      { 
         -webkit-appearance: none; 
         margin: 0; 
      }
        
      .glyphicon
      {
         color: #444 !important;    
      }
    </style>

    <div id="rest" style="visibility: hidden; transition: all 1s ease; overflow-x: hidden;">
    
      <nav class="navbar navbar-inverse navbar-fixed-top myheader" id="header" style="background: #201D23 !important; color: white; box-shadow: 0 0 35px -8px #000; border: none; transition: all 0.7s ease; top: -70px; border-bottom: solid 3px #8e3cfe;">
        <div class="container-fluid" style="padding: 10px 5% 10px 10%;">
          <div class="navbar-header">
          	<a class="navbar-brand page-scroll" id="ttl" href="#section1">Impulse '18</a>
	        
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
          </div>

          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="page-scroll" href="#section2">About</a></li>
              <li><a class="page-scroll" href="#section4">Events</a></li>
              <li><a class="page-scroll" href="#section6">Gallery</a></li>
              <li><a class="page-scroll" href="#section8">Sponsors</a></li>
              <li><a class="page-scroll" href="#section10">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container" id="section1" style="padding-left: 0; padding-right: 0; height: 100vh">
        <div style="margin:0; width:100%; height:100%;">
          <div class="row" style="padding-top: 40px;">
            <div class="col-md-1 col-sm-2"></div>
            <div class="col-md-10 col-sm-8">
              <h1 style="font-family: 'nova flat'; font-size: 3em; text-shadow: 2px 2px 20px black;">BENGAL INSTITUTE OF TECHNOLOGY</h1><br>
              <h3 style="font-family: 'nova flat'; font-size: 1.8em">PRESENTS</h3><br>
              <h1 style="cursor: pointer; margin-top:0;"><img src="img/bgimg.png" width="35%"></h1>
            </div>
          </div>
        </div>
        <div class="mouse">
          <div class="scroller"></div>
        </div>
      </div>

      <div id="section2" class="container">
        <h1>About Impulse</h1><hr>
        
        <div class="row">
          <div class="col-md-1 col-sm-0"></div>
          <div class="col-md-10 col-sm-12">
            <p>Bengal Institute of Technology,a unit of Techno India Group is privileged to present before you one of the oldest cultural festival in Kolkata, Impulse. Our cutural fest has been engraving its name as one of the most participated and successful cultural fiesta since a long time. Impulse is one of the most exquisite and highly appreciated cultural festivals in Kolkata. Every coming year is seeing the development of our cultural fiesta and each year it is emerging out with huge success, with large number of participating colleges from different parts of the city. We come up with endearing, innovative and enriching events every year which students from all over Kolkata participate and attend.</p>
          </div>
        </div>
      </div>

      <div id="section3"></div>

      <div class="container" id="section4">
        <h1>Events</h1><hr>
        <div class="row" id="main">
          <div class="col-md-4 col-sm-6 cl" onclick="alert('Registrations Closed')">
            <img src="img/p1.jpg">
            <h2>Voice of Impulse</h2>
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="alert('Registrations Closed')">
            <img src="img/p2.jpg">
            <h2>Dance Competition</h2>
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="alert('Registrations Closed')">
            <img src="img/p3.jpg">
            <h2>Ramp on Fire</h2>
          </div>

          <div class="col-md-offset-2 col-md-4 col-sm-6 cl" onclick="alert('Registrations Closed')">
            <img src="img/p4.jpg">
            <h2>Drama</h2>
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="alert('Registrations Closed')">
            <img src="img/p6.jpg">
            <h2>FacePulse</h2>
          </div>
        </div>
        
        <h1>Guest Artists</h1><hr>
        <div class="row" style="margin: 0; height: 300px">
          <div class="col-md-3 col-sm-12" onclick="fun2('img/gallery/a1.jpg')">
            <img src="img/gallery/a1.jpg" style="width: 100%; height: 100%; cursor: pointer">
            <h2>Akanksha Sharma</h2>
          </div>

          <div class="col-md-6 col-sm-12" onclick="fun2('img/gallery/a2.jpg')">
            <img src="img/gallery/a2.jpg" style="width: 100%; height: 100%; cursor: pointer">
            <h2>The Radical Array Project</h2>
          </div>

          <div class="col-md-3 col-sm-12" onclick="fun2('img/gallery/a3.jpg')">
            <img src="img/gallery/a3.jpg" style="width: 100%; height: 100%; cursor: pointer">
            <h2>Ujjan - The Band</h2>
          </div>
        </div>
        
        <div class="row" style="margin-top: 70px">
          <div class="col-md-4 col-sm-1"></div>
          <div class="col-md-4 col-sm-10">
            <img src="img/eventmas.jpg" style="width: 100%">
            <h2>Event Managed by Eventmas</h2>
          </div>
          <div class="col-md-4 col-sm-1"></div>
        </div>
      </div>

      <div id="section5"></div>

      <div class="container" id="section6">
        <h1>Gallery</h1><hr>
        <h2 style="margin: 25px auto; padding: 0">Some moments from the previous edition of Impulse</h2>
        <div class="row" style="margin: 0">
          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/15.jpg')">
            <img src="img/gallery/15.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/7.jpg')">
            <img src="img/gallery/7.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/11.jpg')">
            <img src="img/gallery/11.jpg">
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/17.jpg')">
            <img src="img/gallery/17.jpg">
          </div>
          
          
          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/1.jpg')">
            <img src="img/gallery/1.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/8.jpg')">
            <img src="img/gallery/8.jpg">
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/13.jpg')">
            <img src="img/gallery/13.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/6.jpg')">
            <img src="img/gallery/6.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/5.jpg')">
            <img src="img/gallery/5.jpg">
          </div>
          
          
          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/14.jpg')">
            <img src="img/gallery/14.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/10.jpg')">
            <img src="img/gallery/10.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/9.jpg')">
            <img src="img/gallery/9.jpg">
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/18.jpg')">
            <img src="img/gallery/18.jpg">
          </div>
          
          
          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/4.jpg')">
            <img src="img/gallery/4.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/12.jpg')">
            <img src="img/gallery/12.jpg">
          </div>

          <div class="col-md-4 col-sm-6 cl" onclick="fun2('img/gallery/16.jpg')">
            <img src="img/gallery/16.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/3.jpg')">
            <img src="img/gallery/3.jpg">
          </div>

          <div class="col-md-2 col-sm-4 cl" onclick="fun2('img/gallery/2.jpg')">
            <img src="img/gallery/2.jpg">
          </div>
        </div>
      </div>
      
      <div id="section7"></div>

      <div id="section8" class="container">
        <h1>Sponsors</h1><hr style="width: 50%;">
        <div class="container">
          <div class="customer-logos slider" style="padding: 20px 0">
            <div class="slide"><img src="img/sponsors/sp1.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp2.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp3.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp4.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp5.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp6.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp7.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp8.jpg"></div>
            <div class="slide"><img src="img/sponsors/sp9.jpg"></div>
          </div>
        </div><br><br>

        <a href="BIT_Impulse'18_Brochure.pdf" target="_blank" style="text-decoration: none"><h3 id="brochure">Download the official Impulse '18 brochure</h3></a>
      </div>

      <div id="section9"></div>

      <div id="section10" class="container">
        <h1>Contact Us</h1><hr>
        
        <div class="row" style="margin: 1% -10%">
          <div class="col-md-2 col-md-offset-1 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">General Secretary</h2>
            <img src="img/cont/1.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Indranuj Roy</h2>
            <h2 style="font-size: 1.5em">9903704190</h2>
          </div>
          
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Ast. General Secretary</h2>
            <img src="img/cont/4.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Swapnil Sharma</h2>
            <h2 style="font-size: 1.5em">9038811656</h2>
          </div>
          
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Ast. General Secretary</h2>
            <img src="img/cont/5.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Sourish Dutta</h2>
            <h2 style="font-size: 1.5em">7278226460</h2>
          </div>
        
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Ast. General Secretary</h2>
            <img src="img/cont/6.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Gaurav Seal</h2>
            <h2 style="font-size: 1.5em">7980929903</h2>
          </div>
            
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Ast. General Secretary</h2>
            <img src="img/cont/7.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Bhushan Yadav</h2>
            <h2 style="font-size: 1.5em">7544838864</h2>
          </div>
        </div><br>
        
        <div class="row" style="margin: 1% -10%">
          <div class="col-md-2 col-md-offset-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Cultural Secretary</h2>
            <img src="img/cont/2.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Avirup Nanda</h2>
            <h2 style="font-size: 1.5em">9475892024</h2>
          </div>
          
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Event Supervisor</h2>
            <img src="img/cont/3.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Swati Jha</h2>
            <h2 style="font-size: 1.5em">9038557521</h2>
          </div>
            
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Digital Head</h2>
            <img src="img/cont/gd.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Shubhajit Chatterjee</h2>
            <h2 style="font-size: 1.5em">9564088979</h2>
          </div>
            
          <div class="col-md-2 crd" style="position: relative;">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Web Developer</h2>
            <img src="img/cont/wd.jpg" style="width:100%; border-radius:100%">
            <h2 style="font-size: 1.7em">Sahil Kalyani</h2>
            <h2 style="font-size: 1.5em">8902257840</h2>
          </div>
        </div><br>
        
        <!--<div class="row" style="margin: 2% 10%">
          <div class="col-md-4 crd" style="position: relative; text-align: center">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">General Secretary</h2>
            <img src="img/ags.png" style="width:80%; border-radius:100%">
            <h2 style="font-size: 1.7em">Indranuj Roy</h2>
            <h2 style="font-size: 1.5em">123456789</h2>
          </div>
          
          <div class="col-md-4 crd" style="position: relative; text-align: center">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Web Developer</h2>
            <img src="img/ags.png" style="width:80%; border-radius:100%">
            <h2 style="font-size: 1.7em">Sahil Kalyani</h2>
            <h2 style="font-size: 1.5em">123456789</h2>
          </div>
            
          <div class="col-md-4 crd" style="position: relative; text-align: center">
            <h2 style="font-size: 1.7em; margin-bottom: 10px">Graphic Designer</h2>
            <img src="img/ags.png" style="width:80%; border-radius:100%">
            <h2 style="font-size: 1.7em">Shubhajit Chatterjee</h2>
            <h2 style="font-size: 1.5em">123456789</h2>
          </div>
        </div>
        
        <!--<div class="row" style="margin: 2% 10%">
          <div class="col-md-4" style="position: relative;">
            <div class="ch">
              <img class="icard" id="icard2" src="img/gs.png">
              <div class="tcard" id="tcard2">
                <h4 style="font-family: arial; font-weight: bold;">Indranuj Roy</h4>
                <h4 style="font-family: arial; font-weight: 100;">General Secretary</h4><hr style="width: 90%; margin: 10px 5%; padding: 0">
                <div style="width: 30px; margin: 0 auto">
                  <a href=""><i class="fa fa-facebook-official" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-instagram" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-twitter" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-linkedin-square" style="font-size:28px; margin: 5px 0;"></i></a>
                </div>
              </div>
            </div>
          </div>
            
          <div class="col-md-4" style="position: relative;">
            <div class="ch">
              <img class="icard" id="icard2" src="img/wd.png">
              <div class="tcard" id="tcard2">
                <h4 style="font-family: arial; font-weight: bold;">Sahil Kalyani</h4>
                <h4 style="font-family: arial; font-weight: 100;">Web Developer</h4><hr style="width: 90%; margin: 10px 5%; padding: 0">
                <div style="width: 30px; margin: 0 auto">
                  <a href=""><i class="fa fa-facebook-official" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-instagram" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-twitter" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-linkedin-square" style="font-size:28px; margin: 5px 0;"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-4" style="position: relative;">
            <div class="ch">
              <img class="icard" id="icard2" src="img/gd.png">
              <div class="tcard" id="tcard2">
                <h4 style="font-family: arial; font-weight: bold;">Shubhajit Chatterjee</h4>
                <h4 style="font-family: arial; font-weight: 100;">Graphic Designer</h4><hr style="width: 90%; margin: 10px 5%; padding: 0">
                <div style="width: 30px; margin: 0 auto">
                  <a href=""><i class="fa fa-facebook-official" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-instagram" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-twitter" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-linkedin-square" style="font-size:28px; margin: 5px 0;"></i></a>
                </div>
              </div>
            </div>
          </div>

          <!--<div class="col-md-2 col-sm-6" style="position: relative;">
            <div class="ch">
              <img class="icard" id="icard3" src="img/ags.png">
              <div class="tcard" id="tcard3">
                <h4 style="font-family: arial; font-weight: bold;">*name-3*</h4>
                <h4 style="font-family: arial; font-weight: 100;">A.G.S.</h4><hr style="width: 90%; margin: 10px 5%; padding: 0">
                <div style="width: 30px; margin: 0 auto">
                  <a href=""><i class="fa fa-facebook-official" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-instagram" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-twitter" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-linkedin-square" style="font-size:28px; margin: 5px 0;"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-2 col-sm-6" style="position: relative;">
            <div class="ch">
              <img class="icard" id="icard4" src="img/ags.png">
              <div class="tcard" id="tcard4">
                <h4 style="font-family: arial; font-weight: bold;">*name-4*</h4>
                <h4 style="font-family: arial; font-weight: 100;">A.G.S.</h4><hr style="width: 90%; margin: 10px 5%; padding: 0">
                <div style="width: 30px; margin: 0 auto">
                  <a href=""><i class="fa fa-facebook-official" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-instagram" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-twitter" style="font-size:28px; margin: 5px 0;"></i></a>
                  <a href=""><i class="fa fa-linkedin-square" style="font-size:28px; margin: 5px 0;"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>-->

        <div class="row">
          <div class="col-md-12" style="padding-top: 20px">
            <!--<div class="map-container">
              <a href="https://www.google.co.in/maps/place/Nazrul+Mancha/@22.5131988,88.3626011,15z/data=!4m5!3m4!1s0x0:0x8cfff1e8bddb6ff!8m2!3d22.5131988!4d88.3626011" target="_blank">
              </a>
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14743.038642806176!2d88.3626011!3d22.5131988!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8cfff1e8bddb6ff!2sNazrul+Mancha!5e0!3m2!1sen!2sin!4v1506973408525" width="100%" height="450px" frameborder="0" style="border:1px" style="opacity:0.5; background:transparent; margin-top:2%; margin-bottom:1.5%;" allowfullscreen></iframe>
            </div>-->
            <div class="map-container">
              <a href="https://www.google.co.in/maps/place/Mohit+Moitra+Mancha/@22.6122615,88.3128776,12z/data=!4m18!1m12!4m11!1m3!2m2!1d88.3818855!2d22.6173323!1m6!1m2!1s0x39f89d8a3c6dbb33:0xeed3d73a4d58aeb6!2smohit+mancha+kolkata!2m2!1d88.382918!2d22.6122767!3m4!1s0x39f89d8a3c6dbb33:0xeed3d73a4d58aeb6!8m2!3d22.6122767!4d88.382918" target="_blank">
              </a>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117859.61050822504!2d88.31287760546502!3d22.61226150520058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89d8a3c6dbb33%3A0xeed3d73a4d58aeb6!2sMohit+Moitra+Mancha!5e0!3m2!1sen!2sin!4v1516517685442" width="100%" height="450px" frameborder="0" style="border:1px" style="opacity:0.5; background:transparent; margin-top:2%; margin-bottom:1.5%;" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>

      <div id="footer">
        <h3 style="font-weight: normal; padding-bottom: 10px; font-size: 1.7em">&copy; 2018 Sahil Kalyani</h3>
      </div>

      <div class="modal" id="mymodal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="background: #101010; border: solid 1px white">
            <div class="modal-header" style="color: black">
              <button type="btn" class="close" id="closebtn" data-dismiss="modal">&times;</button>
              <h2 id="title" style="color: white">TITLE</h2>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                   <img src="" id="image" width="100%">
                </div>
                <div class="col-md-1"></div>
              </div>
              <h3 id="rules_h3" style="text-align: left; margin: 10px 10px 10px 20px; padding: 0; font-weight: normal; font-size: 2em">Rules and Regulations:</h3>
              <ol id="rules_ol" style="margin-left: 2em">
                  <li id="r1" style="font-weight: normal; text-decoration: none"></li>
                  <li id="r2" style="font-weight: normal; text-decoration: none"></li>
                  <li id="r3" style="font-weight: normal; text-decoration: none"></li>
                  <li id="r4" style="font-weight: normal; text-decoration: none"></li>
              </ol>
            </div>

            <div class="modal-footer" style="padding-left: 5%; padding-right: 5%;">
              <a class="btn" style="background: white; color: #101010; opacity: 1; font-size: 16px" disabled>Registration Closed</a>
            </div>
          </div>
        </div>
      </div>

      <!--<div class="modal" id="myfacepulsemodal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="background: #101010; border: solid 1px white">
            <div class="modal-header" style="color: black">
              <button type="btn" class="close" id="closebtn" data-dismiss="modal">&times;</button>
              <h2 id="f_title" style="color: white">TITLE</h2>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                   <img src="" id="f_image" width="100%">
                </div>
                <div class="col-md-1"></div>
              </div>
              <h3 style="text-align: left; margin: 10px 10px 10px 20px; padding: 0; font-weight: normal; font-size: 2em">Rules and Regulations:</h3>
              <ol style="margin-left: 2em">
                  <li id="f_r1"></li>
                  <li id="f_r2"></li>
                  <li id="f_r3"></li>
                  <li id="f_r4"></li>
              </ol>
            </div>

            <div class="modal-footer" style="padding-left: 5%; padding-right: 5%;">
              <a class="btn" target="_blank" id="f_cord" style="background: #101010; color: white; border: solid 1px white; opacity: 1; float: left; font-size: 22px; font-weight: 100; padding: 2px 3%">Coordinator Name - 123456789</a>
              <a onclick="fun5()" class="btn" style="background: white; color: #101010; opacity: 1; font-size: 16px">Register</a>
            </div>
          </div>
        </div>
      </div>-->
      
      <div id="mymodal_img" style="display:none; padding: 10px 0;">
        <img src="" id="modal_image" height="90%" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
      </div>
      
      <div class="modal" id="event_modal">
        <div class="modal-dialog" style="background: transparent;">
          <div class="modal-content" style="background: transparent">
            <form id="registration_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                <fieldset id="f1" class="fields">
                    <h2>Personal Details</h2><hr style="margin-bottom: 20px;">
                    <div class='alert alert-danger' id="error1" style="display: none"></div>
                    <!--<h3 id="error1" style="margin: 5px auto 15px auto; color: red; font-weight: normal; font-size: 1.2em; display: none;">Hola!</h3>-->
                    <div class="form-group">
                        <label class="sr-only" for="register-fullname">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="input" class="form-control" id="register-fullname" name="fullname" placeholder="Full Name" style="color: black;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="register-stream">Stream</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                            <select name="stream" class="form-control" id="register-stream" style="padding: 0px 12px !important; color: #999 !important;" onchange="funselect(this)" value="0">
                              <option value="0" selected disabled style="color: #aaa">Select Stream</option>
                              <option value="CSE" style="color: #555 !important;">CSE</option>
                              <option value="IT" style="color: #555 !important;">IT</option>
                              <option value="BT" style="color: #555 !important;">BT</option>
                              <option value="ECE" style="color: #555 !important;">ECE</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="sr-only" for="register-year">Year</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="padding: 9px 10px;"><i class="glyphicon glyphicon-book fa fa-graduation-cap"></i></span>
                            <select name="year" class="form-control" id="register-year" style="padding: 0px 12px !important; color: #999 !important;" onchange="funselect(this)" value="0">
                              <option value="0" selected disabled style="color: #aaa">Select Year</option>
                              <option value="1" style="color: #555 !important;">1st Year</option>
                              <option value="2" style="color: #555 !important;">2nd Year</option>
                              <option value="3" style="color: #555 !important;">3rd Year</option>
                              <option value="4" style="color: #555 !important;">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="register-college">College</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="padding: 9px 11px;"><i class="glyphicon glyphicon-book fa fa-university"></i></span>
                            <input type="text" class="form-control" id="register-college" name="college" placeholder="College" value="BENGAL INSTITUTE OF TECHNOLOGY" style="color: black">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="register-email">Email Id</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" class="form-control" id="register-email" name="email" placeholder="Email Id" style="color: black">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="register-phone">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input type="number" min="0" class="form-control" id="register-phone" name="phone" placeholder="Phone Number" style="color: black">
                        </div>
                    </div>

                    <a class="btn btn-danger" style="color: #fff; margin-left: 10px; float: left;" onclick="fun4()">Cancel</a>
                    <a class="btn btn-success" style="color: #fff; margin-right: 10px; float: right;" onclick="validate1()">Next</a>
                </fieldset>

                <fieldset id="f2" style="visibility: hidden; width: 100%; display: none;" class="fields">
                    <h2>Events</h2><hr>
                    <div class='alert alert-danger' id="error2" style="display: none"></div>
                    <!--<h3 id="error2" style="margin: 5px auto 15px auto; color: red; font-weight: normal; font-size: 1.2em; display: none;">Hola!</h3>-->
                    <div class="row" style="padding: 0 0 20px 0">
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-8 col-sm-8">
                          <div class="checkbox">
                            <label>
                              <input name="voice" id="voice" type="checkbox">&nbsp;&nbsp;Voice of Impulse
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input name="dance" id="dance" type="checkbox">&nbsp;&nbsp;Dance Competition
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input name="ramp" id="ramp" type="checkbox">&nbsp;&nbsp;Ramp on Fire
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input name="drama" id="drama" type="checkbox">&nbsp;&nbsp;Drama
                            </label>
                          </div>

                          <div class="checkbox" style="visibility: hidden; display: none">
                            <label>
                              <input name="jam" id="jam" type="checkbox">&nbsp;&nbsp;Let&rsquo;s Jam
                            </label>
                          </div>
                        </div>
                    </div>
                    <a class="btn" style="color: #fff; background-color: #f32a35; margin-left: 10px; float:left;" onclick="prevform()">Back</a>
                    <a name="register" class="btn" style="color: #fff; background-color: #2ECC71; margin-right: 10px; float:right;" onclick="validate2()">Register</a>
                </fieldset>
            </form>
          </div>
        </div>
      </div>
      
      <div class="modal" id="facepulse_event_modal">
        <div class="modal-dialog" style="background: transparent;">
          <div class="modal-content" style="background: transparent">
            <form id="facepulse_registration_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                <fieldset id="f1" class="fields">
                    <h2>Facepulse Registration</h2><hr style="margin-bottom: 20px;">
                    <div class='alert alert-danger' id="error3" style="display: none"></div>
                    <!--<h3 id="error1" style="margin: 5px auto 15px auto; color: red; font-weight: normal; font-size: 1.2em; display: none;">Hola!</h3>-->
                    <div class="form-group">
                        <label class="sr-only" for="f_register-fullname">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="input" class="form-control" id="f_register-fullname" name="f_fullname" placeholder="Full Name" style="color: black;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="f_register-stream">Stream</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                            <select name="f_stream" class="form-control" id="f_register-stream" style="padding: 0px 12px !important; color: #999 !important;" onchange="funselect(this)" value="0">
                              <option value="0" selected disabled style="color: #aaa">Select Stream</option>
                              <option value="CSE" style="color: #555 !important;">CSE</option>
                              <option value="IT" style="color: #555 !important;">IT</option>
                              <option value="BT" style="color: #555 !important;">BT</option>
                              <option value="ECE" style="color: #555 !important;">ECE</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="f_register-year">Year</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="padding: 9px 10px;"><i class="glyphicon glyphicon-book fa fa-graduation-cap"></i></span>
                            <select name="f_year" class="form-control" id="f_register-year" style="padding: 0px 12px !important; color: #999 !important;" onchange="funselect(this)" value="0">
                              <option value="0" selected disabled style="color: #aaa">Select Year</option>
                              <option value="1" style="color: #555 !important;">1st Year</option>
                              <option value="2" style="color: #555 !important;">2nd Year</option>
                              <option value="3" style="color: #555 !important;">3rd Year</option>
                              <option value="4" style="color: #555 !important;">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="f_register-college">College</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="padding: 9px 11px;"><i class="glyphicon glyphicon-book fa fa-university"></i></span>
                            <input type="text" class="form-control" id="f_register-college" name="f_college" placeholder="College" value="BENGAL INSTITUTE OF TECHNOLOGY" style="color: black">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="f_register-email">Email Id</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" class="form-control" id="f_register-email" name="f_email" placeholder="Email Id" style="color: black">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="f_register-phone">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input type="number" min="0" class="form-control" id="f_register-phone" name="f_phone" placeholder="Phone Number" style="color: black">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="sr-only" for="f_register-pic">Picture</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                            <input type="file" accept="image/jpg,image/x-png,image/jpeg" data-max-size="248" class="form-control" id="f_register-pic" name="f_pic" style="padding: 5px !important">
                        </div>
                    </div>

                    <a class="btn btn-danger" style="color: #fff; margin-left: 10px; float: left;" onclick="fun6()">Cancel</a>
                    <a name="f_register" class="btn" style="color: #fff; background-color: #2ECC71; margin-right: 10px; float:right;" onclick="validate3()">Register</a>
                </fieldset>
            </form>
          </div>
        </div>
      </div>
      
      <a class="page-scroll totop" href="#section1" style="text-decoration: none;"><span class="totoptip">Go to top</span><img id="to-top" src="img/up.png"></a>
      <a onclick="playSounds()" class="music" style="text-decoration: none;"><img id="music" src="img/msc.png"><span class="musictip">Change the track</span></a>
      <div id="element"></div>

      <script src="js/scrolling-nav.js"></script>
      <script src="js/jquery.easing.min.js"></script>
      <script type="text/javascript" src="js/scripts.js"></script>
      <script type="text/javascript" src="js/slider.js"></script>
    </div>
  </body>
</html>

<!--Developed by SAHIL G. KALYANI-->