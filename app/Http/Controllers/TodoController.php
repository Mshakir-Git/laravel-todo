<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
   public function addTodo(Request $req){
       if($req->id=="new"){
       $newTodo=new Todo;
       $newTodo->title=$req->title;
       $newTodo->details=$req->details;
       $newTodo->state=$req->state;
       $newTodo->save();
       } else{ //edit
        $todo=Todo::where('id',$req->id)->first();
        $todo->timestamps =false;
        $todo->state=$req->state;
        $todo->title=$req->title;
        $todo->details=$req->details;
        $todo->save();
       }
       return redirect("/");
   }
   public function changeTodoState(Request $req){
    $todo=Todo::where('id',$req->id)->first();
    $todo->state=$req->state;
    $todo->save();
    return True;
    }
    public function deleteTodo(Request $req){
        $todo=Todo::where('id',$req->id)->first();
        $todo->delete();
        return True;
    }

   public function show(){
       $todo=Todo::where('state','todo')->orderBy('updated_at','desc')->get();
       $doing=Todo::where('state','doing')->orderBy('updated_at','desc')->get();
       $done=Todo::where('state','done')->orderBy('updated_at','desc')->get();

       return view("welcome")->with("data",["todo"=>$todo,"doing"=>$doing,"done"=>$done]);
   }

}
