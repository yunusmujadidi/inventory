@php $editing = isset($barangKeluar) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="tanggal_keluar"
            label="Tanggal Keluar"
            value="{{ old('tanggal_keluar', ($editing ? optional($barangKeluar->tanggal_keluar)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="jumlah_keluar"
            label="Jumlah Keluar"
            value="{{ old('jumlah_keluar', ($editing ? $barangKeluar->jumlah_keluar : '')) }}"
            maxlength="255"
            placeholder="Jumlah Keluar"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="lokasi_id" label="Lokasi" required>
            @php $selected = old('lokasi_id', ($editing ? $barangKeluar->lokasi_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lokasi</option>
            @foreach($lokasis as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="barang_id" label="Barang" required>
            @php $selected = old('barang_id', ($editing ? $barangKeluar->barang_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Barang</option>
            @foreach($barangs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
