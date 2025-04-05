<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class StaffManagement extends Component
{
    public $users;
    public $editUserId = null;
    public $name;
    public $email;

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::whereIn('usertype', ['Security', 'Staff'])->get();
    }

    public function render()
    {
        return view('livewire.admin.staff-management');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->editUserId = $id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function update()
    {
        $user = User::find($this->editUserId);
        if ($user) {
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();
            session()->flash('message', 'User updated successfully!');
        }

        $this->cancelEdit(); // reset fields
        $this->loadUsers();  // reload updated data
    }

    public function cancelEdit()
    {
        $this->editUserId = null;
        $this->name = '';
        $this->email = '';
    }

    public function delete_staff($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
            $this->loadUsers();
        }
    }
}
