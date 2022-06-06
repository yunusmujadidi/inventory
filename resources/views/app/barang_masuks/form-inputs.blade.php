@php $editing = isset($barangMasuk) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="tanggal_masuk"
            label="Tanggal Masuk"
            value="{{ old('tanggal_masuk', ($editing ? optional($barangMasuk->tanggal_masuk)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="jumlah_masuk"
            label="Jumlah Masuk"
            value="{{ old('jumlah_masuk', ($editing ? $barangMasuk->jumlah_masuk : '')) }}"
            maxlength="255"
            placeholder="Jumlah Masuk"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="supplier_id" label="Supplier" required>
            @php $selected = old('supplier_id', ($editing ? $barangMasuk->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="barang_id" label="Barang" required>
            @php $selected = old('barang_id', ($editing ? $barangMasuk->barang_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Barang</option>
            @foreach($barangs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
