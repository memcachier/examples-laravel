<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

  <div class="container">

    <!-- New Task Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">New Task</h5>

        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('task') }}" method="POST">
          {{ csrf_field() }}

          <!-- Task Name -->
          <div class="form-group">
            <input type="text" name="name" id="task-name" class="form-control"
                   placeholder="Task Name">
          </div>

          <!-- Add Task Button -->
          <div class="form-group">
            <button type="submit" class="btn btn-default">
              <i class="fa fa-plus"></i> Add Task
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Current Tasks</h5>

          <table class="table table-striped">
            @foreach ($tasks as $task)
              <tr>
                <!-- Task Name -->
                <td class="table-text">
                  <div>{{ $task->name }}</div>
                </td>

                <!-- Delete Button -->
                <td>
                  <form action="{{ url('task/'.$task->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    @endif

    <!-- Stats Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Stats</h5>
        <table class="table table-striped">
          <tr>
            <td>Set commands</td>
            <td>{{ $stats['cmd_set'] }}</td>
          </tr>
          <tr>
            <td>Get hits</td>
            <td>{{ $stats['get_hits'] }}</td>
          </tr>
          <tr>
            <td>Get misses</td>
            <td>{{ $stats['get_misses'] }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

@endsection
