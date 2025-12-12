<?php

namespace App\Livewire\Backend\Software;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Software;
use App\Models\SoftwareCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Table properties
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $categoryFilter = '';
    public $statusFilter = '';

    protected $listeners = ['softwareSaved' => '$refresh', 'softwareDeleted' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'page' => ['except' => 1],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteSoftware($id)
    {
        try {
            $software = Software::findOrFail($id);

            // Delete associated images
            if ($software->logo && Storage::disk('public')->exists($software->logo)) {
                Storage::disk('public')->delete($software->logo);
            }
            if ($software->banner_image && Storage::disk('public')->exists($software->banner_image)) {
                Storage::disk('public')->delete($software->banner_image);
            }

            $software->delete();
            session()->flash('message', 'Software deleted successfully!');
            $this->dispatch('softwareDeleted');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting software: ' . $e->getMessage());
        }
        $this->resetPage();
    }

    public function render()
    {
        $softwareList = Software::query()
            ->with('category')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('software_category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('is_active', (bool)$this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = SoftwareCategory::orderBy('name')->get(['id', 'name']);

        return view('livewire.backend.software.index', [
            'softwareList' => $softwareList,
            'categories' => $categories,
        ]);
    }
}
