<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\Exports\PengeluaranExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if ($startDate && !$endDate) {
            return redirect()->route('laporan.index');
        }

        if (!$startDate && $endDate) {
            return redirect()->route('laporan.index');
        }

        if ($startDate && $endDate) {
            if (strtotime($endDate) < strtotime($startDate)) {
                return redirect()->route('laporan.index');
            }

            $earlier = new \DateTime($startDate);
            $later = new \DateTime($endDate);
            $diff = $later->diff($earlier)->format("%a");

            if ($diff >= 31) {
                return redirect()->route('laporan.index');
            }
        } else {
            $currentDate = date('Y-m-d');
            $startDate = date('Y-m-01', strtotime($currentDate));
            $endDate = date('Y-m-t', strtotime($currentDate));
        }

        $startDate = $startDate;
        $endDate = $endDate;

        $reports = [];
        $revenue = 0;
        $total_revenue = 0;

        while (strtotime($startDate) <= strtotime($endDate)) {
            $date = $startDate;
            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));

            $revenue = Transaksi::where('created_at', 'LIKE', "%$date%")->sum('price_total');

            $total_revenue += $revenue;

            $row = [];
            $row['date'] = $date;
            $row['revenue'] = $revenue;
            $reports[] = $row;
        }

        if ($exportAs = $request->input('export')) {
            if (!in_array($exportAs, ['xlsx'])) {
                return redirect()->route('laporan.index');
            }

            if ($exportAs == 'xlsx') {
                $fileName = 'laporan-pendapatan-' . $endDate . '-' . $startDate . '.xlsx';

                return Excel::download(new LaporanExport($reports, $total_revenue), $fileName);
            }
        }

        // dd($reports);

        return view('pages.laporan.index', compact('reports','total_revenue','startDate','endDate'));
    }

    public function pengeluaran(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if ($startDate && !$endDate) {
            return redirect()->route('laporan.pengeluaran');
        }

        if (!$startDate && $endDate) {
            return redirect()->route('laporan.pengeluaran');
        }

        if ($startDate && $endDate) {
            if (strtotime($endDate) < strtotime($startDate)) {
                return redirect()->route('laporan.pengeluaran');
            }

            $earlier = new \DateTime($startDate);
            $later = new \DateTime($endDate);
            $diff = $later->diff($earlier)->format("%a");

            if ($diff >= 31) {
                return redirect()->route('laporan.pengeluaran');
            }
        } else {
            $currentDate = date('Y-m-d');
            $startDate = date('Y-m-01', strtotime($currentDate));
            $endDate = date('Y-m-t', strtotime($currentDate));
        }

        $startDate = $startDate;
        $endDate = $endDate;

        $reports = [];
        $pengeluaran = 0;
        $total_pengeluaran = 0;

        while (strtotime($startDate) <= strtotime($endDate)) {
            $date = $startDate;
            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));

            $pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$date%")->sum('nominal');

            $total_pengeluaran += $pengeluaran;

            $row = [];
            $row['date'] = $date;
            $row['pengeluaran'] = $pengeluaran;
            $reports[] = $row;
        }

        if ($exportAs = $request->input('export')) {
            if (!in_array($exportAs, ['xlsx'])) {
                return redirect()->route('laporan.pengeluaran');
            }

            if ($exportAs == 'xlsx') {
                $fileName = 'laporan-pengeluaran-' . $endDate . '-' . $startDate . '.xlsx';

                return Excel::download(new PengeluaranExport($reports, $total_pengeluaran), $fileName);
            }
        }

        // dd($reports);

        return view('pages.laporan.pengeluaran', compact('reports','total_pengeluaran','startDate','endDate'));
    }
}
