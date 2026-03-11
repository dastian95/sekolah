<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentImportController extends Controller
{
    /**
     * Show form untuk import data siswa dari Excel
     */
    public function showImportForm()
    {
        return view('admin.import-siswa');
    }

    /**
     * Handle import Excel file
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            $file = $request->file('excel_file');
            
            // Load Excel file menggunakan PhpSpreadsheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            $imported = 0;
            $failed = 0;
            $errors = [];

            // Skip header row (row 1)
            foreach ($data as $index => $row) {
                if ($index === 0) continue; // Skip header

                try {
                    // Parse data dari Excel
                    $studentData = $this->parseExcelRow($row);

                    // Generate UID jika belum ada
                    if (empty($studentData['uid'])) {
                        $studentData['uid'] = Str::uuid();
                    }

                    // Generate username dari nama jika belum ada
                    if (empty($studentData['username'])) {
                        $studentData['username'] = $this->generateUsername($studentData['nama'] ?? 'student');
                    }

                    // Generate password default jika belum ada
                    if (empty($studentData['password'])) {
                        $studentData['password'] = bcrypt('12345678'); // Default password
                    } else {
                        $studentData['password'] = bcrypt($studentData['password']);
                    }

                    // Cek apakah sudah ada data dengan NISN atau NIS yang sama
                    if (!empty($studentData['nisn'])) {
                        $exists = Student::where('nisn', $studentData['nisn'])->first();
                        if ($exists) {
                            $failed++;
                            $errors[] = "Baris " . ($index + 1) . ": NISN {$studentData['nisn']} sudah ada di database";
                            continue;
                        }
                    }

                    if (!empty($studentData['nis'])) {
                        $exists = Student::where('nis', $studentData['nis'])->first();
                        if ($exists) {
                            $failed++;
                            $errors[] = "Baris " . ($index + 1) . ": NIS {$studentData['nis']} sudah ada di database";
                            continue;
                        }
                    }

                    // Create student record
                    Student::create($studentData);
                    $imported++;

                } catch (\Exception $e) {
                    $failed++;
                    $errors[] = "Baris " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            // Redirect dengan pesan hasil
            if ($failed === 0) {
                return redirect()->back()->with('success', "Berhasil import {$imported} data siswa!");
            } else {
                return redirect()->back()
                    ->with('warning', "Import selesai dengan {$imported} berhasil, {$failed} gagal")
                    ->with('errors', $errors);
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }

    /**
     * Parse Excel row data ke format Student
     */
    private function parseExcelRow($row)
    {
        // Sesuaikan dengan order column Excel Anda
        // Contoh: Column A=NISN, B=NIS, C=Nama, dst
        return [
            'nisn' => $this->cleanValue($row[0] ?? null),
            'nis' => $this->cleanValue($row[1] ?? null),
            'nama' => $this->cleanValue($row[2] ?? null),
            'jenis_kelamin' => $this->cleanValue($row[3] ?? null),
            'username' => $this->cleanValue($row[4] ?? null),
            'password' => $this->cleanValue($row[5] ?? null),
            'kelas_awal' => $this->cleanValue($row[6] ?? null),
            'tahun_masuk' => $this->cleanValue($row[7] ?? null),
            'sekolah_asal' => $this->cleanValue($row[8] ?? null),
            'tempat_lahir' => $this->cleanValue($row[9] ?? null),
            'tanggal_lahir' => $this->parseDate($row[10] ?? null),
            'agama' => $this->cleanValue($row[11] ?? null),
            'hp' => $this->cleanValue($row[12] ?? null),
            'email' => $this->cleanValue($row[13] ?? null),
            'foto' => $this->cleanValue($row[14] ?? 'siswa.png'),
            'anak_ke' => $this->cleanValue($row[15] ?? null),
            'status_keluarga' => $this->cleanValue($row[16] ?? null),
            'alamat' => $this->cleanValue($row[17] ?? null),
            'rt' => $this->cleanValue($row[18] ?? null),
            'rw' => $this->cleanValue($row[19] ?? null),
            'kelurahan' => $this->cleanValue($row[20] ?? null),
            'kecamatan' => $this->cleanValue($row[21] ?? null),
            'kabupaten' => $this->cleanValue($row[22] ?? null),
            'provinsi' => $this->cleanValue($row[23] ?? null),
            'kode_pos' => $this->cleanValue($row[24] ?? null),
            'nama_ayah' => $this->cleanValue($row[25] ?? null),
            'tgl_lahir_ayah' => $this->parseDate($row[26] ?? null),
            'pendidikan_ayah' => $this->cleanValue($row[27] ?? null),
            'pekerjaan_ayah' => $this->cleanValue($row[28] ?? null),
            'nohp_ayah' => $this->cleanValue($row[29] ?? null),
            'alamat_ayah' => $this->cleanValue($row[30] ?? null),
            'nama_ibu' => $this->cleanValue($row[31] ?? null),
            'tgl_lahir_ibu' => $this->parseDate($row[32] ?? null),
            'pendidikan_ibu' => $this->cleanValue($row[33] ?? null),
            'pekerjaan_ibu' => $this->cleanValue($row[34] ?? null),
            'nohp_ibu' => $this->cleanValue($row[35] ?? null),
            'alamat_ibu' => $this->cleanValue($row[36] ?? null),
            'nama_wali' => $this->cleanValue($row[37] ?? null),
            'tgl_lahir_wali' => $this->parseDate($row[38] ?? null),
            'pendidikan_wali' => $this->cleanValue($row[39] ?? null),
            'pekerjaan_wali' => $this->cleanValue($row[40] ?? null),
            'nohp_wali' => $this->cleanValue($row[41] ?? null),
            'alamat_wali' => $this->cleanValue($row[42] ?? null),
            'nik' => $this->cleanValue($row[43] ?? null),
            'warga_negara' => $this->cleanValue($row[44] ?? 'Indonesia'),
            'uid' => Str::uuid(),
            'status' => 'verified', // Data dari import langsung verified
        ];
    }

    /**
     * Clean dan convert nilai Excel
     */
    private function cleanValue($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        return trim((string)$value);
    }

    /**
     * Parse date dari berbagai format
     */
    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Jika numerik (Excel date format)
            if (is_numeric($value)) {
                return \Carbon\Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                );
            }

            // Jika string, coba parse
            return \Carbon\Carbon::createFromFormat('d/m/Y', $value)
                ?? \Carbon\Carbon::createFromFormat('Y-m-d', $value)
                ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Generate unique username dari nama
     */
    private function generateUsername($nama)
    {
        $baseUsername = Str::slug(str_replace(' ', '', $nama), '');
        $username = $baseUsername;
        $counter = 1;

        while (Student::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Download template Excel
     */
    public function downloadTemplate()
    {
        // Buat template Excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row
        $headers = [
            'NISN', 'NIS', 'Nama', 'Jenis Kelamin', 'Username', 'Password',
            'Kelas Awal', 'Tahun Masuk', 'Sekolah Asal', 'Tempat Lahir', 'Tanggal Lahir',
            'Agama', 'HP', 'Email', 'Foto',
            'Anak Ke', 'Status Keluarga', 'Alamat', 'RT', 'RW',
            'Kelurahan', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Kode Pos',
            'Nama Ayah', 'Tgl Lahir Ayah', 'Pendidikan Ayah', 'Pekerjaan Ayah', 'NoHP Ayah', 'Alamat Ayah',
            'Nama Ibu', 'Tgl Lahir Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu', 'NoHP Ibu', 'Alamat Ibu',
            'Nama Wali', 'Tgl Lahir Wali', 'Pendidikan Wali', 'Pekerjaan Wali', 'NoHP Wali', 'Alamat Wali',
            'NIK', 'Warga Negara'
        ];

        $sheet->fromArray([$headers], null, 'A1');

        // Style header
        $sheet->getStyle('A1:AS1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'fgColor' => ['rgb' => '1a3a5c']],
        ]);

        // Auto size columns
        foreach (range('A', 'AS') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Write file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'template_siswa_' . now()->format('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
