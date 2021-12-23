<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-users', [
            'users' => User::where('name', $this->search)->get(),
        ]);
    }
}
