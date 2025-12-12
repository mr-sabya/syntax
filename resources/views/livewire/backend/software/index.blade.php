<div class="py-4">
    <h2 class="mb-4">Manage Software</h2>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Software List</h5>
            <a href="{{ route('admin.software.create') }}" class="btn btn-primary btn-sm" wire:navigate>
                <i class="fas fa-plus me-1"></i> Add Software
            </a>
        </div>
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                    <input type="text" class="form-control" placeholder="Search name..." wire:model.live.debounce.300ms="search">
                </div>
                <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                    <select wire:model.live="categoryFilter" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">Hidden</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-3 d-flex justify-content-md-end justify-content-start mt-2 mt-lg-0">
                    <div class="d-flex align-items-center gap-2">
                        <select wire:model.live="perPage" class="form-select w-auto">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span class="text-nowrap">Per Page</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('name')" style="cursor: pointer;">
                                Name
                                @if ($sortField == 'name')
                                <i class="fas fa-{{ $sortDirection == 'asc' ? 'sort-up' : 'sort-down' }} ms-1"></i>
                                @endif
                            </th>
                            <th>Logo</th>
                            <th wire:click="sortBy('software_category_id')" style="cursor: pointer;">
                                Category
                                @if ($sortField == 'software_category_id')
                                <i class="fas fa-{{ $sortDirection == 'asc' ? 'sort-up' : 'sort-down' }} ms-1"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('price')" style="cursor: pointer;">Price <i class="fas fa-sort text-muted"></i></th>
                            <th wire:click="sortBy('is_active')" style="cursor: pointer;">Status <i class="fas fa-sort text-muted"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($softwareList as $software)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $software->name }}</div>
                                <small class="text-muted">{{ $software->version }}</small>
                            </td>
                            <td>
                                @if ($software->logo)
                                <img src="{{ Storage::url($software->logo) }}" alt="{{ $software->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: contain;">
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $software->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                @if($software->price > 0)
                                ${{ number_format($software->price, 2) }}
                                @else
                                <span class="badge bg-success">Free</span>
                                @endif
                            </td>
                            <td>
                                @if ($software->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Hidden</span>
                                @endif

                                @if($software->is_featured)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Featured</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.software.edit', $software->id) }}" wire:navigate class="btn btn-sm btn-info" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirm('Delete \'{{ $software->name }}\'? This cannot be undone.') || event.stopImmediatePropagation()" wire:click="deleteSoftware({{ $software->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No software found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $softwareList->links() }}
            </div>
        </div>
    </div>
</div>