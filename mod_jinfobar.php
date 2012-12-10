<?php
//jInfobar module for Joomla 2.5(tested)
//Made by Kevin Heruer
//Using the jQuery cookie plugin from: https://github.com/carhartl/jquery-cookie
//www.laetificat.com


//don't allow other scripts to grab and execute our file
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

//Load jQuery and jQuery cookie plugin
JHTML::script('jquery.js', '/modules/mod_jInfobar/js/');
JHTML::script('jquery.cookie.js', '/modules/mod_jInfobar/js/');

//Seperate variable for the shadow boolian
$setshadow = $params->get('setshadow');
$imgtxt = $params->get('imgtxt');
?>

 <html>

   <style type="text/css"> /*The CSS*/
      body {
          margin: 0 !important;
          padding: 0 !important;
      }
      <?php if ($imgtxt == 1) {
        echo"
        #closeBar {
        position: absolute;
        right: 2px;
        top: 2px;
        clear: both;
        width: 32px;
        height: 32px;
        cursor: pointer !important;
      }"
      ;}else {
        echo"
        #closeBar {
        position: absolute;
        right: 8px;
        clear: both;
        width: auto;
        font-size: 14px;
        cursor: pointer !important;
      }";
      } ?>

      #notify {
          position: fixed;
          width: 100%;
          background-color: <?php echo $params->get('setcolor'); ?>;
          left: 0px;
          margin-top: -64px;
          color: <?php echo $params->get('settxtcolor'); ?>;
          text-align: center;
          font-size: 2em;
          line-height: 2.6em;
          font-family: Arial, sans-serif;
          opacity: <?php echo $params->get('settransparency') / 100; ?>;
          filter: alpha(opacity=<?php echo $params->get('settransparency'); ?>); /* For IE8 and older */
          <?php
            if($setshadow == 1) {
              echo"
                -webkit-box-shadow: 0 0 8px black !important;
                -moz-box-shadow:    0 0 8px black !important;
                box-shadow:         0 0 8px black !important;
              ";
            }else {

              } ?>
          z-index: 9999 !important;
      }​
   </style>

 <head>

   <script type="text/javascript">

   /*Check if there's already a cookie set on hidden, if not, show the bar*/
      $(document).ready(function(){
         var bar = $.cookie('bar');
         if (bar == 'hidden') {
            $('#notify').css("display","none");
         };
      });

   /*Slide the bar down*/   
      $(document).ready(function(){
         $("#notify").animate({"top": "+=64px"}, "slow");
      });

    /*Slide the bar up and set a cookie to keep it hidden if clicked*/
      $(document).ready(function(){
         $("#closeBar").click(function(){
            $("#notify").animate({"top": "-=80px"}, "slow");
            $.cookie('bar', 'hidden', {expires: <?php echo $params->get('setcookietime'); ?>});
         });
      });
   </script>

 </head>
 <body>

   <div id="notify">
      <div id="closeBar">
        <?php
          if ($imgtxt == 1) {
          echo '<img src="'.$params->get('closeImage').'" width="32px" height="32px"/>';
          }else {
          echo $params->get('setclose');
        }
        ?>
     </div>
    <div id="barTxt">
      <?php
         echo $params->get('settext');
      ?>
    </div>
   </div>
 </body>
 </html>