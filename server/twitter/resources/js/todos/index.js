const { default: Axios } = require("axios");

new Vue({
  el: '#todo_list',
  data:{
    id:'',
    todos:[],
    newBody:[],
    updateBody: '',
    updateId:'',

  },
  methods:{
    onClick(){
      this.id += 1;
    },
    getData(){
      Axios.get('/getData').then((res)=>{
        // console.log(res.data);
        this.todos = res.data;
        console.log(this.todos);
      })
    },
    addData(){
      //追加ボタンでtodosに仮でコメントを追加//
      this.todos.push({
        body:this.newBody,
      })
      //上と同じものをルーティングでTodosController.addDataへ//
      //TodosController.addDataでtodosTableへ新規データとして登録する//
      Axios.post('/addData',{
        body:this.newBody
      })
      //TodosController.addDataの処理が終わり、ログへ書き込まれる//
      .then((response)=>{
        console.log(response);
        this.newBody=''
      })
      
    },
    deleteData(todo){
      //削除ボタンで削除したい投稿のID取得//
      //取得したIDをURLに載せてTodosController.deleteDataへ送りtodosTableから削除//
      Axios.post('/deleteData/'+todo.id).then((res)=>{
        this.todos.splice(this.todos.indexOf(todo), 1);
      })
    },
    updateData(todo,index){
      Axios.post('/editData/'+todo.id,{
        body:this.updateBody
      }).then((res)=>{
        this.getData();
        this.updateBody=''
      })
    }
    
  },
  mounted(){
    console.log();
    this.getData()
  }
});
