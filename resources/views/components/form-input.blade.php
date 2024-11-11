<div>
    <label for="{{ $id }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    <input 
        class="form-control @error($name) is-invalid @enderror" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($name) ?? $value }}"
        @if($required) required @endif
    >
</div>
