@extends('layouts.mobile-user')
@section('content')

    <div class="card card-style">
        <div class="content">
            <form method="post" action="{{route('support-open')}}" id="formSubmit" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-custom form-label form-icon mb-3">
                        <label for="c1" class="color-theme">Subject: </label>
                        <input type="text" name="subject" id="" class="form-control rounded-xs" required placeholder="Subject">
                    </div>
                    <div class="form-custom form-label form-icon mb-3">
                        <label for="c2" class="color-theme">Message : </label>
                        <textarea class="form-control rounded-xs" rows="17" placeholder="Enter text ..." name="message" required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-12">
                                <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100">
                                    <i class="fa fa-send"></i> Confirm and Open
                                </button>
                                {{--                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Open Ticket</button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to Open a Support Ticket..?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" id="btnYes" class="btn btn-primary"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                </div>

            </div>
        </div>
    </div>

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
    <script type='text/javascript'>
        $('#btnYes').click(function() {
            $('#formSubmit').submit();
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

