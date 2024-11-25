/**
Web speech routines for voice canvas app
*/
const MAX_CHAR_LENGTH = 2000;
let isRecording = false;
var speechAPI = null;
var userText = "";
var conLevel = 0;


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
	if(isRecording && speechAPI != null){
		speechAPI.stop();
		recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
		isRecording = false;
		if(userText.length > 0){
			var dataForm = document.getElementById("createform");
			dataForm.addEventListener("submit",(e) => {e.preventDefault();});
			dataForm.captured_text.value = userText;
			dataForm.confidence.value = conLevel;
			dataForm.submit();
			//let testData = "Success: Captured = " + userText + "(" + conLevel + ")";
			//feedbackBox.innerHTML = testData;
		}else{
			feedbackBox.innerHTML = "Error: No speech was captured.";
		}
	}else{
		speechAPI = initSpeechLib();
		if(speechAPI == null){
			feedbackBox.innerHTML = "Error: Speech API not detected in your browser";
		}else{
			speechAPI.onresult = function(event){
				userText = "";
				let totalConfidence = 0;
				for(var i = event.resultIndex; i < event.results.length;i++){
					userText += event.results[i][0].transcript;
					//Limit input prompt to maximum allowed characters
					if(userText.length > MAX_CHAR_LENGTH){
						userText = userText.substr(0, MAX_CHAR_LENGTH);
					}
					feedbackBox.innerHTML = userText;
					totalConfidence += event.results[i][0].confidence;
				}
				if(events.results.length > 0){
					conLevel = totalConfidence/events.results.length;
				}else{
					conLevel = 0;
				}
			}
			
			speechAPI.onerror = function(event){
				var errorMessage = "Error: " + event.error;
				feedbackBox.innerHTML = errorMessage;
				recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
				isRecording = false;
			}
			
			speechAPI.onend = function(event){
				//API disconnected
				speechAPI.stop();
				recordButton.innerHTML = "<i class='fa fa-microphone'></i> Create New";
				isRecording = false;
			}
			
			if(!isRecording){
				speechAPI.start();
				isRecording = true;
				recordButton.innerHTML = "<i class='fa fa-microphone'></i> Next Step ...";
				feedbackBox.innerHTML = "Recording Active: Start your image description";
			}
		}
	}
}
