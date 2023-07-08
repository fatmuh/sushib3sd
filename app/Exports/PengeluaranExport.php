<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PengeluaranExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{

    private $result;
    private $total_pengeluaran;

    /**
     * Create a new exporter instance.
     *
     * @param array $results query result
     *
     * @return void
     */
    public function __construct($results, $total)
    {
        $this->result = $results;
        $this->total_pengeluaran =  $total;
    }

    /**
     * Load the view.
     *
     * @return void
     */
    public function view(): View
    {
        return view(
            'pages.laporan.export.pengeluaran',
            [
                'reports' => $this->result,
                'total_pengeluaran' => $this->total_pengeluaran,
            ]
        );
    }
}
