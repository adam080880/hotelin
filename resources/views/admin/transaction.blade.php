@extends('template')

@section('content')
<div class="row mt-4">
    <div class="col-sm-6">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <h3>Booking</h3>
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
    <div class="col-sm-6 pl-0 ">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <h3>Transaksi</h3>
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

@endsection
