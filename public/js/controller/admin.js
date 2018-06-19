function getValuesAdmin(){
	let name = $('#name').val().trim();
	let login = $('#login').val().trim();
	let password = $('#password').val();
	let confirm_password = $('#confirm_password').val();
	let active = $('#active').is(':checked') ? 'yes' : 'no';
	let access_level = $('#access_level').val();


	return{
		name:name,
		login:login,
		password:password,
		confirm_password:confirm_password,
		active:active,
		access_level:access_level
	}
}

function getAdminFields(){
	let name = $('#name');
	let login = $('#login');
	let password = $('#password');
	let confirm_password = $('#confirm_password');
	let active = $('#active');
	let access_level = $('#access_level');


	return{
		name:name,
		login:login,
		password:password,
		confirm_password:confirm_password,
		active:active,
		access_level:access_level
	}
}

function validateForm(edit = false){
	let error = false;

	//nome
	if(getValuesAdmin().name == ""){
		error = true;
		getAdminFields().name.addClass('is-invalid');
		getAdminFields().name.removeClass('is-valid');
	}else{
		getAdminFields().name.addClass('is-valid');
		getAdminFields().name.removeClass('is-invalid');
	}


	//email
	if(!validateEmail(getValuesAdmin().login)){
		error = true;
		getAdminFields().login.addClass('is-invalid');
		getAdminFields().login.removeClass('is-valid');
	}else{
		getAdminFields().login.addClass('is-valid');
		getAdminFields().login.removeClass('is-invalid');
	}

	let password = false;
	if(edit == false){
		password = errorPassword();
	}
	else{
		if(getValuesAdmin().password != "" || getValuesAdmin().confirm_password != ""){
			password = errorPassword();
		}else{
			getAdminFields().password.removeClass('is-invalid');
			getAdminFields().confirm_password.removeClass('is-invalid');
		}
	}


	if(error || password){
		return false;
	}

	return true;
}

function errorPassword(){
	let error = false;
	//senha
	if(getValuesAdmin().password.length < 6 ){
		error = true;
		getAdminFields().password.addClass('is-invalid');
		getAdminFields().password.removeClass('is-valid');
	}else {
		getAdminFields().password.addClass('is-valid');
		getAdminFields().password.removeClass('is-invalid');
	}

	//confirmação de senha
	if(getValuesAdmin().password != getValuesAdmin().confirm_password){
		error = true
		getAdminFields().confirm_password.addClass('is-invalid');
		getAdminFields().confirm_password.removeClass('is-valid');
	}else if(getValuesAdmin().password != ""){
		getAdminFields().confirm_password.addClass('is-valid');
		getAdminFields().confirm_password.removeClass('is-invalid');
	}

	if(error){
		return true;
	}

	return false;
}

function resetForm(){
	$('#form-admin').trigger('reset');
	getAdminFields().active.prop('checked',true).change();
	resetValidClasses();
}