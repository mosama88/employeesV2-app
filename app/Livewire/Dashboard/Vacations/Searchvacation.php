<?php

namespace App\Livewire\Dashboard\Vacations;

use Livewire\Component;
use App\Models\Vacation;
use Livewire\WithPagination;

class Searchvacation extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';



    public $search;

//  protected $queryString = ['search'];

protected $queryString = [       //حتى لايظهر فى الurl بإسم Search
    'search'=>['except'=>'', 'as' =>'Y'],
    // 'page'=>['except'=>1],
];

public function updatingSearch()
    {
        $this->resetPage();
    }


    // public function render()
    // {
    //     $searchTerm = '%' . $this->search . '%';

    //     $vacations = Vacation::whereHas('employee', function($query) use ($searchTerm) {
    //         $query->where('name', 'like', $searchTerm); // Adjust 'name' to the relevant employee attribute
    //     })->paginate(5);

    //     return view('dashboard.vacations.searchvacation', [
    //         'posts' => $vacations,
    //     ]);
    // }
}
