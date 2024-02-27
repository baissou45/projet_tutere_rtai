@props(['libelle', 'type', 'size', 'value' => null, 'name', 'disabled' => false, 'required' => false])

<div class="form-group {{ $size }}">
    <label for="{{ $name }}" class="{{ $errors->first($name) != null ? 'text-danger' : '' }}"> {{ $libelle }} <span class="text-danger"> {{ $required ? "*" : "" }} </span> </label>
    <input id="{{ $name }}" class="form-control {{ $errors->first($name) != null ? 'border-danger text-danger' : '' }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $disabled ? 'disabled' : '' }}>
    @error($name)
        <small class="text-danger"> {{ $errors->first($name) }} </small>
    @enderror
</div>