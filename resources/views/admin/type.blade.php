@extends('template')

@section('content')
<div class="modal fade" id="typeModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post" id="tipeForm">
                <div class="modal-header">
                    <b>Tambah Tipe Kamar</b>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="" class="label-control">Nama Tipe</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="Nama tipe" / >
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control">Harga</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Harga" / >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="typeModal_edit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post" id="tipeForm_edit">
                <div class="modal-header">
                    <b>Edit Tipe Kamar</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="type_id_edit" value=''/>
                        <label for="" class="label-control">Nama Tipe</label>
                        <input type="text" name="type" id="type_edit" class="form-control" placeholder="Nama tipe" / >
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control">Harga</label>
                        <input type="text" name="price" id="price_edit" class="form-control" placeholder="Harga" / >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="roomModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post" id="roomForm">
                <div class="modal-header">
                    <b>Tambah Kamar</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="label-control">Kode Ruangan</label>
                        <input type="text" name="code_ruangan" id="code_ruangan" class="form-control" placeholder="Kode Ruangan" / >
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control">Tipe</label>
                        <select name="type_id" id="type_id" class="type_id form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="roomModal_edit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post" id="roomForm_edit">
                <div class="modal-header">
                    <b>Edit Kamar</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="room_id_edit" value=''/>
                        <label for="" class="label-control">Kode Ruangan</label>
                        <input type="text" name="code_ruangan" id="code_ruangan_edit" class="form-control" placeholder="Kode Ruangan" / >
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control">Tipe</label>
                        <select name="type_id" id="type_id_edit_" class="type_id form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="row mt-4">
        <div class="col-sm-8">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <h3>Kamar</h3>
                        </div>
                        <div class="col text-right">
                            <button class="btn my-auto btn-success btn-sm" onclick='$("#roomModal").modal("show")'><span class="fa fa-plus"></span> Kamar</button>
                        </div>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead class="thead">
                            <tr>
                                <th style="height:60px">No</th>
                                <th style="height:60px">Kode Kamar</th>
                                <th style="height:60px">Tipe</th>
                                <th style="height:60px">Status</th>
                                <th style="height:60px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="rooms">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 pl-0 ">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <h3>Tipe Kamar</h3>
                        </div>
                        <div class="col text-right">
                            <button class="btn my-auto btn-success btn-sm" onclick='$("#typeModal").modal("show")'><span class="fa fa-plus"></span> Tipe</button>
                        </div>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead class="thead">
                            <tr>
                                <th style="height:60px">No</th>
                                <th style="height:60px">Nama Tipe</th>
                                <th style="height:60px">Harga</th>
                                <th style="height:60px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="types">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        const type = {
            form: $("#tipeForm"),
            select: $(".type_id"),
            table: $("#types"),
            form_edit: $("#tipeForm_edit"),
            handleSubmit: function(e) {
                e.preventDefault()
                $.ajax({
                    url: window.api('type'),
                    type: "POST",
                    data: {
                        type: $("#type").val(),
                        price: $("#price").val()
                    },
                    success: function(res) {

                    },
                    error: function(rej) {
                        console.log(rej)
                    },
                    complete: function() {
                        type.form.trigger('reset')
                        refresh()
                    }
                })
            },

            handleSubmitEdit: function(e) {
                e.preventDefault()
                $.ajax({
                    url: window.api('type'),
                    type: "PUT",
                    data: {
                        id: $("#type_id_edit").val(),
                        type: $("#type_edit").val(),
                        price: $("#price_edit").val()
                    },
                    success: function(res) {

                    },
                    error: function(rej) {
                        console.log(rej)
                    },
                    complete: function() {
                        type.form_edit.trigger('reset')
                        refresh()
                    }
                })
            },

            fetch: function() {
                type.select.html('')
                type.table.html('')
                $.ajax({
                    url: window.api('types'),
                    type: "GET",
                    success: (res) => {
                        let no = 1;
                        let type_ = type;
                        res.forEach((value, index) => {
                            type.select.append(`<option value='${value.id}'>${value.type}</option>`)
                            type.table.append(`<tr>
                                <td style='height:60px'>${no++}</td>
                                <td style='height:60px'>${value.type}</td>
                                <td style='height:60px'>${value.price}</td>
                                <td style='height:60px'><button type="button" onclick='typedelete(${value.id})' class='btn btn-danger btn-sm'>
                                    <span class='fa fa-trash fa-sm'></span>
                                </button>
                                <button type="button" onclick='typeedit(${value.id})' class='btn btn-warning btn-sm'>
                                    <span class=' text-white fa fa-pencil fa-sm'></span>
                                </button></td>
                            </tr>`)
                        })
                    }
                })
            }
        }

        let typedelete = function(id) {
            if(!confirm("Yakin ingin dihapus?")) {
                return ;
            }

            $.ajax({
                url: window.api('type'),
                type: "DELETE",
                data: {
                    id: id
                },
                success: function(res) {

                },
                error: function(rej) {
                    console.log(rej)
                },
                complete: function() {
                    refresh()
                }
            })
        }

        let typeedit = function(id) {
            $.ajax({
                url: window.api(`type?id=${id}`),
                type: "GET",
                success: function(resu) {
                    let res = resu[0]
                    $('#type_id_edit').val(res.id)
                    $('#type_edit').val(res.type)
                    $('#price_edit').val(res.price)
                    $('#typeModal_edit').modal('show')
                },
                error: function(rej) {
                    console.log(rej)
                },
            })
        }

        let roomdelete = function(id) {
            if(!confirm("Yakin ingin dihapus?")) {
                return ;
            }

            $.ajax({
                url: window.api('room'),
                type: "DELETE",
                data: {
                    id: id
                },
                success: function(res) {

                },
                error: function(rej) {
                    console.log(rej)
                },
                complete: function() {
                    refresh()
                }
            })
        }

        let roomedit = function(id) {
            $.ajax({
                url: window.api(`room?id=${id}`),
                type: "GET",
                success: function(resu) {
                    let res = resu[0]
                    $('#room_id_edit').val(res.id)
                    $('#code_ruangan_edit').val(res.code_ruangan)
                    $('#type_id_edit_').val(res.type_id)
                    $('#roomModal_edit').modal('show')
                },
                error: function(rej) {
                    console.log(rej)
                },
            })
        }

        const rooms = {
            table: $("#rooms"),
            form: $("#roomForm"),
            formEdit: $("#roomForm_edit"),
            select: "",
            fetch: function(state) {
                rooms.table.html('')
                let status = ""
                if(state != "undefined") {
                    status = state
                }

                $.ajax({
                    url: window.api('rooms/'+rooms.select),
                    type: "GET",
                    success: function(res) {
                        let no = 1;
                        res.data.forEach((value, index) => {
                            rooms.table.append(`<tr>
                                <td style='height:60px'>${no++}</td>
                                <td style='height:60px'>${value.code_ruangan}</td>
                                <td style='height:60px'>${value.type.type}</td>
                                <td style='height:60px'>${value.status}</td>
                                <td style='height:60px'><button type="button" onclick='roomdelete(${value.id})' class='btn btn-danger btn-sm'>
                                    <span class='fa fa-trash fa-sm'></span>
                                </button>
                                <button type="button" onclick='roomedit(${value.id})' class='btn btn-warning btn-sm'>
                                    <span class=' text-white fa fa-pencil fa-sm'></span>
                                </button></td>
                            </tr>`)
                        })
                    },
                    error: function(rej) {

                    },
                    complete: function() {

                    }
                })
            },
            handleSubmit: function(e) {
                e.preventDefault()
                $.ajax({
                    url: window.api('room'),
                    type: "POST",
                    data: {
                        code_ruangan: $("#code_ruangan").val(),
                        type_id: $("#type_id").val()
                    },
                    success: function(res) {

                    },
                    error: function(rej) {
                        console.log(rej)
                    },
                    complete: function() {
                        rooms.form.trigger('reset')
                        refresh()
                    }
                })
            },
            handleSubmitEdit: function(e) {
                e.preventDefault()
                $.ajax({
                    url: window.api('room'),
                    type: "PUT",
                    data: {
                        id: $("#room_id_edit").val(),
                        type_id: $("#type_id_edit_").val(),
                        code_ruangan: $("#code_ruangan_edit").val()
                    },
                    success: function(res) {

                    },
                    error: function(rej) {
                        console.log(rej)
                    },
                    complete: function() {
                        type.form_edit.trigger('reset')
                        refresh()
                    }
                })
            },
        }

        function refresh()
        {
            rooms.fetch()
            type.fetch()
            $("#roomModal").modal('hide')
            $("#typeModal").modal('hide')
            $("#typeModal_edit").modal('hide')
            $("#roomModal_edit").modal('hide')
        }

        $(document).ready(function() {
            type.form.on('submit', type.handleSubmit)
            type.form_edit.on('submit', type.handleSubmitEdit)
            rooms.form.on('submit', rooms.handleSubmit)
            rooms.formEdit.on('submit', rooms.handleSubmitEdit)
            refresh()
        })
    </script>
@endsection
