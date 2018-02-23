<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;

// define('tasks_key', 'all_tasks');

/**
 * Show Tasks
 */
Route::get('/', function () {
  $tasks = Cache::rememberForever('all_tasks', function () {
    return Task::orderBy('created_at', 'asc')->get();
  });
  // $tasks = Task::orderBy('created_at', 'asc')->get();

  return view('tasks', [
    'tasks' => $tasks
  ]);
});

/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
    // Validate input
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Create task
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    Cache::forget('all_tasks');

    return redirect('/');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
  $task->delete();

  Cache::forget('all_tasks');

  return redirect('/');
});
