<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSelect extends Component
{
    /**
     * Create a new component instance.
     */

    public $label;
    public $name;
    public $id;
    public $options;
    public $placeholder;
    public $selected;
    public $required;


    public function __construct($label, $name, $id = null, $options = [], $placeholder = null,$selected=null,$required= false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id ?? $name; // Use name as id if id isn't provided
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->selected = $selected;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-select');
    }
}
