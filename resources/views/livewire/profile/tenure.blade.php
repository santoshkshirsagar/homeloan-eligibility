<div>
    @if($edit)
        <input type="text" wire:model="tenure" size="3">
        @error('tenure')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <a wire:click="save" class="btn btn-sm btn-primary">Save</a>
    @else
        {{ $tenure }} <a wire:click="editTenure" class="btn btn-sm btn-primary">Edit</a>
    @endif
</div>
