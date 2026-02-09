import pandas as pd
import os

# 1. KONFIGURASI
input_file = '[2027] Rekap Data DLH🌿.xlsx - MAKAM DESA.csv' # Sesuaikan nama filemu
output_file = 'MakamDesaSeeder.php'

# 2. BACA DATA
# Header ada di baris ke-5 (index 4)
df = pd.read_csv(input_file, header=4)

# 3. PROSES DATA
current_kecamatan = "UNKNOWN"
sql_statements = []

print("Sedang memproses data...")

for index, row in df.iterrows():
    col_no = str(row['NO']) # Kolom pertama
    nama_petugas = row['NAMA PETUGAS MAKAM']
    
    # Deteksi Baris Kecamatan (Header Grup)
    if 'KECAMATAN' in col_no.upper():
        current_kecamatan = col_no.upper().replace('KECAMATAN', '').strip()
        continue # Skip baris ini, lanjut ke bawah
        
    # Skip jika Nama Petugas kosong (baris sampah)
    if pd.isna(nama_petugas):
        continue

    # Bersihkan data
    alamat = str(row['ALAMAT PETUGAS']).replace("'", "\\'") # Escape tanda petik
    nik = str(row['NIK KTP']).replace('-', '').replace(' ', '').replace('.0', '')
    makam = str(row['NAMA MAKAM DAN ALAMATNYA']).replace("'", "\\'")
    kelurahan = str(row['KELURAHAN']).strip()

    # Buat Array PHP
    data_str = f"""
            [
                'kecamatan'      => '{current_kecamatan}',
                'nama_petugas'   => '{nama_petugas}',
                'alamat_petugas' => '{alamat}',
                'nik'            => '{nik}',
                'nama_makam'     => '{makam}',
                'kelurahan'      => '{kelurahan}',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],"""
    sql_statements.append(data_str)

# 4. TULIS KE FILE PHP
php_content = f"""<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakamDesaSeeder extends Seeder
{{
    public function run()
    {{
        // Kosongkan tabel dulu
        DB::table('makam_desa')->truncate();

        // Insert data (Total: {len(sql_statements)} baris)
        DB::table('makam_desa')->insert([{''.join(sql_statements)}
        ]);
    }}
}}
"""

with open(output_file, 'w', encoding='utf-8') as f:
    f.write(php_content)

print(f"SUKSES! File '{output_file}' berhasil dibuat dengan {len(sql_statements)} data.")