@extends('layouts.app')

@section('content')
{{-- <div class="row"> --}}
<div class="col-md-8">
    <div class="box box-widget">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12">
                <h3>{{ $potensi->nama_potensi }}</h3>
                <p><i class="fa fa-calendar"></i>&ensp;{{ format_date($potensi->created_at) }}&ensp;|&ensp;<i class="fa fa-user"></i>&ensp;Administrator</p>
            </div>
            <div class="col-md-12">
                <img src="{{ asset($potensi->file_gambar) }}" width="100%">
                <p style="padding-top:10px">{!! $potensi->deskripsi !!}</p>
                <h5><strong>Video</strong></h5>
                <p><iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $potensi->url_video ?? null }}" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></p>
            </div>
        </div>
        <div class="box-footer clearfix" style="padding:0px; margin: 0px !important;"></div>
        <!-- /.box-footer -->
    </div>
</div>
<!-- /.row -->
@endsection
@push('scripts')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61eeb3e9e14521001ac13912&product=inline-share-buttons" async="async"></script>
@endpush