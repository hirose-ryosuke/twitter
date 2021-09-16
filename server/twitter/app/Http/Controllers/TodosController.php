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
        $todo->body = $request->body ;
        $todo->save();
        return response()->json($todo);
    }

    public function deleteData($id,todo $todo) {
        $todo = Todo::find($id)->delete();
        return response()->json($todo);
    }

    public function editData(Request $request,$id) {
        $update = Todo::where('id', $request->id)->update([
            'body' => $request->body,
        ]);
        return response()->json($update);
    }

    public function update(Request $request,todo $todo) {
        $todo->body = $request->body;
        $todo->save();
        return redirect('/todos');
    }
    
    public function data() {
        $todo = Todo::all();
        
        return response()->json($todo);
    }

    
}
