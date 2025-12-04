<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Banner;
use App\Models\Category;
use Livewire\Component;

class SlideSection extends Component
{
    public function render()
    {
        $categories = Category::orderBy('sort_order', 'asc')
            ->where('is_active', 1)
            ->where('show_on_homepage', 1)
            ->take(7)->get();

            $banners = Banner::where('is_active', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view('livewire.frontend.home.slide-section',[
            'categories' => $categories,
            'banners' => $banners,
        ]);
    }
}
