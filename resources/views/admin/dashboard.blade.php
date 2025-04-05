@include('admin.admin-nav')
<div style="width: 87%; margin-left: 7%; margin-top: 5rem;">
    <livewire:admin.building-form/>
    <br/>
    <br/>
    <livewire:admin.floor-form/>
    <br/>
    <br/>
    <livewire:admin.unit-form/>

    {{-- Main Content --}}
    <div class="w-3/4 p-6">
        <h1 class="text-2xl font-bold mb-4">Welcome, Admin 👋</h1>
        <p>Use the sidebar to manage your facilities.</p>
    </div>
</div>