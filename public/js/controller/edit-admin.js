$(window).on('load',function(){
	$('#form-admin').submit(function(e){
		e.preventDefault();

		if(!validateForm(true)){
			return;
		}

		$.blockUI({
			message:$('#preloader').html()
		});
		$.ajax({
			url: '/admin/edit?id=' + adminId,
			type: 'POST',
			dataType: 'JSON',
			data:getValuesAdmin(),
		})
		.done(function(obj) {
			resetValidClasses();
			
			if(obj.error == true){
				alertify.error(obj.message);
				return;
			}

			alertify.success(obj.message);

		})
		.fail(function() {
			alertify.error('Ocorreu um erro ao salvar o administrador');
		})
		.always(function() {
			$.unblockUI();
		});
		

	});
});

var adminId = $('[admin-cod]').attr('admin-cod');