<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Building;

class BuildingForm extends Component
{
    public $name, $address, $building_id;

    protected $rules = [
        'name' => 'required|string',
        'address' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        Building::updateOrCreate(
            ['id' => $this->building_id],
            ['name' => $this->name, 'address' => $this->address]
        );

        $this->reset(['name', 'address', 'building_id']);
        session()->flash('success', 'Building saved successfully.');
    }

    public function edit($id)
    {
        $building = Building::findOrFail($id);
        $this->building_id = $building->id;
        $this->name = $building->name;
        $this->address = $building->address;
    }

    public function delete($id)
    {
        Building::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin.building-form', [
            'buildings' => Building::all()
        ]);
    }
}


