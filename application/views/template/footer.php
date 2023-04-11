<!-- Vendor JS Files -->
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/chart.js/chart.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/php-email-form/validate.js"></script>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/NiceAdmin/'); ?>assets/js/main.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $('#upload_link').on('click', function(e) {
            e.preventDefault();
            $('#upload:hidden').trigger('click');
        });

        $('.modalDetail').click(function() {
            var id = $(this).attr('id');
            $(".data").remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/getUser'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $("#modalData").append(`<div class="data">ID: ` + resp['nik'] + `</div>
                    <div class="data">Name: ` + resp['name'] + `</div>
                    <div class="data">Gender: ` + resp['gender'] + `</div>
                    <div class="data">Role: ` + resp['role'] + `</div>
                    <div class="data">Date of Birth: ` + resp['dob'] + `</div>
                    <div class="data">Address: ` + resp['address'] + `</div>
                    <div class="data">Religion: ` + resp['religion'] + `</div>
                    <div class="data">Status: ` + resp['married_status'] + `</div>
                    <div class="data">Contact: ` + resp['contact'] + `</div>`)
                }
            });
        });

        $('.modalDelete').on('click', function() {
            var idUser = $(this).attr('id');
            $('.userId').val(idUser);
        });

        $('#addButton').on('click', function() {
            var form = $('#addForm')
            formData = new FormData()
            formParams = form.serializeArray();

            $.each(form.find('input[type="file"]'), function(i, tag) {
                $.each($(tag)[0].files, function(i, file) {
                    formData.append(tag.name, file);
                });
            });

            $.each(formParams, function(i, val) {
                formData.append(val.name, val.value);
            });
            console.log(formData)
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/add'); ?>",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.error) {
                        if (data.userId_error != '') {
                            $('#id_error').html(data.userId_error);
                        } else {
                            $('#id_error').html('');
                        }
                        if (data.name_error != '') {
                            $('#name_error').html(data.name_error);
                        } else {
                            $('#name_error').html('');
                        }
                        if (data.role_error != '') {
                            $('#role_error').html(data.role_error);
                        } else {
                            $('#role_error').html('');
                        }
                        if (data.date_error != '') {
                            $('#date_error').html(data.date_error);
                        } else {
                            $('#date_error').html('');
                        }
                        if (data.address_error != '') {
                            $('#address_error').html(data.address_error);
                        } else {
                            $('#address_error').html('');
                        }
                        if (data.photo_error != '') {
                            $('#photo_error').html(data.photo_error);
                        } else {
                            $('#photo_error').html('');
                        }
                        if (data.contact_error != '') {
                            $('#contact_error').html(data.contact_error);
                        } else {
                            $('#contact_error').html('');
                        }
                    } else {
                        location.reload()
                    }
                }
            })
        });

        $('.modalEdit').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/getUser'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $('#editForm').find('#userId').val(resp['nik']);
                    $('#editForm').find('#name').val(resp['name']);
                    $('#editForm').find('input[name=gender][value=' + resp['gender'] + ']').attr('checked', 'checked');
                    $('#editForm').find('#role').val(resp['role']);
                    $('#editForm').find('#date').val(resp['dob']);
                    $('#editForm').find('#address').val(resp['address']);
                    $('#editForm').find('#selectReligion').val(resp['religion']).change();
                    $('#editForm').find('input[name=status][value=' + resp['married_status'] + ']').attr('checked', 'checked');
                    $('#editForm').find('#contact').val(resp['contact']);
                }
            });
        });

        $('#editButton').on('click', function() {
            var form = $('#editForm')
            formData = new FormData()
            formParams = form.serializeArray();

            $.each(form.find('input[type="file"]'), function(i, tag) {
                $.each($(tag)[0].files, function(i, file) {
                    formData.append(tag.name, file);
                });
            });

            $.each(formParams, function(i, val) {
                formData.append(val.name, val.value);
            });
            console.log(formData)
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/editData'); ?>",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.error) {
                        if (data.userId_error != '') {
                            $('#editForm').find('#id_error').html(data.userId_error);
                        } else {
                            $('#editForm').find('#id_error').html('');
                        }
                        if (data.name_error != '') {
                            $('#editForm').find('#name_error').html(data.name_error);
                        } else {
                            $('#editForm').find('#name_error').html('');
                        }
                        if (data.role_error != '') {
                            $('#editForm').find('#role_error').html(data.role_error);
                        } else {
                            $('#editForm').find('#role_error').html('');
                        }
                        if (data.date_error != '') {
                            $('#editForm').find('#date_error').html(data.date_error);
                        } else {
                            $('#editForm').find('#date_error').html('');
                        }
                        if (data.address_error != '') {
                            $('#editForm').find('#address_error').html(data.address_error);
                        } else {
                            $('#editForm').find('#address_error').html('');
                        }
                        if (data.photo_error != '') {
                            $('#editForm').find('#photo_error').html(data.photo_error);
                        } else {
                            $('#editForm').find('#photo_error').html('');
                        }
                        if (data.contact_error != '') {
                            $('#editForm').find('#contact_error').html(data.contact_error);
                        } else {
                            $('#editForm').find('#contact_error').html('');
                        }
                    } else {
                        location.reload()
                    }
                }
            })
        });

        $('.photo').click(function() {
            var id = $(this).attr('id')
            $('.photoImage').remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/getPhoto'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $('.photoData').append(`<div class="photoImage">
                    <img src="<?= base_url('assets/image/') ?>` + resp['request']['picture'] + `" alt="">
                </div>`)
                }
            });
        })

        $('.reject').click(function() {
            var id = $(this).attr('id')
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/reject'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    location.reload();
                }
            });
        })

        $('.approve').click(function() {
            var id = $(this).attr('id')
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/approve'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    location.reload();
                }
            });
        })

        $('.distDetail').click(function() {
            var id = $(this).attr('id');
            $(".data").remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('dashboard/getUser'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $("#modalData").append(`
                    <div class="data mb-1"><img style="max-width: 300px;" src="<?= base_url('assets/userImage/'); ?>` + resp['photo'] + `"></div>
                    <hr class="data">
                    <div class="data mb-1">ID: ` + resp['nik'] + `</div>
                    <div class="data mb-1">Name: ` + resp['name'] + `</div>
                    <div class="data mb-1">Gender: ` + resp['gender'] + `</div>
                    <div class="data mb-1">Role: ` + resp['role'] + `</div>
                    <div class="data mb-1">Date of Birth: ` + resp['dob'] + `</div>
                    <div class="data mb-1">Address: ` + resp['address'] + `</div>
                    <div class="data mb-1">Religion: ` + resp['religion'] + `</div>
                    <div class="data mb-1">Status: ` + resp['married_status'] + `</div>
                    <div class="data mb-1">Contact: ` + resp['contact'] + `</div>`)
                }
            });
        });

        $('.distReport').click(function() {
            var id = $(this).attr('id');
            $(".data").remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('dashboard/getUser'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $('.id_disaster').val(resp['id_disaster']);
                    $('.nik').val(resp['nik']);
                    $('.name').val(resp['name']);

                    $('#nik').append(`<div class="data mb-1">ID: ` + resp['nik'] + `</div>`);
                    $('#name').append(`<div class="data mb-1">Name: ` + resp['name'] + `</div>`);
                }
            });
        });

        $('.status').on('change', function() {
            var optionSelected = $(this).find("option:selected")
            var value = optionSelected.val();
            var id = optionSelected.attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/changeStatus'); ?>",
                data: {
                    id: id,
                    value: value
                },
                dataType: "JSON",
                success: function(resp) {}
            });
        })

        $('.photoReport').click(function() {
            var id = $(this).attr('id')
            $('.photoReportImage').remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/getPhotoReport'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    $('.photoData').append(`<div class="photoReportImage">
                    <img style="max-width: 500px" src="<?= base_url('assets/reportimage/') ?>` + resp['report']['photo'] + `" alt="">
                </div>`)
                }
            });
        })

        $('.deleteReport').click(function() {
            var id = $(this).attr('id')
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/deleteReport'); ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(resp) {
                    location.reload();
                }
            });
        })
    });
</script>

</body>

</html>