var listProduk;

$(document).ready(function(){ 

    function resetForm(){
        $('#frm').trigger("reset");
        var t = $('#tblDtl').DataTable();
        t.clear().draw();
    }

    $('#supplier').change(function(){
        $('#error-msg').text('');
        var idSup = $(this).val();
        var t = $('#tblDtl').DataTable();
        t.clear().draw();
        getProduk(idSup);
    })

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
                setTimeout(function(){
                    $.ajax({
                        type: "POST",
                        url: ctx + 'user/getDtlById',
                        data: {
                            id: res.id_purchase
                        },
                        dataType: "JSON",
                        success: function(res){
                            // console.log(res);
                            $.each(res, function(index, value){
                                addProduk("DETAIL");
                                $('#' + (index+1)).val(value['id_product']).trigger('change');
                                $('#qty' + (index+1)).val(value['qty']);
                            })
                            modal.find('select').prop('disabled', true);
                            modal.find('.qty').prop('disabled', true);
                            modal.find('#submit').hide();
                            modal.find('#tambah').hide();
                        }
                    })
                },100)
            }
        });
        
    })

    $('.reject').click(function() {
        var id = $(this).attr('id')
        // console.log(id);
        var modal = $("#approveModal");
        modal.modal('show');
        modal.find('.delete').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'admin/reject',
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

    $('.approve').click(function() {
        var id = $(this).attr('id')
        console.log(id);
        var modal = $("#approveModal");
        modal.modal('show');
        modal.find('.delete').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'admin/approve',
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
});