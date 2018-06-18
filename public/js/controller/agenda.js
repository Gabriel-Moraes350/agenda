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

