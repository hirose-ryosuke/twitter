const { default: Axios } = require("axios");

new Vue({
  el: '#todo_list',
  data:{
    id:1,
    todos:[],
    newBody:''
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
      this.todos.push({
        body:this.newBody
      })
      Axios.post('/addData',{
        body:this.newBody
      })
      .then((response)=>{
        console.log(response);
        this.getData(res.data);
      })
      this.newBody = '';
    }
  },
  mounted(){
    console.log('mounted')
    this.getData()
  },
});
