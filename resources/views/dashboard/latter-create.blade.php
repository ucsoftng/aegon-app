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
                    <form method="post" action="{{route('latter-create')}}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-6 control-label">Letter Subject: </label>

                            <div class="col-md-12">
                                <input type="text" name="subject" id="" class="form-control input-lg" required placeholder="Latter Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Recipient User : </label>

                            <div class="col-md-12">
                                <select name="user_id[]" id="e1" class="select2 mb-10 select2-multiple" style="width: 100%" multiple="multiple" required>
                                    @foreach($user as $u)
                                    <option value="{{ $u->id }}" >{{ $u->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <div class="col-md-12">
                                        <input type="checkbox" id="checkbox">Select All
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Letter Description : </label>
                            <div class="col-md-12">
                                <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..." name="description" required></textarea>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <textarea name="description" class="form-control input-lg" id="area1" cols="30" rows="10" required placeholder="Latter Description"></textarea>--}}
{{--                            </div>--}}
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-12">
                                    <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Send This Letter</button>
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

    <script>
        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $("#e1 > option").prop("selected","selected");
                $("#e1").trigger("change");
            }else{
                $("#e1 > option").removeAttr("selected");
                $("#e1").trigger("change");
            }
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

