<?php

namespace App\Livewire\Backend\Client;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    // --- Table Properties ---
    public $search = '';
    public $sortField = 'sort_order'; // Default sort by order
    public $sortDirection = 'asc';
    public $perPage = 10;

    // --- Form Properties ---
    public $showModal = false;
    public $clientId;
    public $name;
    public $website_url;
    public $sort_order = 0;
    public $logo;
    public $currentLogo;
    public $status = true; // Maps to 'status' column (Active/Hidden)

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'sort_order'],
        'sortDirection' => ['except' => 'asc'],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'website_url' => 'nullable|url|max:255',
        'sort_order' => 'required|integer|min:0',
        'logo' => 'required|image|max:2048', // Max 2MB
        'status' => 'boolean',
    ];

    public function updatingSearch()
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

    public function createClient()
    {
        $this->isEditing = false;
        $this->resetForm();
        $this->openModal();
    }

    public function editClient(Client $client)
    {
        $this->isEditing = true;
        $this->clientId = $client->id;
        $this->name = $client->name;
        $this->website_url = $client->website_url;
        $this->sort_order = $client->sort_order;
        $this->currentLogo = $client->logo;
        $this->status = $client->status;
        $this->openModal();
    }

    public function saveClient()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'website_url' => $this->website_url,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->logo) {
            if ($this->currentLogo && Storage::disk('public')->exists($this->currentLogo)) {
                Storage::disk('public')->delete($this->currentLogo);
            }
            $data['logo'] = $this->logo->store('clients', 'public');
        } elseif (!$this->logo && $this->currentLogo) {
            $data['logo'] = $this->currentLogo;
        } else {
            $data['logo'] = null; // Or keep generic placeholder logic in Model accessor
        }

        if ($this->isEditing) {
            $client = Client::find($this->clientId);
            $client->update($data);
            session()->flash('message', 'Client updated successfully!');
        } else {
            Client::create($data);
            session()->flash('message', 'Client created successfully!');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function deleteClient($id)
    {
        $client = Client::find($id);

        if (!$client) {
            session()->flash('error', 'Client not found.');
            return;
        }

        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        $client->delete();
        session()->flash('message', 'Client deleted successfully!');
        $this->resetPage();
    }

    private function resetForm()
    {
        $this->clientId = null;
        $this->name = '';
        $this->website_url = '';
        $this->sort_order = 0;
        $this->logo = null;
        $this->currentLogo = null;
        $this->status = true;
        $this->isEditing = false;
        $this->resetValidation();
    }

    public function updatedLogo()
    {
        $this->resetValidation('logo');
    }

    public function render()
    {
        $clients = Client::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.client.client-manager', [
            'clients' => $clients,
        ]);
    }
}
