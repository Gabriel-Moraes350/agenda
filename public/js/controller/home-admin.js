$(window).on('load',function(){
	callInfo();
});

function callInfo(){
	$.blockUI({
		message:$('#preloader').html()
	});
	$.ajax({
		url: '/admin/overview',
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(obj) {
		if(obj.error === true){
			alertify.error('Ocorreu um erro');
			setTimeout(function(){
				window.location.href = '/';
			}, 2000);
		}
		populateInfo(obj.data);
	})
	.fail(function() {
		alertify.error('Ocorreu um erro');
		setTimeout(function(){
			window.location.href = '/';
		}, 2000);
		
	})
	.always(function() {
		$.unblockUI();
	});
	
}

function populateInfo(data){
	getFields().phone.text(data.total_phone);
	getFields().contact.text(data.count_user);

	let ctx = $('#chart');

	let dataChart = {
		labels:['Um telefone','Dois telefones','Três telefones'],
		datasets:[{
			label:'Quantida de telefones por usuário',
			data:[data.one_phone,data.two_phone,data.three_phone],
			backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
               
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                
            ],
            borderWidth: 1
		}],

	};
		
		

	var myPieChart = new Chart(ctx,{
	    type: 'pie',
	    data: dataChart,
	    options:{
	    	title: {
	            display: true,
	            text: 'Quantidade de telefone por contato',
	            fontSize:'16',
	            fontColor:'#17a2b8'
	        }
	    }
	});
}

function getFields(){
	let contact = $('#qtd-contact');
	let phone = $('#qtd-phone');

	return {
		contact:contact,
		phone:phone
	}
}

