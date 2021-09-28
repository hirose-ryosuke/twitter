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
		favorites:[],
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
		favoriteData(){
			Axios.get('/favoriteData').then((res)=>{
				this.favorites = res.data;
				console.log(this.favorites);
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
		//お気に入りボタン//
		onLikeClick(tweet) {
			if(tweet.liked_by_user) {
				this.unlike(tweet)
			}
			else {
				this.like(tweet)
			}
		},
		//お気に入り付与//
		like(tweet) {
			Axios.put('/api/like/'+tweet.id).then((res)=>{
				tweet.likes_count += 1
			})
	},
	//お気に入り削除//
		unlike(tweet) {
			Axios.delete('/api/unlike/'+tweet.id).then((res)=>{
				tweet.likes_count -= 1
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
		this.favoriteData();
	}
});

