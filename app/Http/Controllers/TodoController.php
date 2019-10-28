<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::latest()->get();

        return new TodoResource($todos);
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
        $data = request()->validate([
            'title' => ['required','min:3'],
            'status' => ['required']
        ]);

        if($data){
            Todo::create($data);
            return new TodoResource($data);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_numeric($id)){
            $todo = Todo::findorFail($id);

            return new TodoResource($todo);
        }
        else{
            return response()->json([
                'error' => 'Enter a proper query string',
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::findorFail($id);

        $updatedTodo = $todo->update($request->all());

        if($updatedTodo){
            return response()->json([
                'success' => 'Todo Updated!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        if($todo->delete()){
            return response()->json([
                'success' => 'Todo Deleted Successfully!',
            ]);
        }
    }
}
