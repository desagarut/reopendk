@if (Route::currentRouteName() === 'beranda' && $slides->count() > 0)
<!-- Slider -->
<div class="dk-line"></div>

<div class="container">
    <div id="swiper-slider" class="swiper">
        <div class="swiper-wrapper">
            @foreach ($slides as $slide)
            <div class="swiper-slide">
                <div class="slider-class">
                    <div class="legend"></div>
                    <div class="content-slide">
                        <div class="content-txt">
                            <h1>{{ $slide->judul }}</h1>
                            <h2>{{ $slide->deskripsi }}</h2>
                        </div>
                    </div>
                    <div class="image">
                        <img src="{{ Str::contains($slide->gambar, 'storage') ? asset($slide->gambar) : $slide->gambar }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <!--
            <div class="col-md-3">
                @if ($camat)
                <div class="pad text-bold bg-white" style="text-align:center; height:100%">
                    <img src="@if (isset($camat->foto)) {{ asset($camat->foto) }} @else {{ asset('img/no-profile.png') }} @endif" width="200px" class="img-user" style="max-height: 256px; object-fit: contain;  width: 250px;">

                </div>
                <div class="text-center  with-border bg-blue">
                    <h3 class="box-title text-bold" data-toggle="tooltip" data-placement="top">
                        {{ $camat->namaGelar }} <br /> <span style="font-size: 14px;color: #ecf0f5;"> {{ $sebutan_kepala_wilayah }} {{ $profil->nama_kecamatan }} </span></h6>
                    </h3>
                </div>
                @endif
            </div>-->

</div>
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        var swiper = new Swiper("#swiper-slider", {
            autoplay: {
                delay: 4000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endpush