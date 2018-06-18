$(window).on('load',function(){

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

	//quando envia formulário
	$('#form-contact').on('submit',function(e){

		e.preventDefault();
		e.stopPropagation();
		let data = {
			id:null,
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
			url: '/user/new',
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
				swal("Novo contato inserido", obj.message, "success");
				resetForm();
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
				swal("Novo contato inserido", obj.message, "success");
			})
			.fail(function() {
				swal("Erro ao salvar imagem","Contato salvo, porém imagem não pode ser salva","warning");
			})
			.always(function() {
				resetForm();
			});
			
		})
		.fail(function(obj) {
			swal("Erro", obj.message, "error");
		})
		.always(function() {
			$('.main').unblock();
		});
		
	});

});
