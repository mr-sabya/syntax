<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;
use App\Models\BlogPost;

class NewsSection extends Component
{
    public function render()
    {
        // Fetch the 4 latest published posts
        $newsPosts = BlogPost::published()
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('livewire.frontend.home.news-section', [
            'newsPosts' => $newsPosts
        ]);
    }
}