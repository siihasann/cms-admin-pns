<?php

namespace App\Http\Livewire\Departement;

use App\Models\Departements;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $departementId;
    public $isEditMode = false;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->departementId = null;
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

        Departements::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Jabatan berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $departement = Departements::findOrFail($id);
        $this->departementId = $departement->id;
        $this->name = $departement->name;
        $this->isEditMode = true;
        $this->showModal();
    }

    public function update()
    {
        $this->validate();

        $departement = Departements::findOrFail($this->departementId);
        $departement->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Jabatan berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Departements::findOrFail($id)->delete();
        session()->flash('message', 'Jabatan berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.departement.index', [
            'departements' => Departements::paginate(10)
        ]);
    }
}
