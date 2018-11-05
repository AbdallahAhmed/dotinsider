@extends('layouts.app')
@section('title','Dotinsider | Categories')
@section('content')
    <section class="bg-section full-height">
        <div class="container">
            @include('layouts.partials.header')
            <div class="categories-channels to-hide">
                <p class="title-section main-title-font  zigzag d-inline-block">Categories</p>
                <div class="channels  d-inline-block">
                    @foreach($categories as $category)
                        <div class="img-channel d-inline-block">
                            <a href="{{$category->path}}" class="channel-card"><img
                                        src="{{thumbnail($category->image->path, 'cat-footer-logo')}}" alt="#"></a>
                        </div>
                    @endforeach
                    <div class="insert-more" style="display: none;"></div>
                    @if(count($categories) == 12)
                        <div class="more">
                            <a href="javascript:void(0)" class="btn-more">MORE <i class="icon-arrow-down"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-circle">
            <img src="{{assets('assets')}}/img/Elements-Circle.png" alt="">
        </div>
        <div class="bg-cuboid">
            <img src="{{assets('assets')}}/img/Elements-Cuboid.png" alt="">
        </div>
        <div class="bg-triangle-up">
            <img src="{{assets('assets')}}/img/Elements-Triangle-2.png" alt="">
        </div>
        <div class="bg-group">
            <img src="{{assets('assets')}}/img/absoluteGroup.png" alt="">
        </div>
    </section>
    @push('scripts')
        <script>
            $(function () {
                offset = 12
                $('.btn-more').on('click', function (e) {
                    e.preventDefault();
                    // $('.more').hide()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: "{{route('categories')}}",
                        data: {'offset': offset, 'limit': 12},
                        async: false,
                        success: function (data) {
                            if (data.count > 0) {
                                var html="";
                                for(i = 0; i < data.count; i++){
                                    html +=
                                '<div class="img-channel d-inline-block"><a href="'+data.cats[i].path+'" class="channel-card">"'+
                                    '<img src="'+data.cats[i].thumb+'" alt="#"></a> </div>';
                                }
                                $(html).insertBefore('.insert-more');
                                offset += data.count;
                            }
                            if(data.count < 12)
                                $('.more').remove()
                            else
                                $('.more').show()
                        }
                    })
                });
            })
        </script>
    @endpush
@endsection
@section('footer')
@endsection