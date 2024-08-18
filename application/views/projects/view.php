<!-- application/views/projects/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Proyek</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Client</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Pimpinan Proyek</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                    <th>Location Name</th>
                    <th>Country</th>
                    <th>Province</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($project)): ?>
                        <tr>
                            <td><?php echo $project['id']; ?></td>
                            <td><?php echo $project['nama_proyek']; ?></td>
                            <td><?php echo $project['client']; ?></td>
                            <td><?php echo $project['tgl_mulai']; ?></td>
                            <td><?php echo $project['tgl_selesai']; ?></td>
                            <td><?php echo $project['pimpinan_proyek']; ?></td>
                            <td><?php echo $project['keterangan']; ?></td>
                            <td><?php echo $project['created_at']; ?></td>
                            
                        </tr>
                        <?php else:?>
                    <tr>
                        <td colspan="12">No projects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
