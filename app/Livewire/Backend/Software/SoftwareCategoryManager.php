<?php

namespace App\Livewire\Backend\Software;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SoftwareCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SoftwareCategoryManager extends Component
{
    use WithPagination;

    // --- Table Properties ---
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // --- Form Properties ---
    public $showModal = false;
    public $categoryId;
    public $name;
    public $slug;
    public $is_active = true;

    public $isEditing = false;

    // Query String for URL persistence
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    // --- Validation ---
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('software_categories', 'slug')->ignore($this->categoryId),
            ],
            'is_active' => 'boolean',
        ];
    }

    // --- Lifecycle Hooks ---
    public function updatedName($value)
    {
        // Auto-generate slug only if we are creating or if slug is empty
        if (!$this->isEditing || empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // --- Actions ---

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function createCategory()
    {
        $this->isEditing = false;
        $this->resetForm();
        $this->openModal();
    }

    public function editCategory(SoftwareCategory $category)
    {
        $this->isEditing = true;
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->is_active = $category->is_active;
        $this->openModal();
    }

    public function saveCategory()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
        ];

        if ($this->isEditing) {
            $category = SoftwareCategory::find($this->categoryId);
            $category->update($data);
            session()->flash('message', 'Category updated successfully!');
        } else {
            SoftwareCategory::create($data);
            session()->flash('message', 'Category created successfully!');
        }

        $this->closeModal();
    }

    public function deleteCategory($id)
    {
        $category = SoftwareCategory::find($id);

        if (!$category) {
            session()->flash('error', 'Category not found.');
            return;
        }

        // Check if software exists in this category
        if ($category->software()->count() > 0) {
            session()->flash('error', 'Cannot delete category because it contains software items. Please move or delete them first.');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category deleted successfully!');
    }

    private function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->is_active = true;
        $this->isEditing = false;
        $this->resetValidation();
    }

    public function render()
    {
        $categories = SoftwareCategory::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.software.software-category-manager', [
            'categories' => $categories
        ]);
    }
}
