<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
        <form action="{{ route('task.store') }}" method="POST" class="form-horizontal">
            @csrf
        <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('tasks.task') }}</label>

                <div class="col-sm-6">
                    <input placeholder="{{trans('tasks.task_name')}}" type="text" name="name" id="task-name" class="form-control">
                    <input placeholder="{{trans('tasks.user_name')}}" type="text" name="user_name" id="user_name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i>{{ trans('tasks.add') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
    @if (isset($tasks))
        @if (count($tasks) > config('view.no_error'))
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('tasks.current_tasks') }}
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>{{ trans('tasks.task') }}</th>
                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Delete Button -->
                                <td>
                                    <form action="{{ route('task.destroy',['task' => $task->id]) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> {{ trans('tasks.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif
@endsection
