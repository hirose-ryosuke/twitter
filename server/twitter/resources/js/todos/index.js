const { default: Axios } = require("axios");

new Vue({
  el: '#todo_list',
  data:{
    id:1,
    todos:[],
    newBody:[],
    showEdit: false,
    editBody: ''
  },
  methods:{
    onClick(){
      this.id += 1;
    },
    getData(){
      Axios.get('/getdata').then((res)=>{
        console.log(res.data);
        this.todos = res.data;
      })
    },
    addData(){
      //追加ボタンでtodosに仮でコメントを追加//
      this.todos.push({
        body:this.newBody
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
    showEditTask() {
      // タスク編集欄が非表示なら表示させる
      if (this.showEdit === false) {
        this.showEdit = true;
      // タスク編集欄が表示中なら非表示にする
      } else if (this.showEdit === true) {
        this.showEdit = false;
      }
    },
    // タスク編集メソッド
    editData(todo) {
      if (this.editBody === '') {
        alert('タスクを入力してください');
        return
      }
      // どのテーブルを編集するか絞り込む
      Axios.put('/editData/'+todo.id).then((res)=>{
        this.todos.update(this.todos.indexOf(todo), 1);
      })
      // タスク入力後、inputを空にする
      this.editBody = '';
    }
  },
  mounted(){
    console.log('mounted')
    this.getData()
  }
});
