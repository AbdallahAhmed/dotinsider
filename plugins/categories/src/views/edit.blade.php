@extends("admin::layouts.master")

@section("content")

    <form action="" method="post">

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <h2>
                    <i class="fa fa-folder"></i>
                    {{ $category ? trans("categories::categories.edit") : trans("categories::categories.add_new") }}
                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route("admin") }}">{{ trans("admin::common.admin") }}</a>
                    </li>
                    <li>
                        <a href="{{ route("admin.categories.show") }}">{{ trans("categories::categories.categories") }}</a>
                    </li>
                    <li class="active">
                        <strong>
                            {{ $category ? trans("categories::categories.edit") : trans("categories::categories.add_new") }}
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 text-right">

                @if ($category)
                    <a href="{{ route("admin.categories.create") }}"
                       class="btn btn-primary btn-labeled btn-main"> <span
                                class="btn-label icon fa fa-plus"></span>
                        &nbsp; {{ trans("categories::categories.add_new") }}</a>
                @endif

                <button type="submit" class="btn btn-flat btn-danger btn-main">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    {{ trans("categories::categories.save_category") }}
                </button>

            </div>
        </div>

        <div class="wrapper wrapper-content fadeInRight">

            @include("admin::partials.messages")

            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label
                                        for="input-name">{{ trans("categories::categories.attributes.name") }}</label>
                                <input name="name" type="text"
                                       value="{{ @Request::old("name", $category->name) }}"
                                       class="form-control" id="input-name"
                                       placeholder="{{ trans("categories::categories.attributes.name") }}">
                            </div>

                            <div class="form-group">
                                <label
                                        for="input-slug">{{ trans("categories::categories.attributes.slug") }}</label>
                                <input name="slug" type="text"
                                       value="{{ @Request::old("slug", $category->slug) }}"
                                       class="form-control" id="input-slug"
                                       placeholder="{{ trans("categories::categories.attributes.slug") }}">
                            </div>
                            <div class="form-group">
                                <label
                                        for="input-slug">{{ trans("categories::categories.attributes.excerpt") }}</label>
                                <input name="excerpt" type="text"
                                       value="{{ @Request::old("excerpt", $category->excerpt) }}"
                                       class="form-control" id="input-excerpt"
                                       placeholder="{{ trans("categories::categories.attributes.excerpt") }}">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-picture-o"></i>
                            {{ trans("categories::categories.add_image") }}
                        </div>
                        <div class="panel-body form-group">
                            <div class="row post-image-block">
                                <input type="hidden" name="image_id" class="post-image-id" value="
                                {{ ($category and @$category->image->path != "") ? @$category->image->id :  null }}">
                                <a class="change-post-image label" href="javascript:void(0)">
                                    <i class="fa fa-pencil text-navy"></i>
                                    {{ trans("categories::categories.change_image") }}
                                </a>
                                <a class="post-image-preview" href="javascript:void(0)">
                                    <img width="100%" height="130px" class="post-image"
                                         src="{{ ($category and @$category->image->id != "") ? thumbnail(@$category->image->path) : assets("admin::default/image.png") }}">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <i class="fa fa-camera"></i>
                            {{ trans("posts::posts.add_fields") }}
                            <a class="add-custom-field pull-right" href="javascript:void(0)">
                                <i class="fa fa-plus text-navy"></i>
                            </a>

                        </div>

                        <div class="panel-body row">


                            <div class="form-group meta-rows">

                                <div class="meta-row">

                                    @if ($category)
                                        <?php $x=0; ?>
                                        @foreach($category->category_feature as $feature)

                                            <div class="col-md-12">
                                                <div class="panel panel-default col-md-6">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-camera"></i>
                                                        {{ trans("posts::posts.add_image") }}
                                                        <a class="remove-post-image pull-right"
                                                           href="javascript:void(0)">
                                                            <i class="fa fa-times text-navy"></i>
                                                        </a>
                                                    </div>
                                                    <div class="panel-body form-group">
                                                        <div class="row post-image-block">
                                                            <input type="hidden" name="images[]" class="post-image-id"
                                                                   value="{{ ((sizeof($category->feature_image) > 0)?$category->feature_image[$x]->id:'') }}">

                                                            <a class="add-post-image label" href="javascript:void(0)">
                                                                <i class="fa fa-pencil text-navy"></i>
                                                                {{ trans("posts::posts.change_image") }}
                                                            </a>

                                                            <a class="post-media-preview" href="javascript:void(0)">
                                                                <img width="100%" height="130px" class="post-image"
                                                                     src="{{ (sizeof($category->feature_image) > 0) ? thumbnail($category->feature_image[$x]->path) : assets("admin::default/image.png") }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default col-md-6">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-camera"></i>
                                                        {{ trans("posts::posts.add_media") }}
                                                        <a class="remove-post-media pull-right"
                                                           href="javascript:void(0)">
                                                            <i class="fa fa-times text-navy"></i>
                                                        </a>
                                                    </div>
                                                    <div class="panel-body form-group">
                                                        <div class="row post-media-block">
                                                            <input type="hidden" name="media_id[]" class="post-media-id"
                                                                   value="{{ $feature->id }}">

                                                            <a class="change-post-media label"
                                                               href="javascript:void(0)">
                                                                <i class="fa fa-pencil text-navy"></i>
                                                                {{ trans("posts::posts.change_media") }}
                                                            </a>

                                                            <a class="post-media-preview" href="javascript:void(0)">
                                                                <img width="100%" height="130px" class="post-media"
                                                                     src="{{ ($feature and @ $feature->provider_image) ? ($feature->provider_image) : assets("admin::default/video.png") }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php ++$x; ?>
                                        @endforeach
                                    @endif
                                    <div class="col-md-12 row">
                                        <div>
                                            <div class="panel panel-default col-md-6">
                                                <div class="panel-heading">
                                                    <i class="fa fa-camera"></i>
                                                    {{ trans("posts::posts.add_image") }}
                                                    <a class="remove-post-image pull-right" href="javascript:void(0)">
                                                        <i class="fa fa-times text-navy"></i>
                                                    </a>
                                                </div>
                                                <div class="panel-body form-group">
                                                    <div class="row post-image-block">
                                                        <input type="hidden" name="images[]" class="post-image-id"
                                                               value="">

                                                        <a class="add-post-image label" href="javascript:void(0)">
                                                            <i class="fa fa-pencil text-navy"></i>
                                                            {{ trans("posts::posts.change_image") }}
                                                        </a>

                                                        <a class="post-media-preview" href="javascript:void(0)">
                                                            <img width="100%" height="130px" class="post-image"
                                                                 src="{{ assets("admin::default/image.png") }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default col-md-6">
                                                <div class="panel-heading">
                                                    <i class="fa fa-camera"></i>
                                                    {{ trans("posts::posts.add_media") }}
                                                    <a class="remove-post-media pull-right" href="javascript:void(0)">
                                                        <i class="fa fa-times text-navy"></i>
                                                    </a>
                                                </div>
                                                <div class="panel-body form-group">
                                                    <div class="row post-media-block">
                                                        <input type="hidden" name="media_id[]" class="post-media-id"
                                                               value="">

                                                        <a class="change-post-media label" href="javascript:void(0)">
                                                            <i class="fa fa-pencil text-navy"></i>
                                                            {{ trans("posts::posts.change_media") }}
                                                        </a>

                                                        <a class="post-media-preview" href="javascript:void(0)">
                                                            <img width="100%" height="130px" class="post-media"
                                                                 src="{{ assets("admin::default/video.png") }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </form>

