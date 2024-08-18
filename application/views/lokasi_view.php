<!DOCTYPE html>
<html>
<head>
    <title>Lokasi List</title>
</head>
<body>
    <h1>Lokasi List</h1>
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location Name</th>
                    <th>Country</th>
                    <th>Province</th>
                    <th>City</th>
                    <th>Created At</th>
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
                        </tr>
                    <?php endforeach; ?>
                
            </tbody>
        </table>
</body>
</html>
