<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    /**
     * create controller
     * 
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $tasks=$request->user()->tasks()->get();
        return view('tasks.index',[
                'tasks' => $tasks,
                ]);
    }
    
    public function create() {
        return view('tasks.create');
    }
    
    /**
 * Создание новой задачи.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
  $this->validate($request, [
    'name' => 'required|max:255',
  ]);

  $request->user()->tasks()->create([
    'name' => $request->name,
  ]);

  return redirect(route('/tasks.index'));
}
    
    public function destroy() {
        return 'destroy';
    }
}
