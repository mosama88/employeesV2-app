<?php
use Closure;
use App\Models\Employee;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueActingEmployee implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get the name of the acting employee
        $actingEmployeeName = Employee::find($value)->name;

        // Get the name of the primary employee
        $primaryEmployeeName = Employee::find(request()->input('employee_id'))->name;

        // Check if the names are different
        if ($actingEmployeeName === $primaryEmployeeName) {
            $fail('لا يجب اختيار نفس اسم الموظف.');
        }
    }
}
