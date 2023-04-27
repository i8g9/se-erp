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
        var modal = $('#detailModal');
        $.ajax({
            type: "POST",
            url: ctx + 'admin/getPayment',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                modal.modal('show');
                modal.find("#payPic").attr('src', ctx + 'assets/paymentImage/' + res.photo);
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
                url: ctx + 'admin/rejectPay',
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
                url: ctx + 'admin/approvePay',
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