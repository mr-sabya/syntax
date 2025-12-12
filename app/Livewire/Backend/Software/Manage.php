<?php

namespace App\Livewire\Backend\Software;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Software;
use App\Models\SoftwareCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads;

    public $softwareId;

    // Basic Info
    public $name;
    public $slug;
    public $version;
    public $software_category_id;

    // Content
    public $short_description;
    public $long_description;
    public $featuresList = []; // Dynamic list array for JSON column

    // Media
    public $logo; // Existing DB path
    public $logoFile; // Temporary upload
    public $banner_image; // Existing DB path
    public $bannerFile; // Temporary upload

    // Links & Pricing
    public $demo_url;
    public $download_url;
    public $purchase_url;
    public $price;

    // Status
    public $is_active = true;
    public $is_featured = false;

    public $isEditing = false;
    public $categories;

    protected $listeners = ['refreshEditor' => '$refresh'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('software')->ignore($this->softwareId)],
            'version' => 'nullable|string|max:50',
            'software_category_id' => 'required|exists:software_categories,id',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'featuresList.*' => 'nullable|string|max:255', // Validate each item in array
            'logoFile' => 'nullable|image|max:2048', // 2MB
            'bannerFile' => 'nullable|image|max:4096', // 4MB
            'demo_url' => 'nullable|url',
            'download_url' => 'nullable|url',
            'purchase_url' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function updatedName($value)
    {
        if (empty($this->slug) || Str::slug($this->name) === $this->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function mount($softwareId = null)
    {
        $this->categories = SoftwareCategory::where('is_active', true)->orderBy('name')->get();

        // Initialize one empty feature input
        $this->featuresList = [''];

        if ($softwareId) {
            $this->isEditing = true;
            $software = Software::findOrFail($softwareId);

            $this->softwareId = $software->id;
            $this->name = $software->name;
            $this->slug = $software->slug;
            $this->version = $software->version;
            $this->software_category_id = $software->software_category_id;
            $this->short_description = $software->short_description;
            $this->long_description = $software->long_description;
            $this->featuresList = $software->features ?? [''];

            $this->logo = $software->logo;
            $this->banner_image = $software->banner_image;

            $this->demo_url = $software->demo_url;
            $this->download_url = $software->download_url;
            $this->purchase_url = $software->purchase_url;
            $this->price = $software->price;

            $this->is_active = $software->is_active;
            $this->is_featured = $software->is_featured;
        }
    }

    // Helper to add a feature line
    public function addFeature()
    {
        $this->featuresList[] = '';
    }

    // Helper to remove a feature line
    public function removeFeature($index)
    {
        unset($this->featuresList[$index]);
        $this->featuresList = array_values($this->featuresList); // Re-index array
    }

    public function saveSoftware()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug ?? Str::slug($this->name),
            'version' => $this->version,
            'software_category_id' => $this->software_category_id,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            // Filter out empty features
            'features' => array_values(array_filter($this->featuresList, fn($value) => !is_null($value) && $value !== '')),
            'demo_url' => $this->demo_url,
            'download_url' => $this->download_url,
            'purchase_url' => $this->purchase_url,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
        ];

        // Upload Logo
        if ($this->logoFile) {
            if ($this->isEditing && $this->logo) {
                Storage::disk('public')->delete($this->logo);
            }
            $data['logo'] = $this->logoFile->store('software/logos', 'public');
        }

        // Upload Banner
        if ($this->bannerFile) {
            if ($this->isEditing && $this->banner_image) {
                Storage::disk('public')->delete($this->banner_image);
            }
            $data['banner_image'] = $this->bannerFile->store('software/banners', 'public');
        }

        // Handle unique slug collision manually
        $originalSlug = $data['slug'];
        $i = 1;
        while (Software::where('slug', $data['slug'])->where('id', '!=', $this->softwareId)->exists()) {
            $data['slug'] = $originalSlug . '-' . $i++;
        }

        if ($this->isEditing) {
            $software = Software::find($this->softwareId);
            $software->update($data);
            session()->flash('message', 'Software updated successfully!');
        } else {
            Software::create($data);
            session()->flash('message', 'Software created successfully!');
        }

        return redirect()->route('admin.software.index');
    }

    public function removeLogo()
    {
        if ($this->logo) {
            Storage::disk('public')->delete($this->logo);
            $this->logo = null;
            $this->logoFile = null;
        }
    }

    public function removeBanner()
    {
        if ($this->banner_image) {
            Storage::disk('public')->delete($this->banner_image);
            $this->banner_image = null;
            $this->bannerFile = null;
        }
    }

    public function render()
    {
        return view('livewire.backend.software.manage');
    }
}
