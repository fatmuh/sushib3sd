<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    protected $collection;
    protected $counter = 0;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Kode Transaksi',
            'Nama Pelanggan',
            'Total Harga',
            'Kasir',
            // Tambahkan header kolom lainnya sesuai dengan kebutuhan Anda
        ];
    }

    public function map($row): array
    {
        $this->counter++;
        return [
            $this->counter,
            Carbon::parse($row->created_at)->format('d-m-Y'),
            $row->transaction_code,
            $row->customer_name,
            $row->price_total, // Add 'IDR' prefix to price_total
            $row->created_by,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 10,
            'F' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $lastRow = $event->sheet->getHighestRow();

                // Menggabungkan sel "Total Harga"
                $event->sheet->mergeCells('A' . ($lastRow + 2) . ':D' . ($lastRow + 2));

                // Mengatur teks pada sel "Total Harga"
                $event->sheet->setCellValue('A' . ($lastRow + 2), 'Total Harga');

                // Mengatur atribut colspan=4 pada sel "Total Harga"
                $event->sheet->getStyle('A' . ($lastRow + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Mengatur teks pada sel "Total Harga" menjadi tebal
                $event->sheet->getStyle('A' . ($lastRow + 2))->getFont()->setBold(true);

                // Mengatur rumus untuk menjumlahkan kolom Total Harga
                $event->sheet->setCellValue('E' . ($lastRow + 2), '=SUM(E2:E' . $lastRow . ')');

                // Menambahkan currency format untuk sel Total Harga
                $event->sheet->getStyle('E' . ($lastRow + 2))->getNumberFormat()->setFormatCode('#,##0.00 "IDR"');
            },
        ];
    }
}
