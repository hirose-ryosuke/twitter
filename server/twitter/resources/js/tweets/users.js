const { default: Axios } = require("axios");

new Vue({
	el: '#users',
	filters: {
		moment: function (date) {
            return moment(date).format('YYYY/MM/DD HH:mm:ss')
		}
	},
	data:{
        users:[],
        followCount:'',
        res_follow:'',
	},
	methods:{
		usersData(){
			Axios.get('/usersData').then((res)=>{
				this.users = res.data;
				console.log(this.users);
			})
		},
		usersFollow(user){
			Axios.post('/usersFollow/'+user.id).then((res)=>{
				this.usersData()
			})
		},
		usersUnFollow(user){
			Axios.delete('/usersUnFollow/'+user.id).then((res)=>{
                this.usersData()
			})
		},
	},
	mounted(){
		console.log();
		this.usersData();
	}
});

