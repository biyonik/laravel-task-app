@extends('layouts.app')
@section('title', isset($task) ? 'Update Task' : 'Create Task')
@section('styles')
@endsection
@section('content')

    <div class="mb-4">
        <a class="btn" href="{{route('tasks.index')}}">Back to tasks</a>
    </div>
    <form method="POST" action="{{
        isset($task)
            ? route('tasks.update', $task)
            : route('tasks.store')
        }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{$task->title ?? old('title')}}" @class([
                'border-red-500' => $errors->has('title')])>
            @error('title')
            <p class="alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" @class([
                'border-red-500' => $errors->has('description')])>{{$task->description ?? old('description')}}</textarea>
            @error('description')
            <p class="alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" cols="30" rows="10" @class([
                'border-red-500' => $errors->has('long_description')])>
                {{$task->long_description ?? old('long_description')}}
            </textarea>
        </div>
        <div>
            <label for="completed">Completed</label>
            <input
                type="checkbox"
                name="completed"
                id="completed"
                {{isset($task) && $task->completed ? 'checked' : (old('completed') ? 'checked' : '')}}
            >
        </div>
        <div>
            <button type="submit" class="btn">
                @isset($task)
                    Update
                @else
                    Create
                @endisset
            </button>
        </div>
    </form>
@endsection
