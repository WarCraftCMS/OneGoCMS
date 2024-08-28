$(document).ready(function(){

	$(".close_alert").on('click', function (event) {
		event.preventDefault();
		document.cookie = "alert=" + $(this).data('alert');
		$(this).parents('.alert-window').fadeOut();
	});
	
	/**********************************************
	**************** FRONT MODULES ****************
	**********************************************/

	/**********************************************
	************** Switch Controller **************
	**********************************************/

	function switchController(classButton, dataButton, classBlock, dataBlock, saveHash){
		if(saveHash){
			var anc = window.location.hash.replace("#","");
			if(anc != '' && $(classButton + '[' + dataButton + ' = ' + anc + ']').length > 0){
				$(classButton + ',' + classBlock).removeClass("active");
				$(classButton + '[' + dataButton + ' = ' + anc + ']').addClass("active");
				$(classBlock + '[' + dataBlock + ' = ' + anc + ']').addClass("active");

				$('html, body').animate({
					scrollTop: ($(classButton + '[' + dataButton + ' = ' + anc + ']').offset().top) - 55
				}, Math.abs(($(classButton + '[' + dataButton + ' = ' + anc + ']').offset().top - $('html').scrollTop()) / 2));
			}
		}
		$(classButton).click(function(event){
			$(classButton + ',' + classBlock).removeClass("active");
			$(this).addClass("active");
			$(classBlock + '[' + dataBlock + ' = ' + $(this).attr(dataButton) + ']').addClass("active");
			if(saveHash){
				window.location.hash = $(this).attr(dataButton);
			}
		});
	}
	
	switchController('.rank-switch-btn', 'data-view-table', '.rank-switch-table', 'data-id-table', false); // rankings

	/**********************************************
	************** Toggle Controller **************
	**********************************************/
	
	function toggleController(classBlock, classButton, classBox){
		$(classBlock + ' > ' + classButton).click(function(event){
			$(this).parent().find(classBox).slideToggle();
		});
	}
	
	toggleController('.toggle-block','.toggle-title','.toggle-box');
	
	/**********************************************
	************* Drop Box Controller *************
	**********************************************/

	function dropboxController(classButton, classBlock){
		$(classButton).click(function(){
			$(classBlock).not($(this).parent().find(classBlock)).removeClass("active");
			$(this).parent().find(classBlock).toggleClass("active");
		});

		$(document).mouseup(function (e) {
			if(!$(e.target).parents(classBlock).length > 0 && $(e.target) != classBlock){
				$(classBlock).removeClass("active");
			}
		});
	}
	function subboxController(classButton, classBlock){
		$(classButton).click(function(){
			$(this).parent().toggleClass("active");
		});
	}

	dropboxController('.open-drop-box','.drop-box');
	subboxController('.sub-title','.sub-item');
	
	/**********************************************
	******************** END **********************
	**********************************************/
	
	$(".realmist").click(function(event){
		var copytext = document.createElement('input');
		copytext.value = 'set realmlist logon.wow.ne.kg';
		document.body.appendChild(copytext);
		copytext.select();
		document.execCommand('copy');
		document.body.removeChild(copytext);
		
		$(this).empty();
		$(this).append('copied to the clipboard!');
		
		setTimeout(function(){
			$(".realmist").empty();
			$(".realmist").append('set realmlist logon.wow.ne.kg');
		}, 2000);
	});

	/**********************************************
	 ****************** BALANCE ********************
	 **********************************************/

	var progress = $(".progress");
	var progressCount = progress.length;
	var progressPercent;

	if(progressCount > 0){
		progressPercent = $('.progress_bg > .alliance > span').text();
		$('.progress_bg > .progress > .bar').css('width', progressPercent + '%');
		$('.progress_bg > .orda > span').text( 100 - progressPercent );
	}




	$(document).on('click', '.shop_button', function (e) {
		$('#buy').data('item', $(this).data('item'));
		$('#buy-new').data('item', $(this).data('item'));

		var item = $(this).parents('.item').find('.name').text();
		$('item').text(item);

		var price = $(this).parents('.item').find('.price').text();
		$('price').text(price.toLowerCase());
	});


	$(document).on('click', '#buy_confirm', function (e) {
		var character_id = $('select[name=characters] option:selected').val();
		if(character_id == 0){
			alert('Please select character');
			return false;
		} else {
			$('.popup[data-popup-name=item_confirm]').fadeOut(200);
			var character = $('select[name=characters] option:selected').text();
			$('character').text(character);
		}
	});


	$(document).on('click', '#buy', function (e) {
		e.preventDefault();

		var character_id = $('select[name=characters] option:selected').val();
		if(character_id == 0){
			alert('Please select character');
			return false;
		} else {
			var product_id = $(this).data('item');

			$.ajax({
				type: "POST",
				url: '/account/buy/',
				dataType: 'json',
				data: {
					product_id: product_id,
					character_id: character_id,
				},
				success: function (response) {
					if(response.status == 'success'){
						$('#balance').html(response.balance + ' Coins');
						$('.balance_panel').html(response.balance + ' Coins');
						$('.popup[data-popup-name=item_confirm_buy]').fadeOut(200);
						$('.popup[data-popup-name=success]').fadeIn(200);
					} else {
						$('.popup[data-popup-name=item_confirm_buy]').fadeOut(200);
						$('.popup[data-popup-name=error]').fadeIn(200);
					}
				}
			});
		}

	});

	$(document).on('click', '#buy_confirm-new', function (e) {
		var character_id = $('select[name=characters] option:selected').val();
		var realm_id = $('select[name=realms] option:selected').val();
		if(character_id == 0){
			alert('Please select character');
			return false;
		} else if (realm_id == 0) {
			alert('Please select realm and character');
			return false;
		} else {
			$('.popup[data-popup-name=item_confirm]').fadeOut(200);
			var character = $('select[name=characters] option:selected').text();
			var realm = $('select[name=realms] option:selected').text();
			$('character').text(character);
			$('realm').text(realm);
		}
	});

	$(document).on('click', '#buy-new', function (e) {
		e.preventDefault();

		var character_id = $('select[name=characters] option:selected').val();
		var realm_id = $('select[name=realms] option:selected').val();
		if(character_id == 0){
			alert('Please select character');
			return false;
		} else if (realm_id == 0) {
			alert('Please select realm and character');
			return false;
		} else {
			var product_id = $(this).data('item');

			$.ajax({
				type: "POST",
				url: '/account/buy-new/',
				dataType: 'json',
				data: {
					realm_id: realm_id,
					product_id: product_id,
					character_id: character_id,
				},
				success: function (response) {
					if(response.status == 'success'){
						$('#balance').html(response.balance + ' Coins');
						$('.balance_panel').html(response.balance + ' Coins');
						$('.popup[data-popup-name=item_confirm_buy]').fadeOut(200);
						$('.popup[data-popup-name=success]').fadeIn(200);
					} else {
						$('.popup[data-popup-name=item_confirm_buy]').fadeOut(200);
						$('.popup[data-popup-name=error]').fadeIn(200);
					}
				}
			});
		}

	});

	iFrameResize({ log: true }, '#iframe');


	$(document).on('submit', '#login-form', function () {

		$.ajax({
			type: "POST",
			url: '/forum-login.php',
			dataType: 'json',
			data: {
				username: $('#loginform-username').val(),
				password: $('#loginform-password').val(),
				login: 1,
			}
		});

	});

	$(document).on('click', '.exit_button', function () {

		$.ajax({
			type: "POST",
			url: '/forum-login.php',
			dataType: 'json',
			data: {
				logout: 1,
			}
		});

	});

	$(document).on('click', '.vote-not-callback', function (e) {
		var vote_id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: '/payment/set-vote-not-callback/',
			dataType: 'json',
			data: {
				voteId: vote_id,
			}
		});
	});

	$(document).on('click', '#send-coins', function (e) {
		e.preventDefault()
		let username = $('#transferform-username').val();
		let amount = $('#transferform-amount').val();

		if(username != "" && amount != "" && username.toLowerCase() != USERNAME) {
			$('username').text(username);
			$('amount').text(amount);
			$('.popup_bg').fadeIn(200);
			$('.popup[data-popup-name=confirm_send]').fadeIn(200);
		} else {
			$('#transfer-form').submit();
		}
	});

	if(VIEW_SUCCESS){
		$('.popup_bg').fadeIn(200);
		$('.popup[data-popup-name=success]').fadeIn(200);
	}

	if(VIEW_ERROR){
		$('.popup_bg').fadeIn(200);
		$('.popup[data-popup-name=error]').fadeIn(200);
	}

	$(document).on('change', '#realm-select', function (e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: '/account/set-realm',
			dataType: 'html',
			data: {
				id: $(this).val(),
			},
			success: function (response) {
				$('.select-realm').html(response);
			}
		});
	})

	// if(LOGIN && REG){
	// 	$.ajax({
	// 		type: "POST",
	// 		url: '/forum-login.php',
	// 		dataType: 'json',
	// 		data: {
	// 			username: LOGIN,
	// 			password: REG,
	// 			login: 1,
	// 		}
	// 	});
	// }
});

