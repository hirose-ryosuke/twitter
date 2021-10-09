const { default: Axios } = require("axios");

new Vue({
	el: '#follow',
	filters: {
		moment: function (date) {
		    return moment(date).format('YYYY/MM/DD HH:mm:ss ')
		}
	},
	data:{
        follows:[],
	},
	methods:{
		followsData(){
			Axios.get('/followsData').then((res)=>{
				this.follows = res.data;
				console.log(this.follows);
			})
		},
		usersFollow(follow){
			Axios.post('/usersFollow/'+follow.id).then((res)=>{
				this.followsData()
			})
		},
		usersUnFollow(follow){
			Axios.delete('/usersUnFollow/'+follow.id).then((res)=>{
                this.followsData()
			})
		},
	},
	mounted(){
		console.log();
		this.followsData();
	}
});

