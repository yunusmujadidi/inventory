<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'barang' => [
        'name' => 'Barang',
        'index_title' => 'Barangs List',
        'new_title' => 'New Barang',
        'create_title' => 'Create Barang',
        'edit_title' => 'Edit Barang',
        'show_title' => 'Show Barang',
        'inputs' => [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'stok' => 'Stok',
            'harga' => 'Harga',
            'merek_id' => 'Merek',
            'kategori_id' => 'Kategori',
            'lokasi_id' => 'Lokasi',
        ],
    ],

    'supplier' => [
        'name' => 'Supplier',
        'index_title' => 'Suppliers List',
        'new_title' => 'New Supplier',
        'create_title' => 'Create Supplier',
        'edit_title' => 'Edit Supplier',
        'show_title' => 'Show Supplier',
        'inputs' => [
            'nama_supplier' => 'Nama Supplier',
            'alamat' => 'Alamat',
            'telp' => 'Telp',
            'kategori_id' => 'Kategori',
        ],
    ],

    'barang_masuk' => [
        'name' => 'Barang Masuk',
        'index_title' => 'BarangMasuks List',
        'new_title' => 'New Barang masuk',
        'create_title' => 'Create BarangMasuk',
        'edit_title' => 'Edit BarangMasuk',
        'show_title' => 'Show BarangMasuk',
        'inputs' => [
            'tanggal_masuk' => 'Tanggal Masuk',
            'jumlah_masuk' => 'Jumlah Masuk',
            'supplier_id' => 'Supplier',
            'barang_id' => 'Barang',
        ],
    ],

    'barang_keluar' => [
        'name' => 'Barang Keluar',
        'index_title' => 'BarangKeluars List',
        'new_title' => 'New Barang keluar',
        'create_title' => 'Create BarangKeluar',
        'edit_title' => 'Edit BarangKeluar',
        'show_title' => 'Show BarangKeluar',
        'inputs' => [
            'tanggal_keluar' => 'Tanggal Keluar',
            'jumlah_keluar' => 'Jumlah Keluar',
            'lokasi_id' => 'Lokasi',
            'barang_id' => 'Barang',
        ],
    ],

    'kategori' => [
        'name' => 'Kategori',
        'index_title' => 'Kategoris List',
        'new_title' => 'New Kategori',
        'create_title' => 'Create Kategori',
        'edit_title' => 'Edit Kategori',
        'show_title' => 'Show Kategori',
        'inputs' => [
            'kategori' => 'Kategori',
        ],
    ],

    'lokasi' => [
        'name' => 'Lokasi',
        'index_title' => 'Lokasis List',
        'new_title' => 'New Lokasi',
        'create_title' => 'Create Lokasi',
        'edit_title' => 'Edit Lokasi',
        'show_title' => 'Show Lokasi',
        'inputs' => [
            'lokasi' => 'Lokasi',
        ],
    ],

    'merek' => [
        'name' => 'Merek',
        'index_title' => 'Mereks List',
        'new_title' => 'New Merek',
        'create_title' => 'Create Merek',
        'edit_title' => 'Edit Merek',
        'show_title' => 'Show Merek',
        'inputs' => [
            'merek' => 'Merek',
        ],
    ],

    'user' => [
        'name' => 'User',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'posisi_id' => 'Posisi',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
