$(window).on('load',function(){
	$('#form-admin').submit(function(e){
		e.preventDefault();
		if(!validateForm()){
			return;
		}

		$.blockUI({
			message:$('#preloader').html()
		});

		$.ajax({
			url: '/admin/new',
			type: 'POST',
			dataType: 'JSON',
			data: getValuesAdmin(),
		})
		.done(function(obj) {
			if(obj.error === true){
				alertify.error(obj.message);
				resetValidClasses();
				return;
			}
			alertify.success(obj.message);
			resetForm();
		})
		.fail(function() {
			alertify.error('Ocorreu um erro para criar um administrador');
		})
		.always(function() {
			$.unblockUI();
		});
		
	});
});

