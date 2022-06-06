@php $editing = isset($lokasi) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="lokasi"
            label="Lokasi"
            value="{{ old('lokasi', ($editing ? $lokasi->lokasi : '')) }}"
            maxlength="255"
            placeholder="Lokasi"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
