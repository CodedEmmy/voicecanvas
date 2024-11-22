<?php
include_once("config.php");

$imageData = "";
$inputPrompt = "";
$confidenceLevel = 0;
$statusMessage = "";
$noError = true;
if(isset($_POST['captured_text'])){
	$inputPrompt = trim($_POST['captured_text']);
	$confidenceLevel = trim($_POST['confidence']);
	
	$curl = curl_init();
	$payload = array("prompt" => $inputPrompt, "aspect_ratio" => "1:1", "quality" => "MID", "style" => "PHOTOREALISTIC", "guidance_scale" => 50);
	
	curl_setopt_array($curl, [
		CURLOPT_HTTPHEADER =>["Accept: application/json","Authorization: Bearer $API_KEY", "Content-Type: application/json", "X-Api-Version: v1"],
		CURLOPT_POSTFIELDS => json_encode($payload),
		CURLOPT_PORT => "",
		CURLOPT_URL => $AI_ENDPOINT,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		]);
	
	$response = curl_exec($curl);
	$error = curl_error($curl);
	//Can optionally use http status codes to determine the status of the operation
	//$httpCode = curl_getinfo($curl, CURL_INFO_HTTP_CODE);
	curl_close($curl);
	if($error){
		$statusMessage = "cURL Error: ".$error;
		$noError = false;
	}else{
		$data = json_decode($response, true);
		$opStatus = $data["status"];
		if($opStatus == 400 || $opStatus == 401 || $opStatus == 429 || $opStatus == 500){
			$noError = false;
			$statusMessage = "Error: ".$data['detail'];
		}else if($opStatus == "FAILED"){
			$noError = false;
			$statusMessage = "Error: ".$data['failure_code']." (".$data['failure_reason'].")";
		}else if($opStatus == "IN_PROGRESS"){
			$statusMessage = "Processing";
			$noError = false;
		}else if($opStatus == "COMPLETED"){
			$statusMessage = "Successfully Completed";
			$dataArray = $data["data"];
			$imageData = $dataArray[0];
		}else{
			$noError = false;
			$statusMessage = "Error: ".$data['detail'];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>VoiceCanvas - Image</title>
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
                      <li>&nbsp;</li>
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>
	<div id="fb_box"><?php echo $statusMessage; ?></div>
	
	<div class="page-heading header-text">
		<div class="container">
		  <div class="row">
			<div class="col-lg-12">
			  <h3>Generated Image</h3>
			</div>
		  </div>
		</div>
	</div>
	
	<div class="single-property section">
		<div class="container">
		  <div class="row">
			<div class="col-lg-8">
			  <div class="main-image">
			  <?php
			  if($noError){
				  echo "<img src='{$imageData['asset_url']}' alt=''>";
			  }else{
				  echo "<img src='images/default.jpg' alt=''>";
			  }
			  ?>
			  </div>
			  <div class="main-content">
				<h4>Input Prompt</h4>
				<p><?php echo $inputPrompt;
					echo "<br><br><strong>Confidence Level:</strong> $confidenceLevel";
					?></p>
			  </div> 
			</div>
			<div class="col-lg-4">
			  <div class="info-table">
				<ul>
				  <li>
					<img src="images/marker.png" alt="" style="max-width: 52px;">
					<h4><?php if($noError){ echo $imageData["type"]; }else{ echo "N/A"; } ?><br><span>Image Type</span></h4>
				  </li>
				  <li>
					<img src="images/marker.png" alt="" style="max-width: 52px;">
					<h4><?php if($noError){ echo $imageData["width"]; }else{ echo "N/A"; } ?><br><span>Width</span></h4>
				  </li>
				  <li>
					<img src="images/marker.png" alt="" style="max-width: 52px;">
					<h4><?php if($noError){ echo $imageData["height"]; }else{ echo "N/A"; } ?><br><span>Height</span></h4>
				  </li>
				  <li>
					<img src="images/marker.png" alt="" style="max-width: 52px;">
					<h4><a href="<?php if($noError){ echo $imageData['asset_url']; }else{ echo "N/A"; } ?>">Image Link</a><br><span>Valid for 24 hours</span></h4>
				  </li>
				</ul>
			  </div>
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
  <script src="libs/jquery/jquery.min.js"></script>
  <script src="libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/isotope.min.js"></script>
  <script src="js/owl-carousel.js"></script>
  <script src="js/counter.js"></script>
  <script src="js/custom.js"></script>

  </body>
</html>