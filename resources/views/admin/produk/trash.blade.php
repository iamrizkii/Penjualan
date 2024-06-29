@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col align-self-center">
                            <h4 class="page-title pb-md-0">Tong Sampah Produk</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Produk</a></li>
                                <li class="breadcrumb-item active">Tong Sampah Produk</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success border-0" id="alert" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('delete'))
                    <div class="alert alert-danger border-0" id="alert" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Produk Dihapus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="datatable_1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $produk)
                                        <tr>
                                            <td><b>#P00{{ $produk->id_produk }}</b></td>
                                            <td>{{ Str::title($produk->nama_produk) }}</td>
                                            <td>{{ Str::upper($produk->nama_kategori) }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>
                                                <a href="{{ route('produk.restore', $produk->id_produk) }}"
                                                    style="color:darkgoldenrod"><i class="ti ti-reload"></i> Pulihkan</a> |
                                                <a href="{{ route('produk.force-delete', $produk->id_produk) }}"
                                                    style="color:red"
                                                    onclick="event.preventDefault();
                                                document.getElementById('force-delete-form-{{ $produk->id_produk }}').submit();"><i
                                                        class="ti ti-trash"></i> Hapus Permanen</a>
                                                <form id="force-delete-form-{{ $produk->id_produk }}"
                                                    action="{{ route('produk.force-delete', $produk->id_produk) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('post')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="/metrica/dist/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="/metrica/dist/assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/metrica/dist/assets/js/pages/datatable.init.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2500);
    </script>
@endsection
