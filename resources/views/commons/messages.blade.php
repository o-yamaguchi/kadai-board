@if (session('success'))
<div class="alert alert-success mb-2">
    <div class="w-full text-left">{{ session('success') }}</div>
</div>
@endif

@if (session('error'))
<div class="alert alert-error mb-2">
    <divclass="w-full text-left">{{ session('error') }}</div>
</div>
    
@endif