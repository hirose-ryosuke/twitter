const { default: Axios } = require("axios");

new Vue({
	el: '#follower',
	filters: {
		moment: function (date) {
		    return moment(date).format('YYYY/MM/DD HH:mm:ss ')
		}
	},
	data:{
        followed:[],
	},
	methods:{
		followerData(){
			Axios.get('/followerData').then((res)=>{
				this.followed= res.data;
				console.log(this.followed);
			})
		},
		usersFollow(follower){
			Axios.post('/usersFollow/'+follower.id).then((res)=>{
				this.followerData()
			})
		},
		usersUnFollow(follower){
			Axios.delete('/usersUnFollow/'+follower.id).then((res)=>{
                this.followerData()
			})
		},
	},
	mounted(){
		console.log();
		this.followerData();
	}
});

