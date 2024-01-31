<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="{{ route('informasi.potensi.index') }}"><button type="button" class="btn btn-info btn-sm text-right"><i class="fa fa-arrow-circle-left"></i> Kembali</button></a>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="kategori_id" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::select('kategori_id', \App\Models\TipePotensi::pluck('nama_kategori', 'id'), null, ['placeholder' => '-Pilih', 'class' => 'form-control', 'id' => 'kategori_id', 'required' => true]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Potensi <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('nama_potensi', null, ['class' => 'form-control', 'placeholder' => 'Nama Potensi', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deskripsi</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::textarea('deskripsi', null, ['class' => 'my-editor', 'placeholder' => 'Deskripsi', 'style' => 'width: 100%; height: 750px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
                        @if ($errors->has('deskripsi'))
                        <span class="help-block" style="color:red">{{ $errors->first('deskripsi') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('lokasi', null, ['class' => 'form-control', 'placeholder' => 'Lokasi', 'required']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="file_gambar">Gambar</label>
                        <img src="{{ is_img($potensi->file_gambar ?? null) }}" id="showgambar" style="width:100%; max-height:250px; float:left;" />
                        {!! Form::file('file_gambar', ['placeholder' => 'Gambar', 'class' => 'form-control', 'id' => 'file-potensi', 'accept' => 'jpg,jpeg,png']) !!}
                        @if ($errors->has('file_gambar'))
                        <span class="help-block" style="color:red">{{ $errors->potensi('file_gambar') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <h3>URL Youtube</h3>

                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/{{ $potensi->url_video ?? null }}" title="Heavily modified Suzuki Omni in Dubai - 1/1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    {!! Form::text('url_video', null, ['class' => 'form-control', 'placeholder' => 'Kode Embeded Youtube']) !!}
                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="control-group">
                        <a href="{{ route('informasi.potensi.index') }}">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>&nbsp; Batal</button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--
@include('partials.asset_jqueryvalidation')

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PotensiRequest', '#form-potensi') !!}
@endpush
-->

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(function() {

        var fileTypes = ['jpg', 'jpeg', 'png']; //acceptable file types

        function readURL(input) {
            if (input.files && input.files[0]) {
                var extension = input.files[0].name.split('.').pop().toLowerCase(), //file extension from input file
                    isSuccess = fileTypes.indexOf(extension) > -1; //is extension in acceptable types

                if (isSuccess) { //yes
                    var reader = new FileReader();
                    reader.onload = function(e) {

                        $('#showgambar').attr('src', e.target.result);
                        $('#showgambar').removeClass('hide');
                        $('#showpdf').addClass('hide');

                    }

                    reader.readAsDataURL(input.files[0]);
                } else { //no
                    //warning
                    $("#file-potensi").val('');
                    alert('File tersebut tidak diperbolehkan.');
                }
            }
        }

        $("#file-potensi").change(function() {
            readURL(this);
        });
    });

    var editor_config = {
        path_absolute: "/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link gambar media",
        relative_urls: false,
        image_caption: true,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
            var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;

            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                judul: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
@endpush