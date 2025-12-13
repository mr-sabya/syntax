<?php

namespace App\Livewire\Backend\Partner;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showModal = false;
    public $partnerId;
    public $name;
    public $description;
    public $website_url;
    public $sort_order = 0;
    public $is_featured = false;
    public $logo;            
    public $currentLogo;     
    public $status = true;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'sort_order'],
        'sortDirection' => ['except' => 'asc'],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'website_url' => 'nullable|url|max:255',
        'sort_order' => 'required|integer|min:0',
        'logo' => 'required|image|max:2048',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function updatingSearch() { $this->resetPage(); }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortField = $field;
    }

    public function openModal() { $this->resetValidation(); $this->showModal = true; }

    public function closeModal() { $this->showModal = false; $this->resetForm(); }

    public function createPartner() { $this->isEditing = false; $this->resetForm(); $this->openModal(); }

    public function editPartner(Partner $partner)
    {
        $this->isEditing = true;
        $this->partnerId = $partner->id;
        $this->name = $partner->name;
        $this->description = $partner->description;
        $this->website_url = $partner->website_url;
        $this->sort_order = $partner->sort_order;
        $this->is_featured = $partner->is_featured;
        $this->currentLogo = $partner->logo;
        $this->status = $partner->status;
        $this->openModal();
    }

    public function savePartner()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'website_url' => $this->website_url,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
        ];

        if ($this->logo) {
            if ($this->currentLogo && Storage::disk('public')->exists($this->currentLogo)) {
                Storage::disk('public')->delete($this->currentLogo);
            }
            $data['logo'] = $this->logo->store('partners', 'public');
        } elseif (!$this->logo && $this->currentLogo) {
            $data['logo'] = $this->currentLogo;
        } else {
            $data['logo'] = null;
        }

        if ($this->isEditing) {
            Partner::find($this->partnerId)->update($data);
            session()->flash('message', 'Partner updated successfully!');
        } else {
            Partner::create($data);
            session()->flash('message', 'Partner created successfully!');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function deletePartner($id)
    {
        $partner = Partner::find($id);
        if ($partner) {
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            $partner->delete();
            session()->flash('message', 'Partner deleted successfully!');
        }
        $this->resetPage();
    }

    private function resetForm()
    {
        $this->partnerId = null;
        $this->name = '';
        $this->description = '';
        $this->website_url = '';
        $this->sort_order = 0;
        $this->is_featured = false;
        $this->logo = null;
        $this->currentLogo = null;
        $this->status = true;
        $this->isEditing = false;
        $this->resetValidation();
    }

    public function updatedLogo() { $this->resetValidation('logo'); }

    public function render()
    {
        $partners = Partner::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.partner.partner-manager', [
            'partners' => $partners,
        ]);
    }
}