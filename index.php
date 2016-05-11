<?php
    include_once "fbmain.php";
?>

<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<!-- BEGIN head -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<title>Cool Frames</title>

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.png" />

<!-- Stylesheet -->
<link type="text/css" href="css/style.css" rel="stylesheet" />
<link type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:rerular,italic,bold,bolditalic" rel="stylesheet" />
<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
<![endif]-->

<!-- END head -->
</head>

<!-- BEGIN body -->
<body>

<div id="preloader"></div>

<div id="header" class="inner">

  <div class="logo left">

    <img src="images/logo.png" alt="Cool Frames" />

    <div class="like-button">

      <fb:like href="http://www.facebook.com/thevolumens" layout="button_count"></fb:like>

    </div><!--like-button-->

  </div><!--logo-->

  <div class="profile right">

    <a class="trigger">Hello, <strong><?php echo $user_profile['name']; ?></strong><span></span></a>

    <div class="tooltip">

      <ul>
        <li><a href="<?php echo $user_profile['link']; ?>" target="_blank"><span>Profile</span></a></li>
        <li><a href="#" onclick="feedDialog(); return false;"><span>Share</span></a></li>
        <li><a href="#" onClick="requestsDialog(); return false;"><span>Invite</span></a></li>
      </ul>

    </div><!--tooltip-->

  </div><!--profile-->

</div><!--header-->

<div id="main" class="clearfix">

  <div id="left-add" class="banner">

	<script type="text/javascript">
		google_ad_client = "ca-pub-5997029164354874";
		google_ad_slot = "8599768551";
		google_ad_width = 120;
		google_ad_height = 600;
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

  </div><!--left-add-->

  <div id="right-add" class="banner">

	<script type="text/javascript">
		google_ad_client = "ca-pub-5997029164354874";
		google_ad_slot = "2553234954";
		google_ad_width = 120;
		google_ad_height = 600;
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

  </div><!--right-add-->

  <form id="upload_form" action="index.php" name="upload_form" method="post">
    <input type="hidden" name="action" value="upload_fb_image">
    <input type="hidden" name="photo" id="photo" value="">
    <input type="hidden" name="message" id="message" value="">
	<input type="hidden" name="icon" id="icon" value="">
  </form>

  <?php
	if (isset($_GET['res'])) {
	  if ($_GET['res'] == 'true'){
  ?>

  <div class="alert clearfix" id="success">

    <p>Photo uploaded successfully</p>

  </div><!--success-->

  <?php
    }
    if ($_GET['res'] == 'false'){
  ?>

  <div class="alert clearfix" id="error">

    <p>An error has occurred, please try again...</p>

  </div><!--error-->

  <?php
    }
  }
  ?>

  <div class="alert clearfix" id="loading">

    <p>Please wait while your photo is generated...</p>

  </div><!--loading-->

  <div id="frames" class="clearfix" >

  	<div id="overlay"></div>

    <div id="actions">

      <h2>Choose Frame</h2>

      <a class="prev browse left"></a>
      <a class="next browse right"></a>

    </div><!--actions-->

    <div class="scrollable vertical">

      <div class="items">

        <div>

          <ul>
            <li class="obj-item" onclick="change('frame1')"><img src="images/thumbnails/frame1.jpg" alt="" /><span>Christmas</span></li>
            <li class="obj-item" onclick="change('frame2')"><img src="images/thumbnails/frame2.jpg" alt="" /><span>Christmas</span></li>
            <li class="obj-item" onclick="change('frame3')"><img src="images/thumbnails/frame3.jpg" alt="" /><span>Christmas</span></li>
            <li class="obj-item" onclick="change('frame4')"><img src="images/thumbnails/frame4.jpg" alt="" /><span>Books</span></li>
            <li class="obj-item" onclick="change('frame5')"><img src="images/thumbnails/frame5.jpg" alt="" /><span>Snow</span></li>
            <li class="obj-item" onclick="change('frame6')"><img src="images/thumbnails/frame6.jpg" alt="" /><span>Nature</span></li>
            <li class="obj-item" onclick="change('frame7')"><img src="images/thumbnails/frame7.jpg" alt="" /><span>Flowers</span></li>
            <li class="obj-item" onclick="change('frame8')"><img src="images/thumbnails/frame8.jpg" alt="" /><span>Present</span></li>
          </ul>

        </div>

        <div>

          <ul>
            <li class="obj-item" onclick="change('frame9')"><img src="images/thumbnails/frame9.jpg" alt="" /><span>Old School</span></li>
            <li class="obj-item" onclick="change('frame10')"><img src="images/thumbnails/frame10.jpg" alt="" /><span>Springtime</span></li>
            <li class="obj-item" onclick="change('frame11')"><img src="images/thumbnails/frame11.jpg" alt="" /><span>Valentine</span></li>
            <li class="obj-item" onclick="change('frame12')"><img src="images/thumbnails/frame12.jpg" alt="" /><span>Girly</span></li>
            <li class="obj-item" onclick="change('frame13')"><img src="images/thumbnails/frame13.jpg" alt="" /><span>Christmas</span></li>
            <li class="obj-item" onclick="change('frame14')"><img src="images/thumbnails/frame14.jpg" alt="" /><span>Santa</span></li>
            <li class="obj-item" onclick="change('frame15')"><img src="images/thumbnails/frame15.jpg" alt="" /><span>Fantasy</span></li>
            <li class="obj-item" onclick="change('frame16')"><img src="images/thumbnails/frame16.jpg" alt="" /><span>Love</span></li>
          </ul>

        </div>

      </div><!--items-->

    </div><!--scrollable-->

  </div><!--frames-->

  <div id="picture">

	<div id="ajaxload"></div>

    <input type="text" name="description" onclick="this.value='';" onblur="this.value=!this.value?'Add a description...':this.value;" value="Add a description..." id="description">

    <div id="camera">

      <div id="frame"></div>

      <div id="screen"></div>

      <div id="buttons">

        <div class="buttons-pane">

          <a id="settings" href="javascript:void(0)" class="button">Camera Settings</a>
          <a id="shoot" href="javascript:void(0)" class="button">Shoot Picture</a>

        </div><!--buttonPane-->

        <div class="buttons-pane hidden">

          <a id="cancel" href="javascript:void(0)" class="button">Chance Picture</a>
          <a id="upload" href="javascript:void(0)" class="button">Upload to Facebook</a>
          <a id="download" href="javascript:void(0)" class="button">Download Picture</a>

        </div><!--buttons-pane-->

      </div><!--buttons-->

    </div><!--camera-->

  </div><!--picture-->

