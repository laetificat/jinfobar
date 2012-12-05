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
?>

 <html>

   <style type="text/css"> /*The CSS*/
      body {
          margin: 0 !important;
          padding: 0 !important;
      }

      .notify {
          position: fixed !important;
          width: 100% !important;
          background-color: <?php echo $params->get('setcolor'); ?> !important;
          left: 0px;
          margin-top: -64px !important;
          color: <?php echo $params->get('settxtcolor'); ?> !important;
          text-align: center !important;
          font-size: 2em !important;
          line-height: 2.6em !important;
          font-family: Arial, sans-serif !important;
          cursor: pointer !important;
          opacity: <?php echo $params->get('settransparency') / 100; ?> !important;
          filter: alpha(opacity=<?php echo $params->get('settransparency'); ?>) !important; /* For IE8 and older */
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
            $('.notify').css("display","none");
         };
      });

   /*Slide the bar down*/   
      $(document).ready(function(){
         $(".notify").animate({"top": "+=64px"}, "slow");
      });

    /*Slide the bar up and set a cookie to keep it hidden if clicked*/
      $(document).ready(function(){
         $(".notify").click(function(){
            $(this).animate({"top": "-=80px"}, "slow");
            $.cookie('bar', 'hidden', {expires: <?php echo $params->get('setcookietime'); ?>});
         });
      });
   </script>

 </head>
 <body>

   <div class="notify">
      <?php
         echo $params->get('settext');
      ?>
   </div>
 </body>
 </html>