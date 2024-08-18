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

<section class="container">
    <h1>Form Tambah Proyek</h1>
    <form id="projectForm">
        <div class="mb-3">
            <label for="nama_proyek" class="form-label">Nama Proyek</label>
            <input type="text" class="form-control" id="nama_proyek" aria-describedby="emailHelp" name="nama_proyek">
        </div>
        <div class="mb-3">
            <label for="client" class="form-label">Client</label>
            <input type="text" class="form-control" id="client" aria-describedby="emailHelp" name="client">
        </div>
        <div class="mb-3">
            <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
        </div>

        <div class="mb-3">
            <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
        </div>

         <div class="mb-3">
            <label for="keterangan" class="form-label">keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan">
        </div>
        <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <select class="form-control" id="lokasi" name="lokasi[]">
            <option value="1">Lokasi 1</option>
            <option value="2">Lokasi 2</option>
            <!-- Add more options as needed -->
        </select>
</div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        document.getElementById('projectForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(this);
    var jsonObject = {};

    // Convert FormData to JSON
    formData.forEach((value, key) => {
        // Handle multiple values for 'lokasi[]'
        if (key === 'lokasi[]') {
            if (!jsonObject['lokasi_id']) {
                jsonObject['lokasi_id'] = [];
            }
            jsonObject['lokasi_id'].push(value);
        } else {
            jsonObject[key] = value;
        }
    });

    // Ensure empty arrays are represented correctly
    jsonObject['lokasi_id'] = jsonObject['lokasi_id'] || [];

    fetch('http://localhost:8080/proyek', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nama_proyek: jsonObject['nama_proyek'] || "",
            client: jsonObject['client'] || "",
            tgl_mulai: jsonObject['tgl_mulai'] || "",
            tgl_selesai: jsonObject['tgl_selesai'] || "",
            pimpinan_proyek: jsonObject['pimpinan_proyek'] || "",
            keterangan: jsonObject['keterangan'] || "",
            lokasi_id: jsonObject['lokasi_id'] || []
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // Optionally redirect or show success message
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

    </script>
</section>    


</body>
</html>
