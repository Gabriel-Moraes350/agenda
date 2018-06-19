
//função para validar formulário
function formValidation(user){

	let error = false;

	if(user.name.trim() == ""){
		returnFields().name.addClass('is-invalid');
		returnFields().name.removeClass('is-valid');
		error = true;
	}else{
		returnFields().name.addClass('is-valid');
		returnFields().name.removeClass('is-invalid');
	}


	if(user.phone[0].length < 11){
		returnFields().phone1.addClass('is-invalid');
		returnFields().phone1.removeClass('is-valid');
		error = true;
	}else{
		returnFields().phone1.addClass('is-valid');
		returnFields().phone1.removeClass('is-invalid');
	}

	if(user.email.trim() != ""){
		if(validateEmail(user.email)){
			returnFields().email.addClass('is-valid');
			returnFields().email.removeClass('is-invalid');
		}else{
			returnFields().email.addClass('is-invalid');
			returnFields().email.removeClass('is-valid');
			error = true;
		}
	}

	$.each($('.phone-secundary'), function(index, phones) {

		let phone = $(phones).cleanVal();
		 if(phone.trim() != "" ){
		 	if(phone.length < 11){
		 		$(phones).addClass('is-invalid');
		 		$(phones).removeClass('is-valid');
		 		error = true;
		 	}else{
		 		$(phones).addClass('is-valid');
		 		$(phones).removeClass('is-invalid');
		 	}
		 	
		 }else if($(phones).hasClass('is-invalid')){
		 	$(phones).removeClass('is-invalid');
		 	$(phones).removeClass('is-valid');
		 }
	});

	if(error){
		return false;
	}

	return true;
}

//função que pega valores nos campos
function returnValueFields(){
	var name = $('#name').val();
	var email = $('#email').val();
	var info = $('#info').val();
	var address = $('#address').val();
	var phone1 = $('#phone-1').cleanVal();
	var phone2 = $('#phone-2').cleanVal();
	var phone3 = $('#phone-3').cleanVal();

	return {
		name:name,
		email:email,
		info:info,
		address:address,
		phone1:phone1,
		phone2:phone2,
		phone3:phone3
	}
}

//função que os campos
function returnFields(){
	var name = $('#name');
	var email = $('#email');
	var info = $('#info');
	var address = $('#address');
	var phone1 = $('#phone-1');
	var phone2 = $('#phone-2');
	var phone3 = $('#phone-3');

	return {
		name:name,
		email:email,
		info:info,
		address:address,
		phone1:phone1,
		phone2:phone2,
		phone3:phone3
	}
}


function returnFile(){
	return $('#picture-file');
}

function resetForm(){
	$('#form-contact').trigger('reset');
	
	resetValidClasses();
	//reseta imagem
	$('#image-preview').attr('src',DEFAULT_USER_IMAGE);
	$('#close-btn').attr('hidden',true);
}



function maskPhones(){
	//mask on phone
	$('#phone-1').mask('(00) 00000-0000');
	$('#phone-2').mask('(00) 00000-0000');
	$('#phone-3').mask('(00) 00000-0000');
}
