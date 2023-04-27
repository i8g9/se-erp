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
    })


    $('.delete').click(function() {
        var id = $(this).attr('id')
        // console.log(id);
        var modal = $("#deleteModal");
        modal.modal('show');
        modal.find('.delete').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'admin/deleteSupplier',
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

    $('.edit').click(function(){
        resetForm();
        var id = $(this).attr('id');
        $('#id_supplier').val(id);
        var modal = $('#addModal');
        $.ajax({
            type: "POST",
            url: ctx + 'admin/getSupplierById',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                modal.modal('show');
                modal.find("#supplier").val(res.name);
            }
        });
        
    })
});