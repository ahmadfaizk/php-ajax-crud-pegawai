$(function () {
    refreshData();

    var dataDepartemen = new Array();
    var table = $('#table').DataTable({
        data: dataDepartemen,
        columns: [{
                data: 'no',
            },
            {
                data: 'nama',
            },
            {
                data: 'jumlah_pegawai',
            },
            {
                data: 'action',
            }
        ]
    })

    function refreshData() {
        $.get('action-departemen.php?action=all', function (response) {
            provideTable(response.data);
        })
    }

    function provideTable(data) {
        var no = 1;
        dataDepartemen = new Array();
        data.forEach(function (item) {
            var departemen = {
                no: no,
                nama: item.nama,
                jumlah_pegawai: item.jumlah_pegawai,
                action: '<a href="javascript:void(0);" class="btn btn-info btn-sm" id="btn-edit" data-id="' +
                    item.id + '">Edit</a> ' +
                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm" id="btn-delete" data-id="' +
                    item.id + '">Hapus</a></td>'
            }
            dataDepartemen.push(departemen);
            no++;
        })
        table.clear().rows.add(dataDepartemen).draw();
    }
    $('#btn-create').on('click', function () {
        $('#form-title').html('Buat Departemen Baru');
        $('#form').trigger('reset');
        $('#id').val(null);
        $('#form-modal').modal('show');
    })
    $('#btn-save').on('click', function (e) {
        e.preventDefault();
        var data = $('#form').serialize();
        if ($('#id').val() == "") {
            createDepartemen(data);
        } else {
            editDepartemen(data);
        }
    })
    $('#table').on('click', '#btn-edit', function () {
        var id = $(this).data('id');
        $('#form-title').html('Edit Departemen');
        $.get('action-departemen.php?action=get&id=' + id, function (data) {
            var departemen = data.data;
            $('#id').val(departemen.id);
            $('#nama').val(departemen.nama);
            $('#form-modal').modal('show');
        })
    })
    $('#table').on('click', '#btn-delete', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus departemen ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteDepartemen(id);
            }
        })
    })

    function createDepartemen(data) {
        $.ajax({
            url: 'action-departemen.php?action=new',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#form-modal').modal('hide');
                    refreshData();
                }
                showDialog(response);
            },
            error: function (data) {
                console.log(data);
            }
        })
    }

    function editDepartemen(data) {
        $.ajax({
            url: 'action-departemen.php?action=update',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#form-modal').modal('hide');
                    refreshData();
                }
                showDialog(response);
            },
            error: function (data) {
                console.log(data);
            }
        })
    }

    function deleteDepartemen(id) {
        $.ajax({
            url: 'action-departemen.php?action=delete&id=' + id,
            type: 'get',
            success: function (response) {
                if (response.success) {
                    refreshData();
                }
                showDialog(response);
            },
            error: function (data) {
                console.log(data);
            }
        })
    }

    function showDialog(response) {
        if (response.success) {
            Swal.fire(
                'Sukses',
                response.message,
                'success'
            )
        } else {
            Swal.fire(
                'Error',
                response.message,
                'error'
            )
        }
    }
});