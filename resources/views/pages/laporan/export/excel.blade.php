<meta charset="utf-8">
<table>
    <thead>
        <tr>
            <td colspan="3" style="text-align: center;"><strong>Total Pendapatan</strong></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report['date'] }}</td>
                <td>{{ "Rp".number_format($report['revenue'],2,',','.') }}</td>
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
                <td><strong>{{ "Rp".number_format($total_revenue,2,',','.') }}</strong></td>
            </tr>
        @endif
    </tbody>
</table>
