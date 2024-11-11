<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Departements;
use App\Models\Units;

class ComponentDashboard extends Component
{
    public $totalEmployees;
    public $totalDepartments;
    public $totalUnits;

    public function mount()
    {
        $this->totalEmployees = Employee::count();
        $this->totalDepartments = Departements::count();
        $this->totalUnits = Units::count();
    }

    public function render()
    {
        return view('livewire.layout.component-dashboard');
    }
}
