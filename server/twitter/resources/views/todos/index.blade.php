@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:50px;" id="todo_list">
  <h1>Todoリスト追加</h1>

  <div class="form-group">
    <label >やることを追加してください</label>
    <input type="text" name="body"class="form-control" placeholder="todo list" style="max-width:1000px;" v-model="newBody">
  </div>
  <button type="submit" class="btn btn-primary" @click="addData">追加する</button>
  <!-- <div>@{{id}}</div>
  <button @click="onClick">button</button>
  <button @click="getData">data</button>
  <div v-for="todo in todos " :key="todos.id">
    <div>@{{todo.id}}</div>
    <div>@{{todo.body}}</div>
  </div> -->

    <h1 style="margin-top:50px;">Todoリスト</h1>
    <div v-for="(todo,index) in todos " :key="todo.id" value="index">
      <table class="table table-striped" style="max-width:1000px; margin-top:20px;">
          <tr>
            <td>@{{todo.body}}</td>
            <td>
                <button type="submit" class="btn btn-primary" @click="todo.isActive = !todo.isActive">編集</button></td>
            <td><input type="text" v-model="updateBody" v-show="todo.isActive" value="index"></td>
            <td><button @click="updateData(todo,index),todo.isActive = !todo.isActive" v-show="todo.isActive" >完了</button></td>
            
            <td>
            <!-- 削除ボタン -->
                <button type="submit" class="btn btn-danger" @click="deleteData(todo)">削除</button>
            </td>
          </tr>
      </table>
    </div>
</div>
<script src="{{ asset('js/index.js') }}" defer></script>
@endsection
