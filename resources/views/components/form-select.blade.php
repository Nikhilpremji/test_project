<select name="{{ $name }}" id="{{ $id }}" class="form-control" {{ $attributes }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $display)
        <option value="{{ $value }}" {{ old($name, $selected ?? '') == $value ? 'selected' : '' }}>{{ $display }}</option>
    @endforeach
</select>
