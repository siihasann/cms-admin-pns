<?php

namespace App\Http\Livewire\Group;

use App\Models\Groups;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $level;
    public $groupId;
    public $isEditMode = false;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'level' => 'required|string|max:255',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->level = '';
        $this->groupId = null;
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

        Groups::create([
            'name' => $this->name,
            'level' => $this->level,
        ]);

        session()->flash('message', 'Golongan berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $group = Groups::findOrFail($id);
        $this->groupId = $group->id;
        $this->name = $group->name;
        $this->level = $group->level;
        $this->isEditMode = true;
        $this->showModal();
    }

    public function update()
    {
        $this->validate();

        $group = Groups::findOrFail($this->groupId);
        $group->update([
            'name' => $this->name,
            'level' => $this->level,
        ]);

        session()->flash('message', 'Golongan berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Groups::findOrFail($id)->delete();
        session()->flash('message', 'Golongan berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.group.index', [
            'groups' => Groups::paginate(10)
        ]);
    }
}
