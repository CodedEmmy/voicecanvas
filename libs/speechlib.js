/**
Web speech routines for voice canvas app
*/
const MAX_CHAR_LENGTH = 2000;
let isRecording = false;


function initSpeechLib()
{
	const speechObject = window.SpeechRecognition || window.webkitSpeechRecognition;
	var speechLibrary = null;
	if(typeof speechObject !== 'undefined'){
		speechLibrary = new speechObject();
		speechLibrary.continuous = true;
		speechLibrary.interimResults = true;
		//speechLibrary.maxAlternatives = 2;
	}
	return speechLibrary;
}

function captureSpeech()
{
	var recordButton = document.getElementById("rec_btn");
	var feedbackBox = document.getElementById("fb_box");
	var dataForm = document.getElementById("createform");
	var userText = "";
	
	const speechAPI = initSpeechLib();
	if(speechAPI == null){
		feedbackBox.innerHTML = "Error: Speech API not detected in your browser";
	}else{
		speechAPI.onresult = function(event){
			var conLevel = 0;
			for(var i = event.resultIndex; i < event.results.length;i++){
				if(event.results[i].isFinal){
					userText = event.results[i][0].transcript;
				}else{
					userText += event.results[i][0].transcript;
				}
				//Limit input prompt to maximum of 2000 characters
				if(userText.length > MAX_CHAR_LENGTH){
					userText = userText.substr(0, MAX_CHAR_LENGTH);
				}
				feedbackBox.innerHTML = userText;
				conLevel = event.results[i][0].confidence;
			}
			dataForm.captured_text.value = userText;
			dataForm.confidence.value = conLevel;
			dataForm.submit();
		}
		
		speechAPI.onerror = function(event){
			var errorMessage = "Error: " + event.error;
			feedbackBox.innerHTML = errorMessage;
			recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
		}
		
		speechAPI.onspeechend = function(event){
			recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
		}
		
		speechAPI.onend = function(event){
			recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
		}
		
		if(isRecording){
			speechAPI.stop();
			recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
		}else{
			speechAPI.start();
			recordButton.innerHTML = "<i class='fa fa-microphone'></i> Next Step";
			feedbackBox.innerHTML = "Recording Active: Start your image description";
		}
		isRecording = !isRecording;
	}
}
