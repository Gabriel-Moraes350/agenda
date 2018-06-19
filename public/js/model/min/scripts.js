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
class User{
	
	constructor(data){
		this.id = data.id != null ? data.id : null;
		this.name = data.name;
		this.info = data.info;
		this.image = data.image;
		this.address = data.address;
		this.email = data.email;
		this.phone = data.user_phones;
	}

	getId(){
		return this.id
	}

	getName(){
		return this.name;
	}

	getInfo(){
		return this.info;
	}

	getAddress(){
		return this.address;
	}

	getEmail(){
		return this.email;
	}

	getImage(){
		return this.image;
	}

	getPhone(){
		return this.phone;
	}

	setId(value){
		this.id = value;
	}

	setName(value){
		this.name = value;
	}

	setImage(value){
		this.image = value;
	}

	setInfo(value){
		this.info = value;
	}

	setAddress(value){
		this.address = value;
	}

	setEmail(value){
		this.email = value;
	}

	setPhone(phone){
		let userPhone = new UserPhone(phone);
		this.phone.push(userPhone);
	}

	getValues(){
		return {
			id:this.id,
			name:this.name,
			email:this.email,
			address:this.address,
			info:this.info,
			phone:this.phone.filter(function(phone,index){
				return phone.trim() != "";
			})
		}
	}


}
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