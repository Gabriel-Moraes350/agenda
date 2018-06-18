$(window).on('load',function(){
	callListApi();

	$(document).on('click','#delete-admin',function(e){
		e.preventDefault();
		var id = $(this).closest('[admin-id]').attr('admin-id');
		var cell = $(this);

		swal({
		  title: "Excluir",
		  text: "Você tem certeza que deseja excluir o administrador?",
		  icon: "warning",
		  buttons:{
			   cancel: {
			    text: "Cancelar",
			    value: false,
			    visible: true,
			    className: "",
			    closeModal: true,
			  },
			  confirm: {
			    text: "OK",
			    value: true,
			    visible: true,
			    className: "",
			    closeModal: true
			  }
			},
		  dangerMode: true,
		  
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	$.blockUI({
				message:$('#preloader').html()
			});

			$.ajax({
				url: '/admin/remove',
				type: 'POST',
				dataType: 'JSON',
				data: {id:id},
			})
			.done(function(obj) {
				if(obj.error === true){
					alertify.error(obj.message);
					return;
				}

				alertify.success(obj.message);
				cell.closest('tr').remove();
			})
			.fail(function() {
				alertify.error('Ocorreu um error');
				
			})
			.always(function() {
				$.unblockUI();
			});



		  }
		});

		
		
	});

	//busca ao tempo que se digita
	var searchContact;
	$('#search').on('keydown',function(e){
		 clearTimeout(searchContact);
		var string = $('#search').val();

		searchContact = setTimeout(function(){
			callListApi(1,string);
		},500);
	});


	//busca quando clica em buscar
	$('[search-btn]').click(function(e){
		e.preventDefault();
		callListApi(1,$('#search').val());
	});
	
});

var adminId = $('[admin-access]').attr('admin-access');
var totalPages;
var currentPage = 1;

function callListApi(page = 1,keyword = null){
	$.blockUI({
		message:$('#preloader').html()
	});

	var url = '/admin?page=' + page;

	if(keyword != null && keyword != ""){
		url = 'admin/search?page=' + page + '&query=' + keyword;
	}
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(obj) {
		if(obj.error === true){
			alertify.error('Ocorreu um erro');
			setTimeout(function(){
				window.location.href = '/admin';
			},2000);
			return;
		}
		populateTable(obj.data.data);

		totalPages = obj.data.last_page;
        currentPage = obj.data.current_page;
		$('#pagination').twbsPagination('destroy');
		var defaultOps = {
            visiblePages:5,
             
            next:'Próximo',
            prev:'Anterior',  
            first:'Primeiro',
            last:'Último',
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                callListApi(page,keyword);
            }
        };

      	$('#pagination').twbsPagination($.extend({},defaultOps,{
          totalPages:totalPages,
          startPage:obj.data.current_page
        }));
		
	})
	.fail(function() {
		alertify.error('Ocorreu um erro');

		setTimeout(function(){
			window.location.href = '/admin';
		},2000);
	})
	.always(function() {
		$.unblockUI();
	});
	
}

function populateTable(data){
	var string = '';

	if(data.length == 0 ){
		string += '<p class="text-center text-info h2">Sem Administradores</p>';
		$('#list-content').html(string);
		 return;
	}

	string += '<table class="table table-hover bg-dark text-white ">'+
		'<thead>'+
		'<tr>'+
		'<th width="5%" scope="col">Status</th>'+
		'<th width="30%" scope="col">Nome</th>'+
		'<th width="33%" scope="col">Email</th>'+
		' <th width="20%" scope="col">Nível</th>'+
		'<th scope="col" width="12%"></th>'+
		'</tr>'+
		' </thead>'+
		'<tbody>';

	$.each(data, function(index, adminApi) {
		 let admin = new Admin(adminApi);
		
		string += '<tr>'+
		'<th scope="row" class="align-middle"><i class="fas fa-circle text-center d-block '+(admin.getActive())+'"></i></th>'+
		' <td>'+admin.name+'</td>'+
		'<td>'+admin.login+'</td>'+
		'<td>'+admin.getAccessLevel()+'</td>';
		if(adminId == admin.id){
			string += ' <td class="align-middle"><span class="d-flex justify-content-between "><i id="edit-profile" class="far fa-edit icon"></span></td>';
		}else{
			string +=' <td class="align-middle" admin-id="'+admin.id+'"><span class="d-flex justify-content-between "><i id="edit-admin" class="far fa-edit icon"></i><i id="delete-admin" class="far fa-trash-alt icon"></i></span></td>';
		}
		
		string +=' </tr>';
	});

	string += '</tbody>'+
		'</table><ul id="pagination" class="pagination-sm"></ul>';	
	
	$('#list-content').html(string);
}