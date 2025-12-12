<div class="py-4">
    <h2 class="mb-4">Software Categories</h2>

    {{-- Messages --}}
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Category List</h5>
            <button class="btn btn-primary" wire:click="createCategory">
                <i class="fas fa-plus me-1"></i> Add Category
            </button>
        </div>
        <div class="card-body">
            <!-- Search & Filter -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search categories..." wire:model.live.debounce.300ms="search">
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
                            <th wire:click="sortBy('name')" role="button">Name <i class="fas fa-sort text-muted"></i></th>
                            <th>Slug</th>
                            <th class="text-center">Software Count</th>
                            <th wire:click="sortBy('is_active')" role="button">Status <i class="fas fa-sort text-muted"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-muted">{{ $category->slug }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary rounded-pill">{{ $category->software->count() }}</span>
                            </td>
                            <td>
                                @if ($category->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info text-white me-1" wire:click="editCategory({{ $category->id }})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger"
                                    wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="Are you sure? This will fail if software items are attached."
                                    title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div class="modal fade {{ $showModal ? 'show d-block' : '' }}" tabindex="-1" role="dialog" @if($showModal) style="background-color: rgba(0,0,0,.5);" @endif>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Edit Category' : 'Create Category' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="saveCategory">
                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model.live="name" placeholder="e.g. ERP Systems">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                wire:model.defer="slug" placeholder="auto-generated">
                            <small class="text-muted">URL friendly version (e.g. erp-systems)</small>
                            @error('slug') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="isActive" wire:model.defer="is_active">
                            <label class="form-check-label" for="isActive">Active / Visible</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="saveCategory">Save Changes</span>
                            <span wire:loading wire:target="saveCategory">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>