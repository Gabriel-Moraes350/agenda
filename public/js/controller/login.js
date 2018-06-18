$(window).on('load',function(){

	$('form').on('submit',function(e){
		e.preventDefault();
		e.stopPropagation();		

		if(!validateForm()){
			return false;
		}

		$.blockUI({
			message:$('#preloader').html()
		});

		$.ajax({
			url: '/login',
			type: 'POST',
			dataType: 'JSON',
			data: {login:returnValueFields().email,
				password:returnValueFields().password},
		})
		.done(function(obj) {
			console.log(obj);
			if(obj.error === true){
				alertify.error(obj.message);
				return;
			}

			alertify.success(obj.message);
			setTimeout(function(){
				window.location.href = '/admin';
			}, 2000)
		})
		.fail(function() {
			alertify.error('Ocorreu um erro ao logar');
		})
		.always(function() {
			$.unblockUI();
		});
		

	});
});

function returnValueFields(){
	let email = $('#email').val();
	let password = $('#password').val();
	return {
		email:email,
		password:password
	}
}

function returnFields(){
	let email = $('#email');
	let password = $('#password');
	return {
		email:email,
		password:password
	}
}

function validateForm(){
	let error = false;
	if(!validateEmail(returnValueFields().email)){
		returnFields().email.addClass('is-invalid');
		returnFields().email.removeClass('is-valid');
		error = true;
	}else{
		returnFields().email.addClass('is-valid');
		returnFields().email.removeClass('is-invalid');
	}

	if(returnValueFields().password.length < 6){
		returnFields().password.addClass('is-invalid');
		returnFields().password.removeClass('is-valid');
		error = true;
	}else{
		returnFields().password.addClass('is-valid');
		returnFields().password.removeClass('is-invalid');
	}

	if(error === true){
		return false;
	}

	return true;
}