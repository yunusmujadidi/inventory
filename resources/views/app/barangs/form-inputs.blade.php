@php $editing = isset($barang) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="kode_barang"
            label="Kode Barang"
            value="{{ old('kode_barang', ($editing ? $barang->kode_barang : '')) }}"
            maxlength="255"
            placeholder="Kode Barang"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nama_barang"
            label="Nama Barang"
            value="{{ old('nama_barang', ($editing ? $barang->nama_barang : '')) }}"
            maxlength="255"
            placeholder="Nama Barang"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="stok"
            label="Stok"
            value="{{ old('stok', ($editing ? $barang->stok : '')) }}"
            maxlength="255"
            placeholder="Stok"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="harga"
            label="Harga"
            value="{{ old('harga', ($editing ? $barang->harga : '')) }}"
            max="255"
            step="0.01"
            placeholder="Harga"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="merek_id" label="Merek" required>
            @php $selected = old('merek_id', ($editing ? $barang->merek_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Merek</option>
            @foreach($mereks as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="kategori_id" label="Kategori" required>
            @php $selected = old('kategori_id', ($editing ? $barang->kategori_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kategori</option>
            @foreach($kategoris as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="lokasi_id" label="Lokasi" required>
            @php $selected = old('lokasi_id', ($editing ? $barang->lokasi_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lokasi</option>
            @foreach($lokasis as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
