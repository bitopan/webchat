let TimeOUT = '';

const showAlert = (alert_type, message_content) => {
    clearTimeout(TimeOUT);
    $("body #toast-container").remove();
	let custom_alert_type = alert_type.replace(alert_type[0], alert_type[0].toUpperCase());
    let html = '<div id="toast-container">' +
					'<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" style="border:none;background-color: #ffffff;">' +
						'<div class="toast-header geek-'+alert_type+'-bg" style="color: #ffffff;"><strong class="mr-auto">'+custom_alert_type+'</strong></div>' +
						'<div class="toast-body">'+message_content+'</div>' +
					'</div>' +
				'</div>';
    $("body").append(html);
    TimeOUT = setTimeout(function() { 
								$("#toast-container").addClass("fade"); 
								$("body #toast-container").remove();
							}, 3000);
}