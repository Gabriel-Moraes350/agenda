class Admin{
	constructor(data){
		this.id = (data.id != null ? data.id : null);
		this.name = data.name;
		this.login = data.login;
		this.access_level = data.access_level;
		this.active = data.active;

	}

	getAccessLevel(){
		if(this.access_level == 1){
			return 'Master';
		}
		return 'Analista';
	}

	getActive(){
		if(this.active == 'yes'){
			return 'text-success';
		}

		return 'text-danger';
	}
}