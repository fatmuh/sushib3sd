<meta charset="utf-8">
<table>
    <thead>
        <th>No</th>
        <th>Date</th>
        <th>Total Pengeluaran</th>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report['date'] }}</td>
                <td>{{ "Rp".number_format($report['pengeluaran'],2,',','.') }}</td>
            </tr>
        @empty
            <tr>
                <td>No records found</td>
            </tr>
        @endforelse

        @if ($reports)
            <tr>
                <td>Total</td>
                <td></td>
                <td><strong>{{ "Rp".number_format($total_pengeluaran,2,',','.') }}</strong></td>
            </tr>
        @endif
    </tbody>
</table>
