<!-- application/views/projects/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <br>
        <a href="<?php echo base_url('index.php/projects/form'); ?>">
            <button class="btn btn-primary" type="submit">Tambah Proyek</button>
        </a>
        <br>
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
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo $project['id']; ?></td>
                            <td><?php echo $project['nama_proyek']; ?></td>
                            <td><?php echo $project['client']; ?></td>
                            <td><?php echo $project['tgl_mulai']; ?></td>
                            <td><?php echo $project['tgl_selesai']; ?></td>
                            <td><?php echo $project['pimpinan_proyek']; ?></td>
                            <td><?php echo $project['keterangan']; ?></td>
                            <td><?php echo $project['created_at']; ?></td>
                            <?php if (!empty($project['lokasi'])): ?>
                                <td><?php echo $project['lokasi'][0]['nama_lokasi']; ?></td>
                                <td><?php echo $project['lokasi'][0]['negara']; ?></td>
                                <td><?php echo $project['lokasi'][0]['provinsi']; ?></td>
                                <td><?php echo $project['lokasi'][0]['kota']; ?></td>
                                <?php else: ?>
                                    <td colspan="4">No location information</td>
                                    <?php endif; ?>
                                    <td>

                                        <a>
                                            <button>
                                        Edit
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("index.php/projects/delete/" . $project['id']); ?>">
                                            <button>
                                                Delete
                                            </button>
                                        </a>
                                    </td>
                                        
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12">No projects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Lokasi</h1>
        
        <a href="<?php echo base_url('index.php/lokasi/form'); ?>">
            <button class="btn btn-primary" type="submit">Tambah Lokasi</button>
        </a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location Name</th>
                    <th>Country</th>
                    <th>Province</th>
                    <th>City</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($lokasi as $location): ?>
                        <tr>
                            <td><?php echo $location['id']; ?></td>
                            <td><?php echo $location['nama_lokasi']; ?></td>
                            <td><?php echo $location['negara']; ?></td>
                            <td><?php echo $location['provinsi']; ?></td>
                            <td><?php echo $location['kota']; ?></td>
                            <td><?php echo $location['created_at']; ?></td>
                            <td>

                                        <a>
                                            <button>
                                        Edit
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("index.php/lokasi/delete/" . $location['id']); ?>">
                                            <button>
                                                Delete
                                            </button>
                                        </a>
                                    </td>
                        </tr>
                    <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
