<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Jenis Dokumen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff0f6;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .card {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        header {
            background: linear-gradient(90deg, #ffd6e8, #ff99c8);
            padding: 24px;
            color: #6a0253;
            font-size: 20px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #ff7fbf;
            color: #fff;
            padding: 12px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            font-size: 13px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f6dfee;
            text-align: center;
        }

        tbody tr:hover {
            background: #fff0f6;
        }

        .small {
            font-size: 13px;
            color: #6b6b6b;
        }
    </style>
</head>

<body>
    <div class="card">
        <header>📚 Daftar Jenis Dokumen</header>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenis as $j)
                    <tr>
                        <td>{{ $j['jenis_id'] ?? ($j->jenis_id ?? '') }}</td>
                        <td class="small">{{ $j['nama_jenis'] ?? ($j->nama ?? '') }}</td>
                        <td class="small">{{ $j['deskripsi'] ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada data jenis dokumen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
