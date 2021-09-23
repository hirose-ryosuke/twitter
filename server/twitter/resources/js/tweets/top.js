const { default: Axios } = require("axios");

new Vue({
  el: '#tweet_top',
  data:{
    tweets:[],
    newTweet:'',
    tweet_id:''
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
    onButton(tweet){
        if(tweet.user_id == user_id){
          return true
        };
    },
    onLikeButton(tweet){
        if(tweet.user_id != user_id){
          return true
        };
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
