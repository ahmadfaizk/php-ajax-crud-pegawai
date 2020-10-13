$(function () {
    refreshData();
    var table = $('#table').DataTable({
        columns: [{
                data: 'no',
            },
            {
                data: 'nama',
            },
            {
                data: 'nama_departemen',
            },
            {
                data: 'jenis_kelamin',
            },
            {
                data: 'alamat',
            },
            {
                data: 'action',
            }
        ],
        columnDefs: [
            {
                targets: 5,
                orderable: false,
            }
        ]
    })

    function refreshData() {
        $.get('action-pegawai.php?action=all', function (response) {
            provideTable(response.data);
        })
    }

    function provideTable(data) {
        var no = 1;
        data.forEach(function (item) {
            item.no = no;
            item.action =
                '<a href="javascript:void(0);" class="btn btn-info btn-sm" id="btn-edit" data-id="' +
                item.id + '">Edit</a> ' +
                '<a href="javascript:void(0);" class="btn btn-danger btn-sm" id="btn-delete" data-id="' +
                item.id + '">Hapus</a></td>';
            no++;
        })
        table.clear().rows.add(data).draw();
    }
    $.get('action-departemen.php?action=all', function (response) {
        response.data.forEach(function (item) {
            var option = new Option(item.nama, item.id);
            $('#departemen').append(option);
        })
    })
    $('#btn-create').on('click', function () {
        $('#form-title').html('Buat Pegawai Baru');
        $('#form').trigger('reset');
        $('#id').val(null);
        $('input[name=jenis_kelamin]').attr('checked', false);
        $('#form-modal').modal('show');
    })
    $('#btn-save').on('click', function (e) {
        e.preventDefault();
        var data = $('#form').serialize();
        if ($('#id').val() == "") {
            createPegawai(data);
        } else {
            editPegawai(data);
        }
    })
    $('#table').on('click', '#btn-edit', function () {
        var id = $(this).data('id');
        $('#form-title').html('Edit Pegawai');
        $.get('action-pegawai.php?action=get&id=' + id, function (data) {
            var pegawai = data.data;
            $('#id').val(pegawai.id);
            $('#nama').val(pegawai.nama);
            $('#alamat').val(pegawai.alamat);
            $('#departemen').val(pegawai.id_departemen);
            $('#tempat-lahir').val(pegawai.tempat_lahir);
            $('#tgl-lahir').val(pegawai.tgl_lahir);
            $('input[name=jenis_kelamin][value=' + pegawai.jenis_kelamin + ']').attr('checked', true);
            $('#form-modal').modal('show');
        })
    })
    $('#table').on('click', '#btn-delete', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus pegawai ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                deletePegawai(id);
            }
        })
    })

    function createPegawai(data) {
        console.log(data);
        $.ajax({
            url: 'action-pegawai.php?action=new',
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

    function editPegawai(data) {
        $.ajax({
            url: 'action-pegawai.php?action=update',
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

    function deletePegawai(id) {
        $.ajax({
            url: 'action-pegawai.php?action=delete&id=' + id,
            type: 'get',
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