@extends('template')

@section('content')
<div class="row mt-4">
    <div class="col-sm-9">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <h3>Booking</h3>
                    </div>
                </div>
                <table class="table table-hover table-striped">
                    <thead class="thead">
                        <tr>
                            <th style="height:60px">No</th>
                            <th style="height:60px">Kode Ruangan</th>
                            <th style="height:60px">Tipe</th>
                            <th style="height:60px">Tanggal Booking</th>
                            <th style="height:60px">Nama User</th>
                            <th style="height:60px">Book Code</th>
                            <th style="height:60px">Status</th>
                            <th style="height:60px">Action</th>
                        </tr>
                    </thead>
                    <tbody id="books">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-3 pl-0">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <h3>Filter</h3>
                        <hr>
                    </div>
                </div>
                <form action="" method="post" id="formFilter">
                    <div class="form-group">
                        <label for="filter" class="label-control">Status</label>
                        <select name="" id="filter" class="form-control">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        const book = {
            filter: "",
            table: $("#books"),
            fetch: function() {
                $.ajax({
                    url: window.api('books/'+book.filter),
                    type: "GET",
                    success: (res) => {
                        let no = 1;
                        res.data.forEach((value, index) => {
                            book.table.append(`<tr>
                                <td>${no++}</td>
                                <td>${value.room.code_ruangan}</td>
                                <td>${value.room.type.type}</td>
                                <td>${value.booking_date}</td>
                                <td>${value.user.name}</td>
                                <td>${value.book_code}</td>
                                <td>${value.status}</td>
                                <td>
                                    <button ${ value.status == 'pending' ? `onclick='check_in(${value.id})'` : ""  } class='btn btn-${ (value.status == 'failed' ? "danger" : "primary") } btn-sm' ${ (value.status != 'pending') ? "disabled" : "" }>${ (value.status == 'failed') ? "Gagal" : (value.status == 'success' ? 'Success' : 'Check In') }</button>
                                </td>
                            </tr>`)
                        })
                    }
                })
            },
            handleFilter: function(e) {
                book.filter = $("#filter").val()
                refresh()
            }
        }

        function check_in()
        {
            console.log("s")
        }

        function refresh()
        {
            book.table.html("")
            book.fetch()
        }

        $(document).ready(function() {
            refresh()
            $("#filter").on('change', book.handleFilter)
        })
    </script>
@endsection
