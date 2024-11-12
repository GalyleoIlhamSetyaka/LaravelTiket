<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IndexPage extends Component
{
    protected $layout = 'components.layouts.app';

    public function render()
    {
        return view('livewire.index-page');
    }
}