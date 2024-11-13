<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IndexPage extends Component
{
    public function render()
    {
        return view('livewire.index-page')
            ->layout('components.layouts.app'); // Pastikan path ini sesuai
    }
}