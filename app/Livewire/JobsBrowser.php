<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Pagination\Cursor;
use Livewire\Component;

class JobsBrowser extends Component
{
    public string $q = '';
    public string $location = '';
    public string $category = '';
    public string $employment_type = '';
    public string $salary_min = '';
    public string $salary_max = '';
    public ?string $cursor = null;

    public function updating($name): void
    {
        if (in_array($name, ['q', 'location', 'category', 'employment_type', 'salary_min', 'salary_max'], true)) {
            $this->cursor = null;
        }
    }

    public function goTo(?string $cursor): void
    {
        $this->cursor = $cursor;
    }

    public function render()
    {
        $cursor = $this->cursor ? Cursor::fromEncoded($this->cursor) : null;

        $jobs = Job::query()
            ->with('company')
            ->publicOpen()
            ->filter([
                'q' => $this->q,
                'location' => $this->location,
                'category' => $this->category,
                'employment_type' => $this->employment_type,
                'salary_min' => $this->salary_min,
                'salary_max' => $this->salary_max,
            ])
            ->orderByDesc('id')
            ->cursorPaginate(8, ['*'], 'cursor', $cursor);

        return view('livewire.jobs-browser', [
            'jobs' => $jobs,
            'nextCursor' => optional($jobs->nextCursor())->encode(),
            'prevCursor' => optional($jobs->previousCursor())->encode(),
            'locations' => Job::query()->select('location')->distinct()->orderBy('location')->pluck('location'),
            'categories' => Job::query()->select('category')->distinct()->orderBy('category')->pluck('category'),
        ]);
    }
}
