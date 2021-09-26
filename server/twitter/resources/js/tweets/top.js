const { default: Axios } = require("axios");

new Vue({
	el: '#tweet_top',
	filters: {
		moment: function (date) {
		return moment(date).format('YYYY/MM/DD HH:mm:ss ')
		}
	},
	data:{
		tweets:[],
		newTweet:'',
		tweet_id:'',
	},
	methods:{
		getData(){
			Axios.get('/getData').then((res)=>{
				this.tweets = res.data;
				console.log(this.tweets);
			})
		},
		addData(){
			this.tweets.push({
				tweet:this.newTweet
			})
			Axios.post('/addData',{
				tweet:this.newTweet
			}).then((res)=>{
				this.getData();
				this.newTweet = '';
			})
		},
		authCheck(tweet){
			return tweet.user_id == user_id ? true : false;
		},
		onLikeClick(tweet) {
			if(tweet.liked_by_user) {
				this.unlike(tweet)
			}
			else {
				this.like(tweet)
			}
		},
		//いいねボタン//
		like(tweet) {
			tweet.likes_count += 1
			tweet.liked_by_user = true
			Axios.put('/api/like/'+tweet.id).then((res)=>{
				this.getData();
			})
	},
		unlike(tweet) {
			Axios.delete('/api/unlike').then((res)=>{
				tweet.likes_count -= 1
				tweet.liked_by_user = false
				this.getData();
			})
	},
		deleteData(tweet){
			Axios.post('/deleteData/'+tweet.id).then((res)=>{
				this.tweets.splice(this.tweets.indexOf(tweet),1);
			})
		},
	},
	mounted(){
		console.log();
		this.getData();
	}
});

