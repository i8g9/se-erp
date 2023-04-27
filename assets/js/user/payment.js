var listProduk;

$(document).ready(function(){
    function resetForm(){
        $('#frm').trigger("reset");
        var t = $('#tblDtl').DataTable();
        t.clear().draw();
    }

    $('.detail').click(function(){
        resetForm();
        var id = $(this).attr('id');
        var modal = $('#addModal');
        $.ajax({
            type: "POST",
            url: ctx + 'user/getPayment',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                modal.modal('show');
                modal.find('#id_purchase').val(id);
                modal.find("#supplier").val(res.id_supplier).trigger('change');
                modal.find("#price").val(res.harga);
            }
        });
        
    })
    
});