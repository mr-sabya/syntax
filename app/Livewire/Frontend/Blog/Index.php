<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogPost;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Use Bootstrap theme for pagination links (optional, depends on your CSS)
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Fetch published posts, order by latest, and load category relationship
        $posts = BlogPost::where('is_published', 1)
            ->with('category')
            ->latest('published_at')
            ->paginate(12); // Adjust number of items per page

        return view('livewire.frontend.blog.index', [
            'posts' => $posts
        ]);
    }
}
