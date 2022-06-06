@php $editing = isset($kategori) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="kategori"
            label="Kategori"
            value="{{ old('kategori', ($editing ? $kategori->kategori : '')) }}"
            maxlength="255"
            placeholder="Kategori"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
