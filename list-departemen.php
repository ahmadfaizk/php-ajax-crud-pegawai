<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serifikati Web</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title mb-0">Data Master Departemen</h5>
                    </div>
                    <div class="col">
                        <a href="form-departemen.php?action=new" class="btn btn-primary float-right">Buat Baru</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah Pegawai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once __DIR__.'/model/Departemen.php';
                            $departemen = new Departemen();
                            $listDepartemen = $departemen->getAll();
                            $no = 1;
                            $html = '';
                            foreach($listDepartemen as $row) {
                                $html .= '<tr>
                                    <th scope="row">'. $no .'</th>
                                    <td>'. $row['nama'] .'</td>
                                    <td>'. $row['jumlah_pegawai'] .'</td>
                                    <td>
                                        <a href="form-departemen.php?action=update&id='.$row['id'].'" class="btn btn-info">Edit</a> 
                                        <a href="action-departemen.php?action=delete&id='.$row['id'].'" class="btn btn-danger">Hapus</a></td>
                                    </tr>';
                                $no++;
                            }
                            echo($html);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>