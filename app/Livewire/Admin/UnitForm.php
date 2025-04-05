<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Unit;
use App\Models\Floor;

class UnitForm extends Component
{
    public $floor_id, $unit_number, $status = 'available', $unit_id;

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
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unit_id = $unit->id;
        $this->floor_id = $unit->floor_id;
        $this->unit_number = $unit->unit_number;
        $this->status = $unit->status;
    }

    public function delete($id)
    {
        Unit::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin.unit-form', [
            'floors' => Floor::with('building')->get(),
            'units' => Unit::with('floor.building')->get()
        ]);
    }
}
