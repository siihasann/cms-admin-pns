<?php

namespace App\Http\Livewire\WrokLocation;

use App\Models\WorkLocations;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $address;
    public $work_location_id;
    public $isEditMode = false;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->work_location_id = null;
        $this->isEditMode = false;
    }

    public function showModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function store()
    {
        $this->validate();

        WorkLocations::create([
            'name' => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Lokasi Kerja berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $workLocation = WorkLocations::findOrFail($id);
        $this->work_location_id = $workLocation->id;
        $this->name = $workLocation->name;
        $this->address = $workLocation->address;
        $this->isEditMode = true;
        $this->showModal();
    }

    public function update()
    {
        $this->validate();

        $workLocation = WorkLocations::findOrFail($this->work_location_id);
        $workLocation->update([
            'name' => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Lokasi Kerja berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        WorkLocations::findOrFail($id)->delete();
        session()->flash('message', 'Lokasi Kerja berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.wrok-location.index', [
            'workLocations' => WorkLocations::paginate(10)
        ]);
    }
}
