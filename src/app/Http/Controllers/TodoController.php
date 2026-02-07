<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $todos = Todo::paginate(10);

    return view('index', [
      'todos' => $todos,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreTodoRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(TodoRequest $request)
  {
    $todo = $request->only(['content']);

    Todo::create($todo);

    return redirect('/')->with('message', 'Todoを作成しました');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateTodoRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function update(TodoRequest $request)
  {
    $todo = $request->only(['content']);

    Todo::find($request->input('id'))->update($todo);

    return redirect('/')->with('message', 'Todoを更新しました');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    Todo::find($request->input('id'))->delete();

    return redirect('/')->with('message', 'Todoを削除しました');
  }
}
