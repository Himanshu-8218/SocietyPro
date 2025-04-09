<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Building;

class BuildingForm extends Component
{
    public $buildings;
    public $newBuildingName = '';
    public $newBuildingAddress = '';
    public $editingId = null;
    public $editName = '';
    public $editAddress = '';

    public function mount()
    {
        $this->loadBuildings();
    }

    public function loadBuildings()
    {
        $this->buildings = Building::all();
    }

    public function addBuilding()
    {
        $this->validate([
            'newBuildingName' => 'required|string|max:255',
            'newBuildingAddress' => 'required|string|max:255',
        ]);

        Building::create([
            'name' => $this->newBuildingName,
            'address' => $this->newBuildingAddress,
        ]);

        $this->reset(['newBuildingName', 'newBuildingAddress']);
        $this->loadBuildings();
    }

    public function edit($id)
    {
        $building = Building::findOrFail($id);
        $this->editingId = $id;
        $this->editName = $building->name;
        $this->editAddress = $building->address;
    }

    public function updateBuilding()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editAddress' => 'required|string|max:255',
        ]);

        $building = Building::findOrFail($this->editingId);
        $building->update([
            'name' => $this->editName,
            'address' => $this->editAddress,
        ]);

        $this->cancelEdit();
        $this->loadBuildings();
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->editName = '';
        $this->editAddress = '';
        // dd($this->buildings);
    }

    public function deleteBuilding($id)
    {
        Building::destroy($id);
        $this->loadBuildings();
    }

    public function render()
    {
        return view('livewire.admin.building-form');
    }
}
