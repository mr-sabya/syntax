<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class Show extends Component
{
    public $post;
    public $relatedPosts;
    public $recentPosts;
    public $categories;

    public function mount($id)
    {
        // 1. Fetch the main post
        // We use the 'published' scope to ensure drafts are not accessible via URL
        $this->post = BlogPost::published()
            ->with(['category', 'tags']) // Eager load relationships
            ->where('id', $id)
            ->firstOrFail();

        // 2. Fetch Related Posts (Same category, excluding current post)
        $this->relatedPosts = BlogPost::published()
            ->where('blog_category_id', $this->post->blog_category_id)
            ->where('id', '!=', $this->post->id)
            ->take(3)
            ->get();

        // 3. Fetch Sidebar Data (Recent Posts & Categories)
        $this->recentPosts = BlogPost::published()
            ->latest()
            ->take(5)
            ->get();
            
        $this->categories = BlogCategory::withCount('blogPosts')->get();
    }

    public function render()
    {
        // Set the page title dynamically
        return view('livewire.frontend.blog.show'); 
    }
}