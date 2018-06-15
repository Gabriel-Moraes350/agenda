class User{
	
	constructor(data){
		this.id = data.id;
		this.name = data.name;
		this.info = data.info;
		this.address = data.address;
		this.email = data.email
	}

	getId(){
		return this.id
	}
}