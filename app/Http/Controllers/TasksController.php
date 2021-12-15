<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks = Task::orderBy('updated_at', 'DESC')->get();
      return response() -> json(['status' => 200, 'tasks' => $tasks]);
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
    public function store(Request $request)
    {
      $newTask = Task::create([
          'name' => $request->name,
          'description' => $request->description,
          'date' => $request->date,
          'property_id'=>$request->property_id
      ]);
      if($newTask){
          return response()->json(["status" => 200]);
      }
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
      $tasks = Task::find($task);
      return response()->json(['status' => 200, 'tasks' => $tasks]);
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
      $tasks = Task::find($task);
      $tasks->name = $request->name;
      $tasks->description = $request->description;
      $tasks->date = $request->date;
      $tasks->property_id = $request->property_id;
      if($tasks -> save()){
          return response()->json(["status" => 200]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $task)
    {
      $tasks = Task::find($id);
      if($tasks -> delete()){
          return response()->json(["status" => 200]);
      }
    }
}
