<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index',compact('todos'));
    }
    public function addData(Request $request) {
    
        $todo = new Todo();
        $todo->body = $request->body;
        $todo->save();
        return response()->json($todo);
    }
    public function destroy(todo $todo) {
        $todo->delete();
        return redirect('/todos');
    }
    public function edit(todo $todo) {
        return view('todos.index2')->with('todo',$todo);
    }
    public function update(Request $request,todo $todo) {
        $todo->body = $request->body;
        $todo->save();
        return redirect('/todos');
    }
    public function data() {
        $data = todo::all();

        return response()->json($data);
    }

    
}
