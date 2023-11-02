@props([
    'label',
    'placeholder',
    'name',
    'value',
])

<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-sm-10">
        <input
            type="text"
            class="form-control bg-dark text-light border-dark"
            placeholder="{{ $placeholder }}"
            name="{{ $name }}"
            value="{{ $value }}">
        @error($name)
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
        @enderror
    </div>
</div>
