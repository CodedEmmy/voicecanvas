<!DOCTYPE html>
<html lang="en">
  <head>
	<title>VoiceCanvas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href="images/favicon.png" rel="icon">
	<link rel="stylesheet" href="css/voicecanvas.css">
    <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
  </head>

<body>

  <!--  Preloader -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-10">
          <ul class="info">
            <li><i class="fa fa-microphone"></i> Voice-based</li>
            <li><i class="fa fa-image"></i> AI Imagery</li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-2">
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-paint-brush"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="./" class="logo">
						<img src="images/logo.png">
                    </a>
                    <ul class="nav">
                      <li><a href="./" class="active">Home</a></li>
                      <li><a href="about.php">About</a></li>
                      <li><a href="javascript:void(0)" onclick="captureSpeech();" id="rec_btn"><i class="fa fa-microphone"></i> Create New</a></li>
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>
	<div>
		<form id="createform" name="createform" method="post" action="canvas.php">
			<input type="hidden" id="captured_text" name="captured_text" value="Artist painting a scene with a microphone in his hand.">
			<input type="hidden" id="confidence" name="confidence" value="0">
		</form>
	</div>
	<div id="fb_box"></div>
  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
          <span class="category">Voice<em>Canvas</em></span>
          <h2>No frills!<br>Just speak and create.</h2>
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Voice<em>Canvas</em></span>
          <h2>One Step<br>Convert voice into art</h2>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>VoiceCanvas </p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="libs/speechlib.js"></script>
  <script src="libs/jquery/jquery.min.js"></script>
  <script src="libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/isotope.min.js"></script>
  <script src="js/owl-carousel.js"></script>
  <script src="js/counter.js"></script>
  <script src="js/custom.js"></script>

  </body>
</html>