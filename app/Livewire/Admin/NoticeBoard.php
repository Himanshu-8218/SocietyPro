<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\AdminNotification;
use Livewire\WithPagination;
class NoticeBoard extends Component
{
    use WithPagination;
    public $title, $content;
    
    public function createNotice()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notice = Notice::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => Auth::id(),
        ]);

        // Notify all residents
        $users = User::where('usertype', 'Resident')->get();
        foreach ($users as $user) {
            $user->notify(new AdminNotification($notice));
        }

        session()->flash('message', 'Notice created successfully.');
        $this->reset(['title', 'content']);
    }

    public function render()
    {
        return view('livewire.admin.notice-board', [
            'notices' => Notice::latest()->paginate(5),
        ]);
    }
}
