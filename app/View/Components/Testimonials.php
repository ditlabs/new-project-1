<?php

namespace App\View\Components;

use App\Models\Testimonial; // Import model Testimonial
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonials extends Component
{
    /**
     * Create a new component instance.
     */
    public $testimonials;

    public function __construct()
    {
        $this->testimonials = Testimonial::where('is_visible', true)
                                          ->latest()
                                          ->take(5)
                                          ->get();                                        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonials');
    }
}
