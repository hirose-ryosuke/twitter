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
      // console.log(tweet.user_id);
      // console.log(user_id);
      // console.log(tweet.isActive);

      Axios.post('/onButton').then((res)=>{
        if(tweet.user_id == user_id){
          return tweet.isActive = true
        };
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
