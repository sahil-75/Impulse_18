/*Developed by SAHIL G. KALYANI*/

$(document).ready(function () {
    $('.modal').on('show.bs.modal', function () {
        if ($(document).height() > $(window).height()) {
            // no-scroll
            $('body').addClass("modal-open-noscroll");
        }
        else {
            $('body').removeClass("modal-open-noscroll");
        }
    });
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    });
});

function hideloader()
{
   document.getElementById('loader').style.visibility="visible";
   var delay=1000; //1 second
   document.getElementById('rest').style.visibility="hidden";
   
   setTimeout(function()
   {
      document.getElementById('loader').style.visibility="hidden";
      document.getElementById('loader').style.display="none";
      document.getElementById('rest').style.visibility="visible";
      playSounds();
      console.clear();
   }, delay);
}

$(window).on("scroll", function()
{
   if($(window).scrollTop() > 590)
   {
      $("#header").css("top","0");
   }
   else
   {
      $("#header").css("top","-70px");
   }
});

function fun1(x,y,rl1,rl2,rl3,rl4)
{
    /*$('#mymodal').modal('show');*/
    
    if(x=="Drama" || x=="FacePulse")
    {
        document.getElementById("rules_h3").style.display = "none";
        document.getElementById("rules_ol").style.display = "none";
    }
    else if(x=='Ramp on Fire')
    {
    	document.getElementById("rules_h3").style.display = "block";
        document.getElementById("rules_ol").style.display = "block";
        document.getElementById("rules_ol").innerHTML = "<a href='rof.pdf' target='_blank' style='font-size: 1.2em !important'>View/Download</a>";
    }
    else
    {
        document.getElementById("rules_h3").style.display = "block";
        document.getElementById("rules_ol").style.display = "block";
        document.getElementById("rules_ol").innerHTML = "<li id='r1' style='font-weight: normal; text-decoration: none'></li><li id='r2' style='font-weight: normal; text-decoration: none'></li><li id='r3' style='font-weight: normal; text-decoration: none'></li><li id='r4' style='font-weight: normal; text-decoration: none'></li>";
        
        document.getElementById("r1").innerHTML = rl1;
        document.getElementById("r2").innerHTML = rl2;
        document.getElementById("r3").innerHTML = rl3;
        document.getElementById("r4").innerHTML = rl4;
    }
    
    $('#mymodal').modal({backdrop: 'static', keyboard: false})
    document.getElementById("title").innerHTML = x;
    document.getElementById("image").src = y;
}

function fun7(x,y,rl1,rl2,rl3,rl4,crd,fb)
{
    document.getElementById("f_title").innerHTML = x;
    document.getElementById("f_image").src = y;
    
    document.getElementById("f_r1").innerHTML = rl1;
    document.getElementById("f_r2").innerHTML = rl2;
    document.getElementById("f_r3").innerHTML = rl3;
    document.getElementById("f_r4").innerHTML = rl4;
    document.getElementById("f_cord").innerHTML = crd;
    document.getElementById("f_cord").href = fb;
    
    $('#facepulse_event_modal').modal('hide');
    $('#myfacepulsemodal').modal({backdrop: 'static', keyboard: false})
}

function fun2(z)
{
   $('#mymodal_img').show();
   $('body').addClass("modal-open-noscroll");
   document.getElementById("modal_image").src = z;
}

function fun3()
{
    $('#mymodal').modal('hide');
    $('#event_modal').modal({backdrop: 'static', keyboard: false});
    $('body').style.padding = "0 !important";
    $('body').style.margin = "0 !important";
    /*alert("Registrations haven't started for this event yet! Stay Tuned!!");*/
}

function fun4()
{
    $('#event_modal').modal('hide');
    $('body').style.padding = "0 !important";
    $('body').style.margin = "0 !important";
}

function fun5()
{
    $('#myfacepulsemodal').modal('hide');
    $('#facepulse_event_modal').modal({backdrop: 'static', keyboard: false});
    /*$('body').style.padding = "0 !important";
    $('body').style.margin = "0 !important";*/
}

function fun6()
{
    $('#facepulse_event_modal').modal('hide');
    /*$('body').style.padding = "0 !important";
    $('body').style.margin = "0 !important";*/
}

$("#mymodal_img").click(function()
{
    $('#mymodal_img').hide();
    $('body').removeClass("modal-open-noscroll");
}).children().click(function(e) {
  return false;
});

