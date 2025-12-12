<div class="py-4">
    <h2 class="mb-4">Client Management</h2>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Clients List</h5>
            <button class="btn btn-primary" wire:click="createClient">
                <i class="fas fa-plus"></i> Add New Client
            </button>
        </div>
        <div class="card-body">
            <!-- Search & Per Page -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search clients..." wire:model.live.debounce.300ms="search">
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <select wire:model.live="perPage" class="form-select w-auto d-inline-block">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th wire:click="sortBy('sort_order')" role="button">Order <i class="fas fa-sort"></i></th>
                            <th>Logo</th>
                            <th wire:click="sortBy('name')" role="button">Name <i class="fas fa-sort"></i></th>
                            <th>Website</th>
                            <th wire:click="sortBy('status')" role="button">Status <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <td>{{ $client->sort_order }}</td>
                            <td>
                                <img src="{{ $client->logo_url }}" class="img-thumbnail" style="height: 50px;">
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>
                                @if($client->website_url)
                                <a href="{{ $client->website_url }}" target="_blank" class="text-decoration-none"><i class="fas fa-external-link-alt"></i> Link</a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($client->status)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info text-white me-1" wire:click="editClient({{ $client->id }})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" wire:click="deleteClient({{ $client->id }})" wire:confirm="Delete this client?"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No clients found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $clients->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade {{ $showModal ? 'show d-block' : '' }}" tabindex="-1" role="dialog" @if($showModal) style="background-color: rgba(0,0,0,.5);" @endif>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Edit Client' : 'Add Client' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="saveClient">
                    <div class="modal-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model.live="name">
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Website -->
                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" class="form-control" wire:model.defer="website_url" placeholder="https://example.com">
                            @error('website_url') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" class="form-control" wire:model.defer="sort_order">
                            <small class="text-muted">Lower numbers show first.</small>
                            @error('sort_order') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Logo -->
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <div class="image-preview">
                                @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" width="100">
                                @elseif ($currentLogo)
                                <img src="{{ asset('storage/' . $currentLogo) }}" width="100">
                                @endif
                            </div>
                            <input type="file" class="form-control" wire:model.live="logo">
                            @error('logo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model.defer="status" id="clientStatus">
                            <label class="form-check-label" for="clientStatus">Active / Visible</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="saveClient">Save</span>
                            <span wire:loading wire:target="saveClient">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>