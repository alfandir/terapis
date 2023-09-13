let table;
$(() => {
    
   

    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();

        let { id, name } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus terapi "<b>${name}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'terapi/delete', {
                    id,
                    _method: 'DELETE'
                }).done((res) => {
                    showSuccessToastr('sukses', 'Data berhasil dihapus');
                    table.ajax.reload();
                }).fail((res) => {
                    let { status, responseJSON } = res;
                    showErrorToastr('oops', responseJSON.message);
                })
            }
        })
    })

    
    $('#table-data').on('click', '.btn-export', function () {
        let data = table.row($(this).closest('tr')).data();
    
        let { id } = data;

        window.location.href = BASE_URL + 'terapi/export?id=' + id;
    
    });


    $('#form-terapi-update').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-terapi-update').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-terapi-update').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-terapi-update').modal('hide');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-terapi-update').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON, true);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
        })
    })

    $('#form-terapi-tanggapan').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-terapi-tanggapan').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-terapi-tanggapan').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-terapi-tanggapan').modal('hide');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-terapi-tanggapan').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON, true);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
        })
    })

    $('#table-data').on('click', '.btn-update', function () {
        var tr = $(this).closest('tr');
        var data = table.row(tr).data();

        clearErrorMessage();
        $('#form-terapi-update')[0].reset();

        $.each(data, (key, value) => {
            $('#update-' + key).val(value);
        })

        $('#modal-terapi-update').modal('show');
    })

    $('#table-data').on('click', '.btn-tanggapan', function () {
        var tr = $(this).closest('tr');
        var data = table.row(tr).data();

        clearErrorMessage();
        $('#form-terapi-tanggapan')[0].reset();

        $('.keluhan').text('Keluhan: ' + data.keluhan);
        $('#tanggapan-id').val(data.id);
        $('#tanggapan').val(data.tanggapan);

        $('#modal-terapi-tanggapan').modal('show');
    })


    $('#form-terapi').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-terapi').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-terapi').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-terapi').modal('hide');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-terapi').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
        })
    })

    $('.btn-tambah').on('click', function () {
        $('#form-terapi')[0].reset();
        clearErrorMessage();
        $('#modal-terapi').modal('show');
    });

    table = $('#table-data').DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'terapi/data',
            type: 'get',
            dataType: 'json'
        },
        order: [[6, 'desc']],
        columnDefs: [{
            targets: [0,6],
            orderable: false,
            searchable: false,
            className: 'text-center align-top'
        }, {
            targets: [1, 6],
            className: 'text-left align-top'
        }, {
            targets: [6],
            className: 'text-center align-top'
        }, {
            targets: [6],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, 
        {
            data: 'name',
            render: (data,type,row) => {
                return data ??'-';
            }
        }, 
        {
            data: 'keluhan',
            render: (data,type,row) => {
                return data;
            }
        }, {
            data: 'tanggapan',
            render: (data,type,row) => {
                return data?? '';
            }
        }, {
            data: 'status',
            render: (data,type,row) => {
                if (data == 0) {
                    return '<div class="badge badge-warning badge-lg">Menunggu</div>';
                } else {
                    return '<div class="badge badge-primary badge-lg">Selesai</div>';
                }
            }
        }, 
        {
            data: 'id',
            render: (data, type, row) => {
                console.log(permissions);
                var roleId = $('#role_id').val();
                let button_edit ='';
                let button_delete = '';
                let button_export = '';
            if(roleId == 2) {

                button_edit   = $('<button>', {
                    class: 'btn btn-primary btn-update',
                    html: '<i class="bx bx-pencil"></i>',
                    'data-id': data,
                    title: 'Update Data',
                    'data-placement': 'top',
                    'data-toggle': 'tooltip'
                });

                button_delete  = $('<button>', {
                    class: 'btn btn-danger btn-delete',
                    html: '<i class="bx bx-trash"></i>',
                    'data-id': data,
                    title: 'Delete Data',
                    'data-placement': 'top',
                    'data-toggle': 'tooltip'
                });
            } else {
                button_edit   = $('<button>', {
                    class: 'btn btn-success btn-tanggapan',
                    text: 'Tanggapi',
                    'data-id': data,
                    title: 'Tanggapi',
                    'data-placement': 'top',
                    'data-toggle': 'tooltip',
                });

                button_export   = $('<button>', {
                    class: 'btn btn-primary btn-export',
                    text: 'Export',
                    'data-id': data,
                    title: 'Export',
                    'data-placement': 'top',
                    'data-toggle': 'tooltip',
                });

            }
                
                return $('<div>', {
                    class: 'btn-group',
                    html: () => {
                        let arr = [];

                        if ((permissions.update && row.status == 0) && roleId == 1 || roleId ==3) arr.push(button_edit)
                        if (permissions.delete && row.status == 0) arr.push(button_delete)
                        if (permissions.download && row.status == 1) arr.push(button_export)

                        return arr;
                    }
                }).prop('outerHTML');
            }
        },
        {
            data: 'created_at'
        }]
    })
})