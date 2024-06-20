<?php
namespace App\Livewire\Dashboard\Vacations;

use App\Http\Requests\Dashboard\VacationRequest;
use Livewire\Component;
use App\Models\Employee;

class VacationCreate extends Component
{
    public $employees;
    public $formData;    

    public function rules()
    {
        return (new VacationRequest())->rules();
    }

    public function messages()
    {
        return (new VacationRequest())->rules();
    }

    public function submit()
    {
        // Validate the form data
        $validatedData = $this->validate();

        // If validation passes, handle form submission
        // $validatedData contains the validated form data
    }

    public function mount()
    {
        // Fetch the list of employees and assign it to the $employees property
        $this->employees = Employee::all();
    }

    public function render()
    {
        // Render the component view and pass the $employees data to it
        return view('dashboard.vacations.vacation-create')->with('employees', $this->employees);
    }
}
