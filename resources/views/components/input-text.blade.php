@props([
    'label',
    'name',
    'placeholder' => '',
    'readonly' => false,
    'required' => false,
    'type' => 'text',
    'value' => '',
])

<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="obrigatório">*</sup>
        @endif
    </label>
    <div class="col-sm-10">
        <input
            type="{{ $type }}"
            class="form-control bg-dark text-light border-dark"
            placeholder="{{ $placeholder }}"
            name="{{ $name }}"
            @if ($required) required @endif
            @if ($readonly) readonly @endif
            value="{{ $value }}">
        @error($name)
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
        @enderror
    </div>
</div>