var sounds = ["music/music-1.mp3",
              "music/music-2.mp3",
              "music/music-3.mp3",
              "music/music-4.mp3",
              "music/music-5.mp3"],
    oldSounds = [];

function playSounds()
{
    var index = Math.floor(Math.random() * (sounds.length)), thisSound = sounds[index];

    oldSounds.push(thisSound);
    sounds.splice(index, 1);

    if (sounds.length < 1) {
        sounds = oldSounds.splice(0, oldSounds.length);
    }

    $("#element").html("<audio autoplay loop src=\"" + thisSound + "\" autostart=\"true\" /></audio>");
}

function funselect(sel)
{
    sel.style.color = "#000";
}

function validate1()
{
    var fullname = document.getElementById('register-fullname').value;
    var stream = document.getElementById('register-stream').value;
    var year = document.getElementById('register-year').value;
    var college = document.getElementById('register-college').value;
    var email = document.getElementById('register-email').value;
    var phone = document.getElementById('register-phone').value;
    
    document.getElementById('error1').style.display = "none";
    
    if(fullname=="")
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter Your Full Name!";
    }
    else if(stream=='0')
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter Your Stream!";
    }
    else if(year=='0')
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter the Year!";
    }
    else if(college=="")
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter the name of your college!";
    }
    else if(email=="")
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter Your Email Address!";
    }
    else if(phone=="")
    {
        document.getElementById('error1').style.display = "block";
        document.getElementById('error1').innerHTML = "Please Enter Your Phone Number!";
    }
    else
    {
        nextform();
    }
}

function validate2()
{
    var voice = document.getElementById("voice").checked;
    var dance = document.getElementById("dance").checked;
    var ramp = document.getElementById("ramp").checked;
    var drama = document.getElementById("drama").checked;
    var jam = document.getElementById("jam").checked;
    
    document.getElementById('error2').style.display = "none";
    
    if(voice==false && dance==false && ramp==false && drama==false && jam==false)
    {
        document.getElementById('error2').style.display = "block";
        document.getElementById('error2').innerHTML = "You haven't selected any event! Please select the events in which you want to register";
    }
    else
    {
        document.getElementById('registration_form').submit();
    }
}

function validate3()
{
    var fullname = document.getElementById('f_register-fullname').value;
    var stream = document.getElementById('f_register-stream').value;
    var year = document.getElementById('f_register-year').value;
    var college = document.getElementById('f_register-college').value;
    var email = document.getElementById('f_register-email').value;
    var phone = document.getElementById('f_register-phone').value;
    var pic = document.getElementById("f_register-pic").value;
    
    document.getElementById('error3').style.display = "none";
    
    if(fullname=="")
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter Your Full Name!";
    }
    else if(stream=='0')
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter Your Stream!";
    }
    else if(year=='0')
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter the Year!";
    }
    else if(college=="")
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter the name of your college!";
    }
    else if(email=="")
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter Your Email Address!";
    }
    else if(phone=="")
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Enter Your Phone Number!";
    }
    else if(pic=="")
    {
        document.getElementById('error3').style.display = "block";
        document.getElementById('error3').innerHTML = "Please Select an Image";
    }
    else
    {
        pic = document.getElementById("f_register-pic").files[0];
        if(pic.size>5242880)
        {
            document.getElementById('error3').style.display = "block";
            document.getElementById('error3').innerHTML = "Please Select an image with a size less than 5mb";
        }
        else
        {
            document.getElementById('facepulse_registration_form').submit();
        }
    }
}

function nextform()
{
    document.getElementById('f1').style.animation="shrink 0.25s ease";
    document.getElementById('f1').style.visibility="hidden";
    document.getElementById('f1').style.display="none";
    
    document.getElementById('f2').style.animation="grow 0.25s ease";
    document.getElementById('f2').style.visibility="visible";
    document.getElementById('f2').style.display="block";
}

function prevform()
{
    document.getElementById('f2').style.animation="shrink 0.25s ease";
    document.getElementById('f2').style.visibility="hidden";
    document.getElementById('f2').style.display="none";
    
    document.getElementById('f1').style.animation="grow 0.25s ease";
    document.getElementById('f1').style.visibility="visible";
    document.getElementById('f1').style.display="block";
}

/*Developed by SAHIL G. KALYANI*/