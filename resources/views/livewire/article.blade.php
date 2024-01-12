<div>
    <form wire:submit="save">
        <input type="text" wire:model="title">
        <div>
            @error('title') <span class="error">{{ $message }}</span> @enderror 
        </div>
     
        
     
        <button type="submit">Save</button>
    </form>
</div>
