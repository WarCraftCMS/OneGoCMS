$(document).ready(function(){
	$("*").click(function(event){
		linkLocation = this.href;
		
		if($(this).attr('data-popup-open')){
			var popup_name = $(this).attr('data-popup-open');

			$('.popup_bg').fadeIn(200);
			$('.popup[data-popup-name = ' + popup_name + ']').fadeIn(200);
		}

	});

	$(".popup_bg, .popup > .close, a.cancel").click(function(event){
        event.preventDefault();
		$('.popup_bg').fadeOut(200);
		$('.popup').fadeOut(200);

		// if(VIEW_SUCCESS){
		// 	window.location.href = 'https://wow-mania.com/logout';
		// }
	});

});

