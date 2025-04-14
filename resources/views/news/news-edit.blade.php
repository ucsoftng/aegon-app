@extends('layouts.admin')
@section('styles')
    <!-- summernotes CSS -->
    {{--    <link href="{{ asset('adminz/assetz/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{ asset('adminz/assetz/vendors/html5-editor/bootstrap-wysihtml5.css')}}" />
    <link href="{{ asset('adminz/assetz/vendors/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminz/assetz/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminz/assetz/vendors/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <form method="post" action="{{route('news-update',$news->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-sm-6 control-label">News Category : </label>

                                <div class="col-md-12">
                                    <select name="category_id" id="" class="form-control input-lg" required>
                                        <option value="">Select One</option>
                                        @foreach($category as $cat)
                                            @if($news->category_id == $cat->id)
                                                <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                            @else
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">News Title : </label>

                                <div class="col-md-12">
                                    <input type="text" name="title" id="" value="{{ $news->title }}" class="form-control input-lg" required placeholder="News Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Image : </label>

                                <div class="col-md-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                            <img style="width: 200px" src="{{ asset('assets/images') }}/{{ $news->image }}" alt="...">
                                        </div>
                                        <input type="file" id="input-file-now" class="dropify" name="image" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">News Description : </label>

                                <div class="col-md-12">
                                    <textarea name="description" class="textarea_editor form-control" id="area1" cols="30" rows="10" required placeholder="News Description">{{ $news->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Update News</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div><!---ROW-->


@endsection
@section('scripts')
    <!-- jQuery file upload -->
    <script src="{{ asset('adminz/assetz/vendors/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{ asset('adminz/assetz/vendors/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
    <script>
        $(function() {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <script type="text/javascript">
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function() {
            var bt = function() {
                $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function() {
                    bt()
                }
            }
        }();
        $(function() {
            radioswitch.init()
        });
    </script>
    <script src="{{ asset('adminz/assetz/vendors/html5-editor/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{ asset('adminz/assetz/vendors/html5-editor/bootstrap-wysihtml5.js')}}"></script>
    <script>
        $(function() {
            $('.textarea_editor').wysihtml5();
        });
    </script>
    <script src="{{ asset('adminz/assetz/vendors/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('adminz/assetz/vendors/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('adminz/assetz/vendors/multiselect/js/jquery.multi-select.js')}}"></script>
    <script>
        $(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();
            $('.selectpicker').selectpicker();
            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'ti-plus',
                verticaldownclass: 'ti-minus'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
            $("input[name='tch1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='tch2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='tch3']").TouchSpin();
            $("input[name='tch3_22']").TouchSpin({
                initval: 40
            });
            $("input[name='tch5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });
            // For multiselect
            $('#pre-selected-options').multiSelect();
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
            $('#public-methods').multiSelect();
            $('#select-all').on('click', function() {
                $('#public-methods').multiSelect('select_all');
                return false;
            });
            $('#deselect-all').on('click', function() {
                $('#public-methods').multiSelect('deselect_all');
                return false;
            });
            $('#refresh').on('click', function() {
                $('#public-methods').multiSelect('refresh');
                return false;
            });
            $('#add-option').on('click', function() {
                $('#public-methods').multiSelect('addOption', {
                    value: 42,
                    text: 'test 42',
                    index: 0
                });
                return false;
            });
            $(".ajax").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        });
    </script>

@endsection

