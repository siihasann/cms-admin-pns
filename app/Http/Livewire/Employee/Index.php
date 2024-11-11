<?php

namespace App\Http\Livewire\Employee;

use App\Models\Departements;
use App\Models\Employee;
use App\Models\Eselons;
use App\Models\Groups;
use App\Models\Units;
use App\Models\WorkLocations;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $selectedUnit = '';
    public $photo;

    // Form fields
    public $employeeId;
    public $nip;
    public $name;
    public $birth_place;
    public $birth_date;
    public $gender;
    public $address;
    public $religion;
    public $phone;
    public $npwp;
    public $departement_id;
    public $eselon_id;
    public $unit_id;
    public $group_id;
    public $work_location_id;

    public $isModalOpen = false;

    protected $listeners = ['delete' => 'destroy'];

    protected function rules()
    {
        return [
            'nip' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'religion' => 'required|string',
            'phone' => 'nullable|string',
            'npwp' => 'nullable|string',
            'photo' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            'departement_id' => 'required|exists:departements,id',
            'eselon_id' => 'required|exists:eselons,id',
            'unit_id' => 'required|exists:units,id',
            'group_id' => 'required|exists:groups,id',
            'work_location_id' => 'required|exists:work_locations,id',
        ];
    }


    public function render()
    {
        $query = Employee::query()
            ->with(['jabatan', 'eselon', 'ranks', 'units', 'work_locations'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedUnit, function ($query) {
                $query->where('unit_id', $this->selectedUnit);
            });

        $employees = $query->paginate(10);

        $units = Units::all();
        $departments = Departements::all();
        $eselons = Eselons::all();
        $groups = Groups::all();
        $work_locations = WorkLocations::all();

        return view('livewire.employee.index', [
            'employees' => $employees,
            'units' => $units,
            'departments' => $departments,
            'eselons' => $eselons,
            'groups' => $groups,
            'workLocations' => $work_locations,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->validate();

        $data = [
            'nip' => $this->nip,
            'name' => $this->name,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'address' => $this->address,
            'religion' => $this->religion,
            'phone' => $this->phone,
            'npwp' => $this->npwp,
            'departement_id' => $this->departement_id,
            'eselon_id' => $this->eselon_id,
            'unit_id' => $this->unit_id,
            'group_id' => $this->group_id,
            'work_location_id' => $this->work_location_id,
        ];

        try {
            // Handle foto
            if ($this->photo) {
                // Jika sedang edit dan ada foto lama, hapus foto lama
                if ($this->employeeId) {
                    $employee = Employee::find($this->employeeId);
                    if ($employee && $employee->photo) {
                        Storage::disk('public')->delete($employee->photo);
                    }
                }

                // Simpan foto baru
                $filename = time() . '_' . $this->photo->getClientOriginalName();
                $path = $this->photo->storeAs('photos', $filename, 'public');
                $data['photo'] = $path;
            }

            // Simpan atau update data
            if ($this->employeeId) {
                Employee::find($this->employeeId)->update($data);
            } else {
                Employee::create($data);
            }

            $this->isModalOpen = false;
            $this->resetInputFields();
            session()->flash('message', $this->employeeId ? 'Employee updated successfully.' : 'Employee created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $id;
        $this->nip = $employee->nip;
        $this->name = $employee->name;
        $this->birth_place = $employee->birth_place;
        $this->birth_date = $employee->birth_date->format('Y-m-d');
        $this->gender = $employee->gender;
        $this->address = $employee->address;
        $this->religion = $employee->religion;
        $this->phone = $employee->phone;
        $this->npwp = $employee->npwp;
        $this->departement_id = $employee->departement_id;
        $this->eselon_id = $employee->eselon_id;
        $this->unit_id = $employee->unit_id;
        $this->group_id = $employee->group_id;
        $this->work_location_id = $employee->work_location_id;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        $employee->delete();
        session()->flash('message', 'Employee deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->employeeId = null;
        $this->nip = '';
        $this->name = '';
        $this->birth_place = '';
        $this->birth_date = '';
        $this->gender = '';
        $this->address = '';
        $this->religion = '';
        $this->phone = '';
        $this->npwp = '';
        $this->photo = null;
        $this->departement_id = '';
        $this->eselon_id = '';
        $this->unit_id = '';
        $this->group_id = '';
        $this->work_location_id = '';
    }
}
