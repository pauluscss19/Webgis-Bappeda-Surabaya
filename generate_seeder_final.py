import pandas as pd
import os
import sys
from datetime import datetime, timedelta
import random

EXCEL_FILE = '[2027] Rekap Data DLH🌿.xlsx'

def clean_num(val):
    s = str(val).strip().replace(',', '').replace('Rp', '').replace(' ', '')
    if s in ['nan', '', '-', '.', 'Min', 'Max']: return 0
    try: return float(s)
    except: return 0

# Harga BBM (Sesuai Header Excel)
HARGA_SOLAR = 6800
HARGA_DEXLITE = 14550
HARGA_PERTAMAX = 12950

print(f"🚀 MEMULAI GENERATOR SEEDER (TARGET: 7940 DATA)...")

if not os.path.exists(EXCEL_FILE):
    print("❌ ERROR: File data.xlsx tidak ditemukan!")
    sys.exit()

php_content = """<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SarprasSeeder extends Seeder {
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = ['master_fasilitas_rinci', 'master_bank_sampah', 'laporan_tps3r_harian', 
                   'laporan_b3_rt', 'master_armada', 'laporan_bbm', 'laporan_tpa_rekap'];
        foreach($tables as $tbl) { DB::table($tbl)->truncate(); }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data_fasilitas = []; $data_bank = []; $data_tps3r = []; 
        $data_b3 = []; $data_armada = []; $data_bbm = []; $data_tpa = [];
"""

try:
    # 1. FASILITAS
    print("1. Processing: SARPRAS RINCI...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='SARPRAS RINCI', header=0)
    for i, row in df.iterrows():
        nama = str(row['NAMA FASILITAS'])
        if nama != 'nan':
            php_content += f"""
        $data_fasilitas[] = ['jenis_fasilitas' => "{str(row['JENIS FASILITAS']).strip()}", 'nama_fasilitas' => "{nama.strip().replace('"', '')}", 'timbulan_sampah_masuk_kg' => {clean_num(row['TIMBULAN SAMPAH MASUK (Kg)'])}, 'created_at' => now()];"""

    # 2. BANK SAMPAH
    print("2. Processing: BANK SAMPAH...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='BANK SAMPAH 670', header=3)
    for i, row in df.iterrows():
        if str(row['NO']).isdigit():
            php_content += f"""
        $data_bank[] = ['nama_bank_sampah' => "{str(row['NAMA BANK SAMPAH']).replace('"', '')}", 'tonase_kg_bulan' => {clean_num(row['TONASE (KG/BULAN)'])}, 'created_at' => now()];"""

    # 3. TPS3R (GENERATE HARIAN - 6 BULAN / 180 HARI)
    print("3. Processing: TPS3R (Generating 180 Days Data)...")
    # Baca raw tanpa header untuk akses index pasti
    df = pd.read_excel(EXCEL_FILE, sheet_name='TPS3R', header=None)
    # Data mulai baris index 5
    for i, row in df.iloc[5:].iterrows():
        lokasi = str(row[1])
        if lokasi != 'nan' and 'LOKASI' not in lokasi:
            # Ambil rata-rata harian dari Excel
            avg_masuk = clean_num(row[2]) 
            avg_residu = clean_num(row[12])
            
            # GENERATE 180 HARI SAJA (AGAR TOTAL ~7900 SEPERTI SEEDER LAMA)
            php_content += f"""
        // Lokasi: {lokasi.replace('"', '')}
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {{
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = {avg_masuk} * (rand(90, 110) / 100);
            $residu = {avg_residu} * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "{lokasi.replace('"', '')}", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }}"""

    # 4. ARMADA
    print("4. Processing: ARMADA...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='ARMADA TRUK', header=None)
    for i, row in df.iterrows():
        if str(row[1]) in ['Dump Truk', 'Arm Roll Truck ', 'Compactor']:
            php_content += f"""
        $data_armada[] = ['jenis_kendaraan' => "{row[1]}", 'jumlah_unit' => {clean_num(row[2])}, 'created_at' => now()];"""

    # 5. BBM (DENGAN NOMINAL RUPIAH)
    print("5. Processing: BBM PENGANGKUTAN...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='BBM PENGANGKUTAN', header=None)
    for i, row in df.iloc[6:].iterrows(): # Data mulai baris 6
        bulan = str(row[1])
        if bulan.replace('.','').isdigit():
            # Sum Pertamax (Col 4 + 6)
            pertamax_liter = clean_num(row[4]) + clean_num(row[6])
            # Sum Dexlite (Col 8 + 10)
            dexlite_liter = clean_num(row[8]) + clean_num(row[10])
            # Sum Solar (Col 12 + 14)
            solar_liter = clean_num(row[12]) + clean_num(row[14])
            
            # Hitung Biaya
            biaya_p = pertamax_liter * HARGA_PERTAMAX
            biaya_d = dexlite_liter * HARGA_DEXLITE
            biaya_s = solar_liter * HARGA_SOLAR
            
            nama_bulan = datetime(2025, int(float(bulan)), 1).strftime('%B')
            
            php_content += f"""
        $data_bbm[] = [
            'bulan_ke' => {int(float(bulan))}, 
            'nama_bulan' => '{nama_bulan}',
            'solar_liter' => {solar_liter}, 'dexlite_liter' => {dexlite_liter}, 'pertamax_liter' => {pertamax_liter},
            'biaya_solar' => {biaya_s}, 'biaya_dexlite' => {biaya_d}, 'biaya_pertamax' => {biaya_p},
            'created_at' => now()
        ];"""

    # 6. TPA (DENGAN NOMINAL RUPIAH)
    print("6. Processing: SAMPAH KE TPA...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='SAMPAH KE TPA', header=1)
    for i, row in df.iterrows():
        if str(row['TAHUN']).isdigit():
            rp = str(row.iloc[3]).replace(',', '').replace('.', '').replace(' ', '')
            php_content += f"""
        $data_tpa[] = ['tahun' => {int(row['TAHUN'])}, 'total_tonase' => {clean_num(row['Realisasi Tonase/tahun'])}, 'biaya_tipping_fee' => {clean_num(rp)}, 'created_at' => now()];"""
    
    # 7. B3
    print("7. Processing: B3...")
    df = pd.read_excel(EXCEL_FILE, sheet_name='B3 RT', header=None)
    for i, row in df.iloc[5:15].iterrows():
         if str(row[2]) != 'nan':
             php_content += f"""
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => {clean_num(row[13])}, 'created_at' => now()];"""

    php_content += """
        foreach(array_chunk($data_fasilitas, 500) as $c) DB::table('master_fasilitas_rinci')->insert($c);
        foreach(array_chunk($data_bank, 500) as $c) DB::table('master_bank_sampah')->insert($c);
        foreach(array_chunk($data_armada, 500) as $c) DB::table('master_armada')->insert($c);
        foreach(array_chunk($data_bbm, 500) as $c) DB::table('laporan_bbm')->insert($c);
        foreach(array_chunk($data_tpa, 500) as $c) DB::table('laporan_tpa_rekap')->insert($c);
        
        // INSERT TPS3R (CHUNK BESAR)
        foreach(array_chunk($data_tps3r, 1000) as $c) DB::table('laporan_tps3r_harian')->insert($c);
        
        if(!empty($data_b3)) DB::table('laporan_b3_rt')->insert($data_b3);
    }
}
"""
    with open('SarprasSeeder.php', 'w', encoding='utf-8') as f: f.write(php_content)
    print("✅ SUKSES! Seeder 7940 Data (+Rupiah) berhasil dibuat.")

except Exception as e: print(f"❌ ERROR: {e}")