<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Task;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {

        return view('home');
    }

    public function TareasActivas () {
        return Task::where('realizada', 0)->orderBy('id', 'desc')->get();
    }
    public function TareasCompletas(){
        return Task::where('realizada',1)->orderBy('id','desc')->get();
    }

    public function CrearTarea (Request $request){
        $validator = Validator::make($request->all(),[
            'tarea' => 'required|max:100'
        ],[
            'required' => 'No puede estar vacío',
            'max' => 'El valor máximo permitido es :max',
        ]);

    
        if ($validator->fails()) {          
            return response()->json(['success' => false,'message' => $validator->messages()], 422);
        }else {
            return Task::create(['tarea' => request('tarea')]);
        }
       
  

    }
    public function EditarTarea(Request $request) {
        $this->validate($request,[
            'tarea' =>'required|max:100'
        ]);
        $tarea = Task::findOrFail($request->id);
        $tarea->tarea = $request->tarea;
        $tarea->save();
    }

    public function Borrar_Tarea ($id){
        $tarea = Task::findOrFail($id);
        $tarea->delete();

    }

    public function CompletarTareas($id){
        $task = Task::findOrFail($id);
        $task->realizada = ! $task->realizada;
        $task->save();
    }
}
