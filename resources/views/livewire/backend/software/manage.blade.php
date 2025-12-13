<div class="py-4">
    <h2 class="mb-4">{{ $isEditing ? 'Edit Software' : 'Add New Software' }}</h2>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form wire:submit.prevent="saveSoftware">
        <div class="row">
            <!-- Main Form Column -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Basic Details</h5>
                    </div>
                    <div class="card-body">


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.blur="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model.blur="slug">
                                <small class="text-muted">Auto-generated if empty.</small>
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('software_category_id') is-invalid @enderror" wire:model="software_category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('software_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Version</label>
                                <input type="text" class="form-control" wire:model.defer="version" placeholder="e.g. v2.0">
                                @error('version') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" rows="2" wire:model.defer="short_description"></textarea>
                            @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Detailed Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" rows="6" wire:model.defer="long_description"></textarea>
                            @error('long_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Features List --}}
                        <div class="mb-3 p-3 bg-light rounded border">
                            <label class="form-label fw-bold">Key Features</label>
                            @foreach($featuresList as $index => $feature)
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-check"></i></span>
                                <input type="text" class="form-control" wire:model="featuresList.{{ $index }}" placeholder="Feature description...">
                                <button type="button" class="btn btn-outline-danger" wire:click="removeFeature({{ $index }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="addFeature">
                                <i class="fas fa-plus"></i> Add Feature Line
                            </button>
                        </div>
                    </div>
                </div>

                {{-- URLs and Pricing Card --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Links & Pricing</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Demo URL</label>
                                <input type="url" class="form-control" wire:model.defer="demo_url">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Download URL</label>
                                <input type="url" class="form-control" wire:model.defer="download_url">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Purchase URL</label>
                                <input type="url" class="form-control" wire:model.defer="purchase_url">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" wire:model.defer="price">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar / Media Column -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Media & Status</h5>
                    </div>
                    <div class="card-body">
                        {{-- Logo Upload --}}
                        <div class="mb-3">
                            <label class="form-label">Software Logo (Icon)</label>
                            <div class="image-preview mb-2 text-center p-2 border rounded bg-white">
                                @if ($logoFile)
                                <img src="{{ $logoFile->temporaryUrl() }}" class="img-fluid" style="max-height: 100px;">
                                @elseif ($logo)
                                <img src="{{ Storage::url($logo) }}" class="img-fluid" style="max-height: 100px;">
                                @else
                                <span class="text-muted small">No Logo</span>
                                @endif
                            </div>
                            @if ($logo)
                            <button type="button" class="btn btn-sm btn-outline-danger w-100 mb-2" wire:click="removeLogo">Remove Logo</button>
                            @endif
                            <input type="file" class="form-control form-control-sm" wire:model.live="logoFile">
                            @error('logoFile') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Banner Upload --}}
                        <div class="mb-3">
                            <label class="form-label">Banner Image</label>
                            <div class="image-preview mb-2 text-center p-2 border rounded bg-white">
                                @if ($bannerFile)
                                <img src="{{ $bannerFile->temporaryUrl() }}" class="img-fluid" style="max-height: 120px;">
                                @elseif ($banner_image)
                                <img src="{{ Storage::url($banner_image) }}" class="img-fluid" style="max-height: 120px;">
                                @else
                                <span class="text-muted small">No Banner</span>
                                @endif
                            </div>
                            @if ($banner_image)
                            <button type="button" class="btn btn-sm btn-outline-danger w-100 mb-2" wire:click="removeBanner">Remove Banner</button>
                            @endif
                            <input type="file" class="form-control form-control-sm" wire:model.live="bannerFile">
                            @error('bannerFile') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <hr>

                        {{-- Status Switches --}}
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="isActive" wire:model="is_active">
                            <label class="form-check-label" for="isActive">Active / Visible</label>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input type="checkbox" class="form-check-input" id="isFeatured" wire:model="is_featured">
                            <label class="form-check-label fw-bold text-warning" for="isFeatured">Featured Software</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading wire:target="saveSoftware" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                {{ $isEditing ? 'Update Software' : 'Create Software' }}
                            </button>
                            <a href="{{ route('admin.software.index') }}" class="btn btn-outline-secondary" wire:navigate>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>