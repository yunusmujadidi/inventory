@php $editing = isset($merek) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="merek"
            label="Merek"
            value="{{ old('merek', ($editing ? $merek->merek : '')) }}"
            maxlength="255"
            placeholder="Merek"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
