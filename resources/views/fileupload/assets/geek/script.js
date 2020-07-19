
/******jagjiban***********/
let TimeOUT = '';

const showAlert = (alert_type, message_content) => {
    clearTimeout(TimeOUT);
    $("body #toast-container").remove();
	let custom_alert_type = alert_type.replace(alert_type[0], alert_type[0].toUpperCase());
    let html = '<div id="toast-container">' +
					'<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="border:none;background-color: #ffffff;border-radius: 5px;">' +
						'<div class="toast-header bg-'+alert_type+'" style="color: #ffffff;"><strong class="mr-auto">'+custom_alert_type+'</strong></div>' +
						'<div class="toast-body">'+message_content+'</div>' +
					'</div>' +
				'</div>';
    $("body").append(html);
    TimeOUT = setTimeout(function() { 
								$("#toast-container").addClass("fade"); 
								$("body #toast-container").remove();
							}, 5000);
}

function ajaxCall(data_field) {
	return new Promise(resolve => {
		if(navigator.onLine) {
			showLoader();
			$.ajax({
				type: 'POST',
				url: "includes/server_process.php",
				data: data_field,
				dataType: "text",
				success: function (resultData) {
					hideLoader();
				    console.log(resultData);
					try {
						let ajax_call_status = JSON.parse(resultData);
						resolve(ajax_call_status);
					} catch(e) {
						let ajax_call_status = {"response":false, "message": "Oops! Something went wrong."};
						resolve(ajax_call_status);
					}
				},  error : function (richiesta, stato, errori)   {
					console.log(errori);
					let ajax_call_status = {"response":false, "message": "Oops! Something went wrong."};
					resolve(ajax_call_status);
				}  
			});
		} else {
			let ajax_call_status = {"response":false, "message": "Please check your internet connection."};
			resolve(ajax_call_status);
		}
	});
}

class ValidateField {

	validateString(data) {
		
		const validRegEx = /^[^\\\/&]*$/;
		if(data.length === 0 || data == '') {
			return 'Please enter a your name.';
		} else if(!/^[A-Za-z ]+$/.test(data)) {
			return 'Please enter a valid name.';
		} else {
			return true;
		}
	}

	validateNumber(data) {
		
		if(data.length === 0 || data == '') {
			return 'Please enter a your phone number.';
		} else if(data.length != 10) {
			return 'Please enter a valid 10 digit phone number.';
		} else if(!/^[\d\.\-]+$/.test(data)) {
			return 'Please enter a valid phone number.';
		} else {
			return true;
		}
	}

	validateEmail(data) {
		if(data.length === 0 || data == '') {
			return 'Please enter a your email id.';
		} else if(!/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(data)) {
			return 'Please enter a valid email id.';
		} else {
			return true;
		}
	}

	validateData(data, type) {

		if(data === undefined || data === "undefined") {
			return "Oops! Something went wrong.";
		}
		
		let result = '';
		switch(type) {
			case 'string' : 
							result = this.validateString(data);
							break;
			case 'number' : 
							result = this.validateNumber(data);
							break;	
			case 'email' :
							result = this.validateEmail(data);
							break;
			default:
					result = true;
					break;
		}	
		
		return result;
		
	}
	
}	

let validate_obj = new ValidateField();

$(document).ready(function(){

    var myET = $('.myTicker').easyTicker({
        direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 3000,
        height: 'auto',
        visible: 6,
        mousePause: true,
        callbacks: {
            before: function(ul, li){
                //console.log(this, ul, li);
                //$(li).css('color', 'red');
            },
            after: function(ul, li){
                //console.log(this, ul, li);
            }
        }
    }).data('easyTicker');

});



function showLoader(){

	document.getElementById('default-loader').style= "display:block";
	document.getElementById('default-loader-div').style= "display:block";
}

function hideLoader(){
	document.getElementById('default-loader').style= "display:none";
	document.getElementById('default-loader-div').style = "display:none";
}