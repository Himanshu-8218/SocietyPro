<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
// use Livewire\WithPagination;
class StaffManagement extends Component
{
    // use WithPagination;
    public function render()
    {
        $users = User::whereIn('usertype',['Security','Staff'])->get(); 
        // dd($users); 
        return view('livewire.admin.staff-management', ['users' => $users]);
    }

    // Method to handle editing staff
    public function edit($id)
    {
        // $users=User::all();
        // return view('livewire.admin.staff-management', ['users' => $users]);
    }


    public function delete_staff($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
        } else {
            session()->flash('error', 'User not found.');
        }

        // Optionally, redirect after action
        return redirect()->route('admin/dashboard');  // Adjust the route as needed
    }
}
