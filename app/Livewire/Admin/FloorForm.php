<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Floor;
use App\Models\Building;

class FloorForm extends Component
{
    public $building_id, $number, $floor_id;

    protected $rules = [
        'building_id' => 'required|exists:buildings,id',
        'number' => 'required|integer',
    ];

    public function save()
    {
        $this->validate();

        Floor::updateOrCreate(
            ['id' => $this->floor_id],
            ['building_id' => $this->building_id, 'number' => $this->number]
        );

        $this->reset(['building_id', 'number', 'floor_id']);
        session()->flash('success', 'Floor saved successfully.');
    }

    public function edit($id)
    {
        $floor = Floor::findOrFail($id);
        $this->floor_id = $floor->id;
        $this->building_id = $floor->building_id;
        $this->number = $floor->number;
    }

    public function delete($id)
    {
        Floor::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin.floor-form', [
            'buildings' => Building::all(),
            'floors' => Floor::with('building')->get()
        ]);
    }
}
