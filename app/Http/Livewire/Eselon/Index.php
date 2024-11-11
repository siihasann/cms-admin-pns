<?php

namespace App\Http\Livewire\Eselon;

use App\Models\Eselons;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $eselon;
    public $eselonId;
    public $isEditMode = false;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'eselon' => 'required|string|max:255',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->eselon = '';
        $this->eselonId = null;
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

        Eselons::create([
            'name' => $this->name,
            'eselon' => $this->eselon,
        ]);

        session()->flash('message', 'Eselon berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $eselon = Eselons::findOrFail($id);
        $this->eselonId = $eselon->id;
        $this->name = $eselon->name;
        $this->eselon = $eselon->eselon;
        $this->isEditMode = true;
        $this->showModal();
    }

    public function update()
    {
        $this->validate();

        $eselon = Eselons::findOrFail($this->eselonId);
        $eselon->update([
            'name' => $this->name,
            'eselon' => $this->eselon,
        ]);

        session()->flash('message', 'Eselon berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Eselons::findOrFail($id)->delete();
        session()->flash('message', 'Eselon berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.eselon.index', [
            'eselons' => Eselons::paginate(10)
        ]);
    }
}
