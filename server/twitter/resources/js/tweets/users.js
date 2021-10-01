const { default: Axios } = require("axios");

new Vue({
	el: '#users',
	filters: {
		moment: function (date) {
		    return moment(date).format('YYYY/MM/DD HH:mm:ss ')
		}
	},
	data:{
        users:[],
        followCount:'',
	},
	methods:{
		usersData(){
			Axios.get('/usersData').then((res)=>{
				this.users = res.data;
				console.log(this.users);
			})
		},
        showButton(user){
            Axios.get('/usersIsFollow/'+user.id).then((res)=>{
                if(res.data == false){
                    return user.isActive == true;
                }
			})
        },
		usersFollow(user){
			Axios.post('/usersFollow/'+user.id).then((res)=>{
				this.usersData()
                return user.isActive=true
			})
		},
		usersUnFollow(user){
			Axios.delete('/usersUnFollow/'+user.id).then((res)=>{
                this.usersData()
                return false
			})
		},
	},
	mounted(){
		console.log();
		this.usersData();
	}
});

