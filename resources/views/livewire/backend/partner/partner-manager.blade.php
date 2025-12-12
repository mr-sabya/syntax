<div class="py-4">
    <h2 class="mb-4">Partner Management</h2>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Partners List</h5>
            <button class="btn btn-primary" wire:click="createPartner">
                <i class="fas fa-plus"></i> Add Partner
            </button>
        </div>
        <div class="card-body">
            <!-- Search & Filter -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search partners..." wire:model.live.debounce.300ms="search">
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
                            <th>Featured</th>
                            <th wire:click="sortBy('status')" role="button">Status <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($partners as $partner)
                        <tr>
                            <td>{{ $partner->sort_order }}</td>
                            <td>
                                <img src="{{ $partner->logo_url }}" class="img-thumbnail" style="height: 50px;">
                            </td>
                            <td>
                                <div class="fw-bold">{{ $partner->name }}</div>
                                <small class="text-muted">{{ Str::limit($partner->description, 30) }}</small>
                            </td>
                            <td>
                                @if($partner->is_featured)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Featured</span>
                                @else
                                <span class="badge bg-light text-secondary border">Standard</span>
                                @endif
                            </td>
                            <td>
                                @if ($partner->status)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info text-white me-1" wire:click="editPartner({{ $partner->id }})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" wire:click="deletePartner({{ $partner->id }})" wire:confirm="Delete this partner?"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No partners found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $partners->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade {{ $showModal ? 'show d-block' : '' }}" tabindex="-1" role="dialog" @if($showModal) style="background-color: rgba(0,0,0,.5);" @endif>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Edit Partner' : 'Add Partner' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="savePartner">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model.live="name">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model.defer="sort_order">
                                @error('sort_order') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" class="form-control" wire:model.defer="website_url">
                            @error('website_url') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="2" wire:model.defer="description"></textarea>
                            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

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

                        <div class="d-flex gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model.defer="status" id="pStatus">
                                <label class="form-check-label" for="pStatus">Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model.defer="is_featured" id="pFeatured">
                                <label class="form-check-label fw-bold text-warning" for="pFeatured">Featured Partner</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="savePartner">Save</span>
                            <span wire:loading wire:target="savePartner">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>