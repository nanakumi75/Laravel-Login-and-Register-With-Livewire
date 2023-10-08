<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class EmployeeSearchForm extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $employees = Employee::where('first_name','LIKE','%'.$this->search.'%')
        ->OrWhere('last_name','LIKE','%'.$this->search.'%')
        ->OrWhere('email','LIKE','%'.$this->search.'%')
        ->OrWhere('address','LIKE','%'.$this->search.'%')
        ->paginate(12);
        return view('livewire.employee-search-form',['employees' => $employees]);
    }
}
