const IMAGE_FOLDER = '/image/';
const DEFAULT_USER_IMAGE = '/img/default-user.png';
const EDIT_USER = '/editar-contato?contato=';
const USER_PARAM = 'contato';

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function getValueUrl(param){
	var url = new URL(window.location.href);
	var c = url.searchParams.get(param);

	return c;
}
function resetValidClasses(){
	$.each($('.is-valid'), function(index, val) {
		 $(val).removeClass('is-valid');
	});

	$.each($('.is-invalid'), function(index, val) {
		 $(val).removeClass('is-invalid');
	});
}
$('#logout').click(function(e){
	e.preventDefault();
	swal({
	title: "Sair",
		  text: "Você tem certeza que deseja sair? ://",
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
			    text: "Confirmar",
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
		  	window.location.href = '/logout';
		  }
		});
});