</div><!--main-->

<div id="steps" class="clearfix">

  <div class="column">

    <h3>Shoot</h3>

    <p><span class="number">1</span>Shoot a picture and then choose one of the sixteen available frames to transform its look and feel. Each frame is completely different so you should choose the one that best suits your picture.</p>

  </div><!--column-->

  <div class="column">

    <h3>Upload</h3>

    <p><span class="number">2</span>When you have your framed picture, press the "Upload to Facebook" button and automatically save the picture into a new photo album in your profile. You can also add a description for your picture.</p>

  </div><!--column-->

  <div class="column" id="last">

    <h3>Share</h3>

    <p><span class="number">3</span>Now share this awesome app with your friends by clicking the "like" button, post it in your profile by clicking the "share it" button or send an invitation by email by clicking the "invite" button.</p>

  </div><!--column-->

</div><!--steps-->

<div id="footer">

  <div class="inner clearfix">

    <p class="left">Cool Frames © <?php echo date("Y") ?> | All Rights Reserved</p>
    <p class="right">Developed by <a href="http://www.volumens.com" target="_blank">Volumens</a></p>

  </div><!--inner-->

</div><!--footer-->

<!-- JS Scripts -->
<script type="text/javascript" src="js/jquery.min.js?ver=1.8.2"></script>
<script type="text/javascript" src="js/jquery.tools.min.js?ver=1.2.7"></script>
<script type="text/javascript" src="js/jquery.webcam.js?ver=1.0.9"></script>
<script type="text/javascript" src="js/jquery.custom.js?ver=1.0"></script>

<script type="text/javascript">

	// Feed Dialog
	function feedDialog() {
		FB.ui({
			method: 'feed',
			link: 'http://apps.volumens.com/cool-frames/',
			picture: 'http://apps.volumens.com/cool-frames/images/thumbnail.png',
			name: 'Cool Frames',
			caption: 'Facebook Application',
			description: 'Add a cool frame to your webcam pictures'
        });
	}

	// Requests Dialog
	function requestsDialog(){
		var receiverUserIds = FB.ui({
			method : 'apprequests',
			message: 'Add a cool frame to your webcam pictures'
		});
	}

</script>

<div id="fb-root"></div>
<script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
	FB.init({
		appId  : '<?= $_CONFIG['appid'] ?>',
		status : true, // Check login status
		cookie : true, // Enable cookies to allow the server to access the session
		xfbml  : true  // Parse XFBML
	});
</script>

</body>
<!-- END body -->

</html>
<!-- END html -->
