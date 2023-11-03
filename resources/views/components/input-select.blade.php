@props([
    'label',
    'name',
    'placeholder' => '',
    'readonly' => false,
    'required' => false,
    'value' => '',
    'options' => [],
])

<div class="mb-3 row">
    <label for="{{ $name }}" class="col-sm-2 col-form-label">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="obrigatório">*</sup>
        @endif
    </label>
    <div class="col-sm-10">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control bg-dark text-light border-dark"
            @if ($required) required @endif
            @if ($readonly) readonly @endif
        >
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $item)
                <option
                    value="{{ $item['id'] }}"
                    @if ($value == $item['id'])
                        selected="selected"
                    @endif
                >{{ $item['value'] }}</option>
            @endforeach
        </select>
        @error($name)
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>
</div>
