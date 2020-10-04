<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serifikati Web</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
        require_once __DIR__.'/model/Departemen.php';
        require_once __DIR__.'/model/Pegawai.php';
        $dept = new Departemen();
        $pgw = new Pegawai();
        $action = $_GET['action'];
        $pegawai = [
            'id' => null,
            'id_departemen' => '',
            'nama' => '',
            'gender' => '',
            'alamat' => ''
        ];
        $title = "Error Action";
        if($action == 'new') {
            $title =  "Membuat Pegawai Baru";
        } else if($action == 'update') {
            $pegawai = $pgw->get($_GET['id']);
            $title = "Mengedit Pegawai";
        }
        $listDepartemen = $dept->getAll();
    ?>
    <div class="container">
        <?php include('header.php') ?>
        <div class="card">
            <form action="<?php echo("action-pegawai.php?action=$action") ?>" method="post">
                <div class="card-header">
                    <?= $title?>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo($pegawai['id']) ?>">
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" class="form-control" name="nama"
                            value="<?php echo $pegawai['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Departemen</label>
                        <select class="form-control" name="departemen">
                        <?php
                            foreach($listDepartemen as $row) {
                                $selected = ($pegawai['id_departemen'] == $row['id']) ? "selected" : "";
                                echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['nama'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="laki-laki" <?php echo ($pegawai['gender'] == 'laki-laki') ? "checked" : "" ?>>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="perempuan" <?php echo ($pegawai['gender'] == 'perempuan') ? "checked" : "" ?>>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3"><?php echo $pegawai['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a href="list-pegawai.php" class="btn btn-info">Kembali</a>
                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-primary float-right" name="submit" value="Simpan">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>