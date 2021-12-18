<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
    * Validator request
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'property_id' => ['required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name, $id, $purpose, $status)
    {
      return view('app',['property'=>['name'=>$name, 'id'=>$id, 'purpose'=>$purpose, 'status'=>$status],'status'=>200]);//response() -> json(['status' => 200, 'tasks' => $tasks]);
    }

    /**
    * Get a list of tasks by Property
    *@param int $property_id
    * @return json $tasks
    */
    public function getTasksByProperty(int $property_id):object
    {
      $tasks = Task::where('property_id',$property_id)->orderBy('updated_at', 'DESC')->get();
      if (count($tasks)==0) {
        $tasks=array(['id'=>0,'name'=>'','date'=>'','description'=>'','property_id'=>$property_id]);
        return response()->json($tasks);
      }

      return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):object
    {
      $this->validator($request->all())->validate();
      $newTask = new Task();
      $newTask->name=$request->name;
      $newTask->description=$request->description;
      $newTask->date=$request->date;
      $newTask->property_id=$request->property_id['property_id'];
      $newTask->save();
          return response()->json($newTask);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(int $task)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $task)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $task):object
    {
      $tasks = Task::find($task);
      if($tasks -> delete()){
          return response()->json(["tasks"=>$tasks,"status" => 200]);
      }
    }
}
