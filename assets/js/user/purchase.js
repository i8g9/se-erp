var listProduk;

$(document).ready(function(){
    function resetForm(){
        $('#frm').trigger("reset");
        var t = $('#tblDtl').DataTable();
        t.clear().draw();
    }


    $('.add').click(function(){
        resetForm();
        var modal = $('#addModal');
        modal.modal('show');
        modal.find('select').prop('disabled', false);
        modal.find('#submit').show();
        modal.find('#tambah').show();
    })

    $('#addModal').find('#tambah').click(function(){
        if($('#supplier').val() == null){
            $('#error-msg').text('Supplier is required.');
        } else {
            addProduk('');
        }
    })

    $('#supplier').change(function(){
        $('#error-msg').text('');
        var idSup = $(this).val();
        var t = $('#tblDtl').DataTable();
        t.clear().draw();
        getProduk(idSup);
    })

    function addProduk(act){
        var t = $('#tblDtl').DataTable();
        var counter = t.data().length + 1;

        if (act == "DETAIL") {
            t.row.add([
                counter,
                ' <select name="produk[]" class="produk form-select" id="' + counter + '" required>' +
                ' <option selected disabled value="">Select Product</option> ' +
                ' </select>',
                '<input type="number" class="qty form-control" name="qty[]" id="qty' + counter + '" required>',
                '<input type="text" class="subtotal form-control" name="subtotal[]" id="subtotal' + counter + '" required readonly style="text-align:right">',
                '<input type="text" hidden>'
            ]).draw(false);

            var select = $('#' + counter);
            for (m in listProduk) {
                select.append($("<option />").val(listProduk[m]['id_product']).text(listProduk[m]['name']));
            };

            $('.produk').change(function () {
                var id = $(this).val();
                var counter = $(this).attr('id')
                for (var i = 0; i < listProduk.length; i++) {
                    var product = listProduk[i];
                    if (product.id_product == id) {
                      $('#subtotal' + counter).val(product.harga);
                      break;
                    }
                  }
            });

        } else {
            t.row.add([
                counter + ' <input name="id[]" id="id' + counter +'" hidden>',
                ' <select name="produk[]" class="produk form-select" id="' + counter + '" required>' +
                ' <option selected disabled value="">Select Product</option> ' +
                ' </select>',
                '<input type="number" class="qty form-control" name="qty[]" id="qty' + counter + '" required>',
                '<input type="text" class="subtotal form-control" name="subtotal[]" id="subtotal' + counter + '" required readonly style="text-align:right">',
                '<button type="button" class="btn btn-border btn-round btn-sm btn-danger rowCenter delete" id="btnDelete' + counter + '">Delete</button>'
            ]).draw(false);


            $('#tblDtl tbody').on('click', 'button.delete', function () {
                var table2 = $('#tblDtl').DataTable({
                    autoWidth: false,
                    destroy: true,
                    lengthChange: false,
                    ordering: false,
                    searching: false,
                    paging: false,
                    info: false
                });

                table2
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
                counter = table2.data().length;
            });

            var select = $('#' + counter);
            for (m in listProduk) {
                select.append($("<option />").val(listProduk[m]['id_product']).text(listProduk[m]['name']));
            };

            $('.produk').change(function () {
                var id = $(this).val();
                var counter = $(this).attr('id')
                for (var i = 0; i < listProduk.length; i++) {
                    var product = listProduk[i];
                    if (product.id_product == id) {
                      $('#subtotal' + counter).val(product.harga);
                      break;
                    }
                  }
            });
        }
        counter++;
    }

    function getProduk(id){
        $.ajax({
            type: "POST",
            url: ctx + 'admin/getAllProductById',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                    listProduk = res;
                }
            });
    }

    $('.delete').click(function() {
        var id = $(this).attr('id')
        // console.log(id);
        var modal = $("#deleteModal");
        modal.modal('show');
        modal.find('.delete').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'user/delete',
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    location.reload();
                }
            });
        })
    })

    $('.detail').click(function(){
        resetForm();
        var id = $(this).attr('id');
        var modal = $('#addModal');
        $.ajax({
            type: "POST",
            url: ctx + 'user/getById',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                modal.modal('show');
                modal.find("#supplier").val(res.id_supplier).trigger('change');
                $.ajax({
                    type: "POST",
                    url: ctx + 'user/getDtlById',
                    data: {
                        id: res.id_purchase
                    },
                    dataType: "JSON",
                    success: function(res){
                        setTimeout(function(){
                            $.each(res, function(index, value){
                                addProduk("DETAIL");
                                $('#' + (index+1)).val(value['id_product']).trigger('change');
                                $('#qty' + (index+1)).val(value['qty']);
                            })
                            modal.find('select').prop('disabled', true);
                            modal.find('.qty').prop('disabled', true);
                            modal.find('#submit').hide();
                            modal.find('#tambah').hide();
                        }, 100);
                    }
                })
            }
        });
        
    })

    $('.edit').click(function(){
        resetForm();
        var id = $(this).attr('id');
        $('#id_purchase').val(id);
        var modal = $('#addModal');
        $.ajax({
            type: "POST",
            url: ctx + 'user/getById',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                modal.modal('show');
                modal.find("#supplier").val(res.id_supplier).trigger('change');
                $.ajax({
                    type: "POST",
                    url: ctx + 'user/getDtlById',
                    data: {
                        id: res.id_purchase
                    },
                    dataType: "JSON",
                    success: function(res){
                        // console.log(res);
                        setTimeout(function(){
                            $.each(res, function(index, value){
                                addProduk("");
                                $('#id' + (index+1)).val(value['id_detail']);
                                $('#' + (index+1)).val(value['id_product']).trigger('change');
                                $('#qty' + (index+1)).val(value['qty']);
                            })
                            modal.find('select').prop('disabled', false);
                            modal.find('#submit').show();
                            modal.find('#tambah').show();
                        }, 100)
                    }
                })
            }
        });
        
    })
});