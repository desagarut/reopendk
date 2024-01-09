@extends('layouts.app')

@section('content')
{{-- <div class="row"> --}}
<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title text-bold"><i class="fa  fa-arrow-circle-right fa-lg text-blue"></i> {{ $kategoriPotensi->nama_kategori }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if (count($potensis) > 0)
            @foreach ($potensis as $potensi)
            <!-- Attachment -->
            <div class="row">
                <div class="col-md-4">
                    <img id="myImg" class="attachment-img responsive" Style="width:200px" src="{{ asset($potensi->file_gambar) }}" alt="{{ $potensi->nama_potensi }}">
                </div>
                <!-- The Modal -->
                <div class="col-md-8">
                    <h4><a href="{{ route('potensi.kategori.show', ['kategori' => $kategoriPotensi->slug, 'slug' => str_slug($potensi->nama_potensi)]) }}">{{ $potensi->nama_potensi }}</a></h4>
                    <p>
                        {{ str_limit($potensi->deskripsi, 300, ' ...') }}
                    </p>
                    <a href="{{ route('potensi.kategori.show', ['kategori' => $kategoriPotensi->slug, 'slug' => str_slug($potensi->nama_potensi)]) }}" class="btn btn-sm btn-primary"> Selengkapnya</a>
                    <!-- /.attachment-text -->
                </div>
                <!-- /.attachment-pushed -->
            </div>
            <!-- /.attachment-block -->
            @endforeach
            @else
            <h4 class="text-center"><span class="fa fa-times"></span> Data tidak ditemukan.</h4>
            @endif
            <!-- /.box-body -->
        </div>
        <div class="box-footer clearfix" style="padding:0px; margin: 0px !important;">
            {{ $potensis->links() }}
        </div>
        <!-- /.box-footer -->
    </div>
</div>
<!-- /.row -->
@endsection