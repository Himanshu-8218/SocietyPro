<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Unit;
use App\Models\Floor;

class UnitForm extends Component
{
    public $floor_id, $unit_number, $status = 'available', $unit_id;
    public $edit_id, $edit_floor_id, $edit_unit_number, $edit_status;

    protected $rules = [
        'floor_id' => 'required|exists:floors,id',
        'unit_number' => 'required|string',
        'status' => 'required|in:available,occupied',
    ];

    public function save()
    {
        $this->validate();

        Unit::updateOrCreate(
            ['id' => $this->unit_id],
            [
                'floor_id' => $this->floor_id,
                'unit_number' => $this->unit_number,
                'status' => $this->status
            ]
        );

        $this->reset(['floor_id', 'unit_number', 'status', 'unit_id']);
        session()->flash('success', 'Unit saved successfully.');
        return redirect()->route('admin/units');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->edit_id = $unit->id;
        $this->edit_floor_id = $unit->floor_id;
        $this->edit_unit_number = $unit->unit_number;
        $this->edit_status = $unit->status;
    }

    public function cancelEdit()
    {
        $this->reset(['edit_id', 'edit_floor_id', 'edit_unit_number', 'edit_status']);
    }

    public function update()
    {
        $this->validate([
            'edit_floor_id' => 'required|exists:floors,id',
            'edit_unit_number' => 'required|string',
            'edit_status' => 'required|in:available,occupied',
        ]);

        Unit::where('id', $this->edit_id)->update([
            'floor_id' => $this->edit_floor_id,
            'unit_number' => $this->edit_unit_number,
            'status' => $this->edit_status,
        ]);

        $this->cancelEdit();
        session()->flash('success', 'Unit updated successfully.');
    }

    public function delete($id)
    {
        Unit::destroy($id);
        session()->flash('success', 'Unit deleted.');
    }

    public function render()
    {
        return view('livewire.admin.unit-form', [
            'floors' => Floor::with('building')->get(),
            'units' => Unit::with('floor.building')->get()
        ]);
    }
}
