<div class="box-header with-border text-center  bg-blue">
    <h2 class="box-title text-bold">Media Sosial</h2>
</div>
<div class="row" style="margin: 0">
    @foreach ($medsos as $key => $data)
    <div class="col-md-6" style="padding: 4px;">
        <a href="{{ $data->url }}" rel="noopener noreferrer" target="_blank">
            <img src="{{ asset($data->logo) }}" class="logo-sinergi-program" alt="Media Sosial Image">
        </a>
    </div>
    @endforeach
</div>