@php $editing = isset($supplier) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nama_supplier"
            label="Nama Supplier"
            value="{{ old('nama_supplier', ($editing ? $supplier->nama_supplier : '')) }}"
            placeholder="Nama Supplier"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="alamat"
            label="Alamat"
            value="{{ old('alamat', ($editing ? $supplier->alamat : '')) }}"
            maxlength="255"
            placeholder="Alamat"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="telp"
            label="Telp"
            value="{{ old('telp', ($editing ? $supplier->telp : '')) }}"
            max="255"
            placeholder="Telp"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="kategori_id" label="Kategori" required>
            @php $selected = old('kategori_id', ($editing ? $supplier->kategori_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kategori</option>
            @foreach($kategoris as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
