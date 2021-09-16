<div>
<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label for="mobile">Enter Mobile Number</label>
        <input type="text" maxlength="10" wire:model="mobile" class="form-control" autofocus>
        @error('mobile')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Continue</button>
</form>
</div>
