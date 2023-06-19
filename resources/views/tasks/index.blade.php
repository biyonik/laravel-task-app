@extends('layouts.app')
@section('title', 'All Tasks')
@section('content')

    <nav class="mb-4">
        <a class="link" href="{{route('tasks.create')}}">Create a new task</a>
    </nav>

    <p>Total count by completed task: {{$data['totalCountByCompleted']}}</p>
    @forelse ($data['tasks'] as $task)
        <div>
            <a @class([
                'text-gray-700',
                'underline' => !$task->completed,
                'line-through' => $task->completed,
            ])
               href="{{route('tasks.show', ['task' => $task])}}">
                {{$task->title}}
            </a>
            <ul>
                <li>
                    <a class="btn" href="{{route('tasks.edit', ['task' => $task])}}">
                        Edit
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{route('tasks.delete', ['task' => $task])}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if ($data['tasks']->count())
        <div>
            {{$data['tasks']->links('pagination::tailwind')}}
        </div>
    @endif
@endsection
