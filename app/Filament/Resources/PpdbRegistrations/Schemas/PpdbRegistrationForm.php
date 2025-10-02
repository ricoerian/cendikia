<?php

namespace App\Filament\Resources\PpdbRegistrations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;

class PpdbRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Formulir Pendaftaran')->tabs([
                    Tab::make('Data Pendaftaran')->schema([
                        Section::make('Informasi Pendaftaran')->columns(2)->schema([
                            TextInput::make('registration_number')->label('No. Pendaftaran')->default('PPDB-' . date('YmdHis'))->required(),
                            Select::make('status')->options([
                                'pending' => 'Pending', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'
                            ])->default('pending')->required(),
                            Select::make('first_choice_major_id')
                                ->relationship('firstChoiceMajor', 'name')
                                ->label('Pilihan Jurusan 1'),
                            Select::make('second_choice_major_id')
                                ->relationship('secondChoiceMajor', 'name')
                                ->label('Pilihan Jurusan 2'),
                        ]),
                        Section::make('Data Pribadi Siswa')->columns(2)->schema([
                            TextInput::make('name')->label('Nama Lengkap')->required(),
                            TextInput::make('nisn')->label('NISN')->unique(ignoreRecord: true),
                            TextInput::make('nik_student')->label('NIK Siswa')->unique(ignoreRecord: true),
                            TextInput::make('place_of_birth')->label('Tempat Lahir'),
                            DatePicker::make('date_of_birth')->label('Tanggal Lahir'),
                            Select::make('gender')->label('Jenis Kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                            TextInput::make('religion')->label('Agama'),
                            TextInput::make('citizenship')->label('Kewarganegaraan'),
                            TextInput::make('child_order_in_family')->label('Anak ke-')->numeric(),
                            TextInput::make('number_of_siblings')->label('Jumlah Saudara')->numeric(),
                            Textarea::make('address')->label('Alamat Lengkap')->columnSpanFull(),
                            TextInput::make('phone_number')->label('No. HP Siswa')->tel(),
                            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                            FileUpload::make('photo')
                                ->label('Pas Photo')
                                ->image()
                                ->directory('ppdb-photos')
                                ->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Data Orang Tua & Wali')->schema([
                        Section::make('Data Ayah Kandung')->columns(2)->schema([
                            TextInput::make('father_name')->label('Nama Ayah'),
                            TextInput::make('father_nik')->label('NIK Ayah'),
                            DatePicker::make('father_birth_date')->label('Tanggal Lahir Ayah'),
                            TextInput::make('father_education')->label('Pendidikan Ayah'),
                            TextInput::make('father_occupation')->label('Pekerjaan Ayah'),
                            TextInput::make('father_income')->label('Penghasilan Ayah'),
                            TextInput::make('father_religion')->label('Agama Ayah'),
                            Textarea::make('father_address')->label('Alamat Ayah')->columnSpanFull(),
                        ]),
                        Section::make('Data Ibu Kandung')->columns(2)->schema([
                            TextInput::make('mother_name')->label('Nama Ibu'),
                            TextInput::make('mother_nik')->label('NIK Ibu'),
                            DatePicker::make('mother_birth_date')->label('Tanggal Lahir Ibu'),
                            TextInput::make('mother_education')->label('Pendidikan Ibu'),
                            TextInput::make('mother_occupation')->label('Pekerjaan Ibu'),
                            TextInput::make('mother_income')->label('Penghasilan Ibu'),
                            TextInput::make('mother_religion')->label('Agama Ibu'),
                            Textarea::make('mother_address')->label('Alamat Ibu')->columnSpanFull(),
                        ]),
                        Section::make('Data Wali (Jika Ada)')->columns(2)->schema([
                            TextInput::make('guardian_name')->label('Nama Wali'),
                            TextInput::make('guardian_phone_number')->label('No. HP Wali'),
                            TextInput::make('guardian_relationship')->label('Hubungan Wali'),
                            Textarea::make('guardian_address')->label('Alamat Wali')->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Data Tambahan')->schema([
                        Section::make('Data Lainnya')->columns(2)->schema([
                            TextInput::make('transportation_mode')->label('Transportasi'),
                            TextInput::make('distance_to_school')->label('Jarak ke Sekolah (meter)')->numeric(),
                            TextInput::make('family_card_number')->label('No. Kartu Keluarga'),
                            TextInput::make('kip_number')->label('No. KIP (jika ada)'),
                            TextInput::make('kps_number')->label('No. KPS (jika ada)'),
                        ]),
                        Section::make('Informasi Referensi')->schema([
                            Select::make('reference_source')
                                ->label('Dapat informasi pendaftaran dari mana?')
                                ->options([
                                    'Guru' => 'Guru',
                                    'Siswa' => 'Siswa',
                                    'Alumni' => 'Alumni',
                                    'Website' => 'Website Sekolah',
                                    'Instagram' => 'Instagram',
                                    'TikTok' => 'TikTok',
                                    'Facebook' => 'Facebook',
                                    'Brosur' => 'Brosur / Spanduk',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->live(),

                            TextInput::make('reference_details')
                                ->label('Sebutkan Nama / Detail Referensi')
                                ->visible(fn ($get) => in_array($get('reference_source'), ['Guru', 'Siswa', 'Alumni', 'Instagram', 'TikTok', 'Facebook'])),
                        ]),
                        Section::make('Data Kesehatan')->columns(3)->schema([
                            TextInput::make('height')->label('Tinggi Badan (cm)')->numeric(),
                            TextInput::make('weight')->label('Berat Badan (kg)')->numeric(),
                            TextInput::make('blood_type')->label('Golongan Darah'),
                            Textarea::make('medical_history')->label('Riwayat Penyakit')->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Riwayat Pendidikan')->schema([
                        Repeater::make('educationalHistories')->relationship()->schema([
                            Select::make('level')->options(['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP'])->required(),
                            TextInput::make('school_name')->required(),
                            TextInput::make('city')->required(),
                            TextInput::make('graduation_year')->numeric()->required(),
                        ])->columns(4)->addActionLabel('Tambah Riwayat'),
                    ]),
                    Tab::make('Saudara Kandung')->schema([
                        Repeater::make('siblings')->relationship()->schema([
                            TextInput::make('name')->required(),
                            Select::make('gender')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->required(),
                            DatePicker::make('date_of_birth')->required(),
                            TextInput::make('current_school_or_occupation')->label('Sekolah / Pekerjaan Saat Ini')->required(),
                        ])->columns(4)->addActionLabel('Tambah Saudara'),
                    ]),
                    Tab::make('Prestasi')->schema([
                        Repeater::make('achievements')->relationship()->schema([
                            TextInput::make('achievement_name')->label('Nama Prestasi')->required(),
                            Select::make('level')->options(['Kabupaten' => 'Kabupaten', 'Provinsi' => 'Provinsi', 'Nasional' => 'Nasional', 'Internasional' => 'Internasional'])->required(),
                            TextInput::make('year')->numeric()->required(),
                            Textarea::make('description')->label('Deskripsi')->columnSpanFull(),
                        ])->columns(3)->addActionLabel('Tambah Prestasi'),
                    ]),
                    Tab::make('Berkas Dokumen')->schema([
                        FileUpload::make('documents')->multiple()->directory('ppdb-documents'),
                    ]),
                ])->columnSpanFull(),
            ]);
    }
}
