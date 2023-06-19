<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'long_description',
        'completed',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    final public function toggleCompleted(): void
    {
        $this->completed = !$this->completed;
        $this->save();
    }

    final public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('completed', true);
    }

    final public function scopeIncomplete(Builder $query): Builder
    {
        return $query->where('completed', false);
    }

    final public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    final public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('long_description', 'like', '%' . $search . '%');
    }

    final public function scopeFilter(Builder $query, array $filters): void
    {
        if (isset($filters['search'])) {
            $query->search($filters['search']);
        }

        if (isset($filters['completed'])) {
            $query->where('completed', $filters['completed']);
        }
    }

    final public function scopeGetById(Builder $query,string|int $id): Task
    {
        return $query->whereId($id)->first();
    }

    final public function scopeGetByTitle(Builder $query, string $title): Task
    {
        return $query->whereTitle($title)->first();
    }

    final public function scopeGetByDescription(Builder $query, string $description): Task
    {
        return $query->whereDescription($description)->first();
    }

    final public function scopeGetByLongDescription(Builder $query, string $long_description): Task
    {
        return $query->whereLongDescription($long_description)->first();
    }

    final public function scopeTotalCompleted(Builder $query): int
    {
        return $query->whereCompleted(true)->count();
    }

    final public function scopeTotalIncomplete(Builder $query): int
    {
        return $query->whereCompleted(false)->count();
    }

    final public function scopeTotal(Builder $query): int
    {
        return $query->count();
    }

    final public function scopeTotalSearch(Builder $query, string $search): Builder
    {
        return $query->search($search)->count();
    }

    final public function scopeTotalFilter(Builder $query, array $filters): Builder
    {
        return $query->filter($filters)->count();
    }

    final public function simplePaginate(Builder $query, int $perPage = 15, array $columns = ['*'], string $pageName = 'page'): Paginator
    {
        return $query->simplePaginate($perPage, $columns, $pageName);
    }
}
