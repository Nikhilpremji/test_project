<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     */

    public $label;
    public $id;
    public $name;
    public $type;
    public $placeholder;
    public $value;
    public $required;


     public function __construct($label, $id,$name, $type = 'text', $placeholder = '',$value = '', $required = false)
    {
        $this->label = $label;
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
