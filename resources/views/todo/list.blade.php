@extends('layouts.app')

@section('content')
    <!-- <h1>Todo List <a href="{{ url('/todo/create') }}" class="btn btn-primary pull-right btn-sm">Add New Todo</a></h1>
    <hr/> -->
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form',"id"=>"myForm"]) !!}
        <!-- Name Field -->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="  col-sm-2">
        </div>
            <div class=" col-sm-4">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                <span class="help-block text-danger">
                    {{ $errors -> first('name') }}
                </span>
            </div>
            <div class="  col-sm-6 center">
                {!! Form::button('Add Task', ['class' => 'btn btn-primary','onClick'=>'getMessage()']) !!}
            </div>
        </div>

        <!-- Submit Button -->
        
    {!! Form::close() !!}

    @include('partials.flash_notification')

 
        <div class="table-responsive"  >
            <table class="table table-refresh table-bordered table-striped table-hover" id="mytable">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
 
                </tbody>
            </table>
        </div>
        <!-- <div class="text-center">
            {!! $todoList->render() !!}
        </div>
   
        <div class="text-center">
            <h3>No todos available yet</h3>
             <p><a href="{{ url('/todo/create') }}">Create new todo</a></p> 
        </div> -->
  

     
    


@endsection