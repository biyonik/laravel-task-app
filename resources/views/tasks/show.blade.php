@extends('layouts.app')
@section('title', $task->title)
@section('content')

    <div class="mb-4">
        <a class="link" href="{{route('tasks.index')}}"><- Go back to the task lists!</a>
    </div>

    <p class="mb-4 text-slate-700">{{$task->description}}</p>
    <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
    <p class="mb-4 text-sm text-slate-500">Created: {{$task->created_at->diffForHumans()}} | Updated: {{$task->updated_at->diffForHumans()}}</p>

    <p class="mb-4">
        @if ($task->completed)
            <span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded-full">Completed</span>
        @else
            <span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">Incomplete</span>
        @endif
    </p>

    <div class="flex gap-2">
        <a class="btn" href="{{route('tasks.edit', ['task' => $task])}}">
            Edit
        </a>

        <form method="POST" action="{{route('tasks.change_status', ['task' => $task])}}">
            @csrf
            @method('PUT')
            <button class="btn" type="submit">
                {{$task->completed ? 'Mark as Incomplete' : 'Mark as Completed'}}
            </button>
        </form>

        <form method="POST" action="{{route('tasks.delete', ['task' => $task])}}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Delete</button>
        </form>
    </div>
@endsection
