<?php

namespace App\Http\Livewire\Unit;

use App\Models\Units;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $unitId;
    public $isEditMode = false;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->unitId = null;
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

        Units::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Unit berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $unit = Units::findOrFail($id);
        $this->unitId = $unit->id;
        $this->name = $unit->name;
        $this->isEditMode = true;
        $this->showModal();
    }

    public function update()
    {
        $this->validate();

        $unit = Units::findOrFail($this->unitId);
        $unit->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Unit berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Units::findOrFail($id)->delete();
        session()->flash('message', 'Unit berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.unit.index', [
            'units' => Units::paginate(10)
        ]);
    }
}
