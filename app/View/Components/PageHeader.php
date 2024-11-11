<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{

    
    /**
     * Create a new component instance.
     */

    public $title;
    public $breadcrumbItems;
    public $buttonText;
    public $buttonLink;


    public function __construct($title, $breadcrumbItems = [], $buttonText = null, $buttonLink = '#')
    {
        $this->title = $title;
        $this->breadcrumbItems = $breadcrumbItems;
        $this->buttonText = $buttonText;
        $this->buttonLink = $buttonLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
