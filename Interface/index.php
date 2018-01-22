<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/materialize.clockpicker.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <?php

$myfile = fopen("override.txt", "r") or die("Unable to open file!");
$op = fread($myfile,filesize("override.txt"));
$override1 = explode('~', $op )[0];
$override2 = explode('~', $op )[1];
$t1 = explode('~', $op)[2];
$t2 = explode('~', $op)[3];
echo $t1;

$php_sunset_time = date('Y-m-d H:i:s', strtotime(date_sunset(date(), SUNFUNCS_RET_STRING, 22.3460, 87.2320, 100, 5.5)));
$php_sunrise_time = date('Y-m-d H:i:s', strtotime(date_sunrise(date(), SUNFUNCS_RET_STRING, 22.3460, 87.2320, 100, 5.5)));


$current = date('Y-m-d H:i:s'); 
?>
  <body>    

      <nav>
        <div class="nav-wrapper" style="background: #666">
          <a href="#" class="brand-logo center">Light Controller</a>
          <!-- <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
          </ul> -->
        </div>
      </nav>
      <div class="container">
         <div class="collection">
          <a href="#!" class="collection-item"><span class="badge"><?php echo $php_sunrise_time; ?></span>Sunrise</a>
          <a href="#!" class="collection-item"><span class="badge"><?php echo $php_sunset_time; ?></span>Sunset</a>
          <a href="#!" class="collection-item"><span class="badge"><?php echo $current; ?></span>Current</a>
          <a href="#!" class="collection-item"><span class="badge"><?php echo $override; ?></span>Override</a>
        </div><br><br>
        <div class="row">
          <div class="col s4">
            <h5>Override Switch</h5><hr><br>
            <div class="switch">
              <label>
                Off
                <input type="checkbox" id="override1" <?php if($override==1){ echo 'checked'; }?>>
                <span class="lever"></span>
                On
              </label>
            </div>
          </div>
          <div class="col s8">
            <form class="col s12">
              <h5>Override Timings</h5><hr><br>
              <div class="switch">
                <label>
                  Off
                  <input type="checkbox" id="override2" <?php if($override==1){ echo 'checked'; }?>>
                  <span class="lever"></span>
                  On
                </label>
              </div><br><br>

              <div class="col s6">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="timepicker_sunrise">Manual Sunrise</label>
                        <input id="timepicker_sunrise" class="timepicker" type="time">
                    </div>
                </div>
              </div>
              <div class="col s6">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="timepicker_sunset">Manual Sunset</label>
                        <input id="timepicker_sunset" class="timepicker" type="time">
                    </div>
                </div>
              </div>
              <a class="waves-effect waves-light btn" id="settime">Set Timing</a>
            </form>
          </div>
        
      </div>
      </div>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/materialize.clockpicker.js"></script>
    <script type="text/javascript">
      $("#override").change(function(){
          param = $("#override").prop("checked");
          $.ajax({url: "statuschange.php?mode=1&param="+param, success: function(result){
              $("#div1").html(result);
          }});
      });

      $('#settime').click(function(){
          param1 = $("#override1").prop("checked");
          param2 = $("#override2").prop("checked");
          t1 = $('#timepicker_sunrise').val();
          t2 = $('#timepicker_sunset').val();
          $.ajax({url: "statuschange.php?mode=2&param1="+param1+"&param2="+param2+"&t1="+t1+"&t2="+t2, success: function(result){
              $("#div1").html(result);
          }});
      });

    </script>
    <script type="text/javascript">

      $('#timepicker_sunrise').pickatime({
        ampmclickable: true
      });

      $('#timepicker_sunset').pickatime({
        ampmclickable: true
      });
    </script>
  </body>
<?php fclose($myfile); ?>
</html>