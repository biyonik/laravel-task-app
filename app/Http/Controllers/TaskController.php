<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TaskController extends Controller
{
    //
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tasks = Task::latest()->paginate(10);
        $totalCountByCompleted = Task::totalCompleted();
        $data = [
            'tasks' => $tasks,
            'totalCountByCompleted' => $totalCountByCompleted,
        ];
        return view('tasks.index', compact('data'));
    }

    public function getById(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $task = Task::getById($id);
        return view('tasks.show', compact('task'));
    }

    public function single(Task $task): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('tasks.show', compact('task'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());
        return redirect()->route('tasks.show', ['task' => $task]);
    }

    /**
     * @param string $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(Task $task): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        return redirect()->route('tasks.show', ['task' => $task]);
    }

    public function delete(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function changeStatus(Task $task): RedirectResponse
    {
        $task->toggleCompleted();
        return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task status changed successfully');
    }

}
