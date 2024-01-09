@extends('layouts.dashboard_template')

@section('content')

<section class="content-header">
    <h1>
        {{ $page_title ?? 'Page Title' }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('informasi.potensi.index') }}">Daftar Potensi</a></li>
        <li class="active">{{ $page_description ?? '' }}</li>
    </ol>
</section>

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan pada kolom inputan.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif

            <!-- form start -->
            {!! Form::model($potensi, ['route' => ['informasi.potensi.update', $potensi->id], 'method' => 'put', 'id' => 'form-potensi', 'class' => 'form-horizontal form-label-left', 'files' => true]) !!}


            @include('informasi.potensi.form_edit')

            <!-- /.box-body -->
            <div class="pull-right">
                <div class="control-group">
                    <a href="{{ route('informasi.potensi.index') }}">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>&nbsp; Batal</button>
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</section>
@endsection
<!--
@push('scripts')
<script>
    $(function() {

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#showgambar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file_gambar").change(function() {
            readURL(this);
        });
    });
</script>
@endpush -->
