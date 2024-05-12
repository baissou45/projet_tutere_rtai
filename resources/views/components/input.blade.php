@props(['libelle', 'type', 'size', 'value' => null, 'name', 'disabled' => false, 'required' => false, "readonly" => false, "min" => null, "max" => null])

<div class="form-group {{ $size }}">
    <label for="{{ $name }}" class="{{ $errors->first($name) != null ? 'text-danger' : '' }}"> {{ $libelle }} <span class="text-danger"> {{ $required ? "*" : "" }} </span> </label>
    <input id="{{ $name }}" class="form-control {{ $errors->first($name) != null ? 'border-danger text-danger' : '' }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? "readonly" : "" }} {{ $min != null ? "min='$min'" : '' }} {{ $max != null ? "max='$max'" : '' }} >
    @error($name)
        <small class="text-danger"> {{ $errors->first($name) }} </small>
    @enderror
</div>