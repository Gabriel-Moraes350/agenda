$(window).on('load',function(){

	var userApi;

	callUserApi(userApi);

	maskPhones();
	//criar um click quando se clica na imagem
	$('#image-preview').click(function(){
		returnFile().trigger('click');
	});

	//quando se adicionar imagem
	returnFile().change(function(){
		let image = $('#image-preview');
		let upload = $(this);
		let file = this.files[0];
		let reader = new FileReader();

		reader.onload = function(e){
			image.attr('src',e.target.result);
			$('#close-btn').attr('hidden',false);

			//função para reconhecer click no botão de fechar
			$('#close-btn').click(function(e){
				e.preventDefault();
				$(upload).val('');
				image.attr('src',DEFAULT_USER_IMAGE);
				$(this).attr('hidden',true);
			});
		}

		reader.readAsDataURL(file);
	});

	$(document).on('click','#close-btn',function(e){
		e.preventDefault();
		if(imageFromApi === true){
			$.ajax({
				url: '/user/remove-image/',
				type: 'POST',
				dataType: 'JSON',
				data: {id:userId},
			})
			.done(function(obj) {
				if(obj.error === true){
					swal("Erro",obj.message,"error");
					return;
				}
				swal("Sucesso",obj.message,"success");
				resetImage();
			})
			.fail(function(obj) {
				swal("Erro",obj.message,"error");
			})
			.always(function() {
				
			});
			
		}
	});

	//quando envia formulário
	$('#form-contact').on('submit',function(e){

		e.preventDefault();
		e.stopPropagation();
		let data = {
			id:userId,
			name:returnValueFields().name,
			email:returnValueFields().email,
			info:returnValueFields().info,
			address:returnValueFields().address,
			user_phones:[returnValueFields().phone1,returnValueFields().phone2,returnValueFields().phone3]
		}

		let user = new User(data);

		if(!formValidation(user)){
			return;
		}

		let userApi = user.getValues();
		$('.main').block({ 
	        message: $('#preloader').html(), 
	    }); 
		$.ajax({
			url: '/user/edit',
			type: 'POST',
			dataType: 'JSON',
			data: userApi,
		})
		.done(function(obj) {

			if(obj.error === true){
				swal("Erro", obj.message, "error");
				return;
			}

			let id = obj.data.id;
			let file = returnFile();


			if(file.val() == ""){
				swal("Sucesso", obj.message, "success");
				
				return
			}

			var formData = new FormData();
			formData.append("picture",file[0].files[0]);
			$.ajax({
				url: '/user/image?id='+id,
				type: 'POST',
				dataType: 'json',
				processData:false,
				contentType:false,
				data: formData,
			})
			.done(function(obj) {				
				if(obj.error === true){
					swal("Erro ao salvar imagem","Contato salvo, porém imagem não pode ser salva","warning");
					return;
				}
				swal("Sucesso", obj.message, "success");
				file.val('');
				imageFromApi = true;
			})
			.fail(function() {
				swal("Erro ao salvar imagem","Contato salvo, porém imagem não pode ser salva","warning");
			})
			.always(function() {
				
			});
			
		})
		.fail(function(obj) {
			swal("Erro", obj.message, "error");
		})
		.always(function() {
			$('.main').unblock();
			resetValidClasses();
		});
		
	});

});
var userId;
var imageFromApi = false;

//busca contato selecionado
function callUserApi(user){
	$.blockUI({
		message:$("#preloader").html()
	});
	$.ajax({
		url: '/user/get?id=' + getValueUrl(USER_PARAM),
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(obj) {
		user = new User(obj.data);
		userId = user.id;
		insertFields(user);
		
		
	})
	.fail(function() {
		window.location.href = '/';
	})
	.always(function() {
		$.unblockUI();
	});
	
}

//função para inserir valor nos campos do contato
function insertFields(user){
	returnFields().name.val(user.name);
	returnFields().email.val(user.email);
	returnFields().address.val(user.address);
	returnFields().info.val(user.info);
	$.each(user.phone, function(index, phone) {
		if(index == 0){
			returnFields().phone1.val(phone.phone);
		}else if(index == 1){
			returnFields().phone2.val(phone.phone);
		}else if(index == 2){
			returnFields().phone3.val(phone.phone);
		}
	});

	if(user.image != null && user.image != ""){
		$('#image-preview').attr('src',IMAGE_FOLDER + user.image);
		$('#close-btn').attr('hidden',false);
		imageFromApi = true;
	}
}

function resetImage(){
	$('#image-preview').attr('src',DEFAULT_USER_IMAGE);
	$('#close-btn').attr('hidden',true);
	imageFromApi = false;
}