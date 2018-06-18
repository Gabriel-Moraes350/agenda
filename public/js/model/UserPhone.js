class UserPhone{
	constructor(data){
		this.id = (data.id != null ? data.id : null);
		this.phone = data.phone;
		this.user_id = data.user_id;
	}


	getId(){
		return this.id;
	}

	getUserId(){
		return this.user_id;
	}

	getPhone(){
		return this.phone;
	}

	setId(value){
		this.id = value;
	}

	setPhone(value){
		this.phone = value;
	}

	setUserId(value){
		this.user_id = value;
	}
}