@stop

@section("footer")

    <script>
        $(document).ready(function () {

            $(".change-post-image").filemanager({
                panel: "media",
                types: "image",
                done: function (result, base) {
                    if (result.length) {
                        var file = result[0];
                        base.parents(".post-image-block").find(".post-image-id").first().val(file.id);
                        base.parents(".post-image-block").find(".post-image").first().attr("src", file.thumbnail);
                    }
                },
                error: function (media_path) {
                    alert_box("{{ trans("categories::categories.not_allowed_file") }}");
                }
            });

            $("body").on("click", ".remove-custom-field", function () {

                var item = $(this);
                confirm_box("{{ trans("posts::posts.sure_delete_field") }}", function () {
                    item.parents(".meta-row").remove();
                });

            });

            $(".change-post-media").each(function () {

                $(this).filemanager({
                    types: "video",
                    panel: "media",
                    done: function (result, base) {
                        if (result.length) {
                            var file = result[0];
                            base.parents(".post-media-block").find(".post-media-id").first().val(file.id);
                            base.parents(".post-media-block").find(".post-media").first().attr("src", file.thumbnail);
                        }
                    },
                    error: function (media_path) {
                        alert_box("{{ trans("posts::posts.not_media_file") }}");
                    }
                });

            });


            $(".add-custom-field").click(function () {


                var html = `
                        <div class="col-md-12">
                        <div class="panel panel-default col-md-6">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-camera"></i>
                                                            {{ trans("posts::posts.add_image") }}
                    <a class="remove-post-image pull-right" href="javascript:void(0)">
                        <i class="fa fa-times text-navy"></i>
                    </a>
                </div>
                <div class="panel-body form-group">
                    <div class="row post-image-block">
                        <input type="hidden" name="images[]" class="post-image-id"
                               value="">

                        <a class="add-post-image label" href="javascript:void(0)">
                            <i class="fa fa-pencil text-navy"></i>
{{ trans("posts::posts.change_image") }}
                    </a>

                            <a class="post-media-preview" href="javascript:void(0)">
                                <img width="100%" height="130px" class="post-image"
                                     src="{{ assets("admin::default/image.png") }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default col-md-6">
                <div class="panel-heading">
                <i class="fa fa-camera"></i>
{{ trans("posts::posts.add_media") }}
                    <a class="remove-post-media pull-right" href="javascript:void(0)">
                        <i class="fa fa-times text-navy"></i>
                    </a>
                </div>
             <div class="panel-body form-group">
                <div class="row post-media-block">
                    <input type="hidden" name="media_id[]" class="post-media-id"
                       value="">
                    <a class="change-post-media label" href="javascript:void(0)">
                        <i class="fa fa-pencil text-navy"></i>
{{ trans("posts::posts.change_media") }}
                    </a>

                    <a class="post-media-preview" href="javascript:void(0)">
                        <img width="100%" height="130px" class="post-media"
                        src="{{ assets("admin::default/video.png") }}">
                            </a>
                    </div>
                    </div>
                </div>
            </div>
            `;
                i = $(".change-post-media").length;

                $(".meta-rows").append(html);

                $(".change-post-media").eq(i).filemanager({
                    types: "video",
                    panel: "media",
                    done: function (result, base) {
                        if (result.length) {
                            var file = result[0];
                            base.parents(".post-media-block").find(".post-media-id").first().val(file.id);
                            base.parents(".post-media-block").find(".post-media").first().attr("src", file.thumbnail);
                        }
                    },
                    error: function (media_path) {
                        alert_box("{{ trans("posts::posts.not_media_file") }}");
                    }
                });
                $(".add-post-image").eq(i).filemanager({
                    panel: "media",
                    types: "image",
                    done: function (result, base) {
                        result.forEach(function (row) {
                            if (result.length) {
                                var file = result[0];
                                base.parents(".post-image-block").find(".post-image-id").first().val(file.id);
                                base.parents(".post-image-block").find(".post-image").first().attr("src", file.thumbnail);
                            }
                        })

                    },
                    error: function (media_path) {
                        alert_box("{{ trans("categories::categories.not_allowed_file") }}");
                    }
                });
            });

            $(".add_gallery").filemanager({
                types: "image|video|audio|pdf",
                panel: "galleries",
                gallery_id: function () {
                    return 0;
                },
                galleries: function (result) {
                    result.forEach(function (row) {
                        if ($(".post_galleries [data-gallery-id=" + row.id + "]").length == 0) {
                            var html = '<div class="iwell post_gallery" data-gallery-id="' + row.id + '">' + row.name
                                + '<input type="hidden" name="galleries[]" value="' + row.id + '" />'
                                + '<a href="javascript:void(0)" class="remove_gallery pull-right text-navy"><i class="fa fa-times"></i></a></div>';
                            $(".post_galleries").html(html);
                        }
                    });
                    if ($(".post_galleries [data-gallery-id]").length != 0) {
                        $(".iwell.add_gallery").slideUp();
                    } else {
                        $(".iwell.add_gallery").slideDown();
                    }

                },
                error: function (media_path) {
                    alert(media_path + " is not an image");
                }
            });
            $("body").on("click", ".remove_gallery", function () {
                var base = $(this);
                var data_gallery = base.parents(".post_gallery");
                var data_gallery_id = data_gallery.attr("data-gallery-id");
                bootbox.dialog({
                    message: "هل أنت متأكد من الحذف ؟",
                    buttons: {
                        success: {
                            label: "موافق",
                            className: "btn-success",
                            callback: function () {
                                data_gallery.remove();
                                if ($(".post_galleries [data-gallery-id]").length != 0) {
                                    $(".iwell.add_gallery").slideUp();
                                } else {
                                    $(".iwell.add_gallery").slideDown();
                                }

                            }
                        },
                        danger: {
                            label: "إلغاء",
                            className: "btn-primary",
                            callback: function () {
                            }
                        },
                    },
                    className: "bootbox-sm"
                });
            });

            $(".add-post-image").each(function () {

                $(this).filemanager({
                    panel: "media",
                    types: "image",
                    done: function (result, base) {

                        console.log(base.parent());

                        if (result.length) {
                            var file = result[0];
                            base.parents(".post-image-block").find(".post-image-id").first().val(file.id);
                            base.parents(".post-image-block").find(".post-image").first().attr("src", file.thumbnail);
                        }

                    },
                    error: function (media_path) {
                        alert_box("{{ trans("categories::categories.not_allowed_file") }}");
                    }
                });

            })


        });
    </script>
@stop
