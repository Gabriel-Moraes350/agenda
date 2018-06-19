$(window).on('load',function(){

	
	//click para remover contato
	$(document).on('click','[remove-contact]',function(){
		var reference  = this;
		swal({
		  title: "Excluir",
		  text: "Você tem certeza que deseja excluir o contato?",
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
		  	$.ajax({
		  		url: '/user/remove',
		  		type: 'POST',
		  		dataType: 'JSON',
		  		data: {id: $(this).attr('user-id')},
		  	})
		  	.done(function(obj) {
		  		 swal(obj.message, {
			      icon: "success",
			    });
	  		 	$(reference).closest('.card').remove();
		  	})
		  	.fail(function() {
		  		console.log("error");
		  	})
		  	.always(function() {
		  		console.log("complete");
		  	});
		  	
		  } 
		});
	});

	$(document).on('click','[edit-contact]',function(){
		var id = $(this).attr('user-id');

		window.location.href = EDIT_USER + id;
	});

	//busca ao tempo que se digita
	var searchContact;
	$('#search').on('keydown',function(e){
		 clearTimeout(searchContact);
		var string = $('#search').val();

		searchContact = setTimeout(function(){
			list(1,string);
		},500);
	});


	//busca quando clica em buscar
	$('[search-btn]').click(function(e){
		e.preventDefault();
		list(1,$('#search').val());
	});

	list();

});

//variáveis para paginação
var currentPage = 1;
var totalPages;

//função para listagem
function list(page = 1,keyword = null){
	
	$('.main__grid').block({ 
        message: $('#preloader').html(), 
        
    }); 

	var url = '/user?page='+ page;

	if(keyword != null ){
		url = '/user/search?page='+ page;
	}

	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'JSON',
		data: {query:keyword },
	})
	.done(function(obj) {
		populateListHtml(obj.data);
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
                list(page,keyword);
            }
        };

      	$('#pagination').twbsPagination($.extend({},defaultOps,{
          totalPages:totalPages,
          startPage:obj.data.current_page
        }));
       
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
		$('.main__grid').unblock(); 
	});

}

//popula o html
function populateListHtml(obj){
	var string = '';
	$.each(obj.data, function(index, userOb) {
		let user = new User(userOb);
	
		string += '<div class="card">'+
		'<div class="card-header" id="heading'+index+'">'+
		'   <h5 class="mb-0">'+
		'     <img src="'+(user.getImage() != null ? IMAGE_FOLDER + user.getImage() :DEFAULT_USER_IMAGE)+'" class="img-round" alt="">'+
		'     <button class="btn btn-link collapsed text-truncate" data-toggle="collapse" data-target="#collapse'+index+'" aria-expanded="false" aria-controls="collapse'+index+'">'+
		user.getName()+
		'     </button>'+
		'      <i class="fas fa-trash btn-attr" user-id="'+user.getId()+'" remove-contact></i>'+
		'                            '+
		'      <i class="fas fa-edit btn-attr" user-id="'+user.getId()+'" edit-contact></i>'+
		'   </h5>'+
		' </div>'+
		''+
		'<div id="collapse'+index+'" class="collapse" aria-labelledby="heading'+index+'" data-parent="#accordion" style="">'+
		''+
		'<div class="card-body ">'+
		'<div class="table-responsive">'+
		'<table class="table " user-phone>'+
		'<thead>'+
		'<tr>'+
		'<th scope="col" style="width:33.3%">1* número</th>'+
		' <th scope="col" style="width:33.3%">2* número</th>'+
		'<th scope="col" style="width:33.3%">3* número</th>'+
		'</tr>'+
		'</thead>'+
		'<tbody>'+
		'<tr>'+
		' <td>'+(user.getPhone()[0] != null ?"(" + user.getPhone()[0].phone.substr(0,2) + ")" + user.getPhone()[0].phone.substr(2,11) : "")+'</td>'+
		'<td>'+(user.getPhone()[1] != null ?"(" + user.getPhone()[1].phone.substr(0,2) + ")" + user.getPhone()[1].phone.substr(2,11) : "")+'</td>'+
		'<td>'+(user.getPhone()[2] != null ?"(" + user.getPhone()[2].phone.substr(0,2) + ")" + user.getPhone()[2].phone.substr(2,11) : "")+'</td>'+
		'</tr>'+
		' </tbody>'+
		'</table>'+
		'</div>'+
		' <p><strong>Email: </strong><span>'+(user.email != null ? user.email : "Não informado")+'</span></p>'+
		' <p><strong>Endereço: </strong><span>'+(user.address != null && user.address != "" ? user.address : "Não informado")+'</span></p>'+
		' <p><strong>Informações: </strong><span>'+(user.info != null && user.info != "" ? user.info : "Não informado")+'</span></p>'+
		' </div>'+
		'</div>'+
		'</div>';
	});
		
	string += '<ul id="pagination" class="pagination-sm"></ul>';

	if(obj.data.length == 0){
		string = '<h3 class="text-center text-info">Sem nenhum contato</h3>';
	}


	$('#accordion').html(string);

}
