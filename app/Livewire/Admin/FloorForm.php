<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Floor;
use App\Models\Building;

class FloorForm extends Component
{
    public $building_id, $number, $floor_id;
    public $edit_id, $edit_building_id, $edit_number;

    protected $rules = [
        'building_id' => 'required|exists:buildings,id',
        'number' => 'required|integer',
    ];

    public function render()
    {
        return view('livewire.admin.floor-form', [
            'buildings' => Building::all(),
            'floors' => Floor::with('building')->get()
        ]);
    }

    public function save()
    {
        $this->validate();

        Floor::create([
            'building_id' => $this->building_id,
            'number' => $this->number,
        ]);

        session()->flash('success', 'Floor added successfully.');

        $this->reset(['building_id', 'number']);
        return redirect()->route('admin/floors');
    }

    public function edit($id)
    {
        $floor = Floor::findOrFail($id);
        $this->edit_id = $floor->id;
        $this->edit_building_id = $floor->building_id;
        $this->edit_number = $floor->number;

    }

    public function update()
    {
        $this->validate([
            'edit_building_id' => 'required|exists:buildings,id',
            'edit_number' => 'required|integer',
        ]);

        Floor::where('id', $this->edit_id)->update([
            'building_id' => $this->edit_building_id,
            'number' => $this->edit_number,
        ]);

        session()->flash('success', 'Floor updated successfully.');

        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->reset(['edit_id', 'edit_building_id', 'edit_number']);
    }

    public function delete($id)
    {
        Floor::destroy($id);
        session()->flash('success', 'Floor deleted successfully.');
    }
}
