$(document).ready(function(){
    $('.delete').click(function() {
        var id = $(this).attr('id')
        console.log(id);
        var modal = $("#deleteModal");
        modal.modal('show');
        modal.find('.delete').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'admin/delete',
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
        var id = $(this).attr('id')
        var modal = $("#editModal");
        $.ajax({
            type: "POST",
            url: ctx + 'admin/getUser',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                modal.modal('show');
                modal.find("#username").val(res.username);
            }
        });

        modal.find('.submit').click(function(){
            $.ajax({
                type: "POST",
                url: ctx + 'admin/edit',
                data: {
                    id: id,
                    username: modal.find('#username').val(),
                },
                dataType: "JSON",
                success: function(res) {
                    location.reload();
                }
            });
        })
    })
});