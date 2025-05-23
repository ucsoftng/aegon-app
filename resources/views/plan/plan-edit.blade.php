@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <link href="{{ asset('assets/dashboard/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <form method="post" action="{{route('plan-update',$plan->id)}}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-6 control-label">Plan Name : </label>

                            <div class="col-md-12">
                                <input type="text" name="name" value="{{ $plan->name }}" id="" class="form-control input-lg" required placeholder="Plan Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Plan Image : </label>

                            <div class="col-md-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{ asset('assets/images') }}/{{ $plan->image }}" alt="...">
                                    </div>
                                    <input type="file" id="input-file-now" class="dropify" name="image" accept="image/*" />
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Minimum Amount : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="minimum" value="{{ $plan->minimum }}" required type="text" placeholder="Minimum Amount">
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-6 control-label">Maximum Amount : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="maximum" value="{{ $plan->maximum }}" required type="text" placeholder="Maximum Amount">
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Running Percentage : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="percent" value="{{ $plan->percent }}" required type="text" placeholder="Running Percentage">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">End Percentage : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="end_percent" value="{{ $plan->end_percent }}" required type="text" placeholder="End Percentage">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Total Percentage : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="total_percent" value="{{ $plan->total_percent }}" required type="text" placeholder="Total Percentage">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Repeat Time : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <input class="form-control input-lg" name="time" value="{{ $plan->time }}" required type="text" placeholder="Repeat Time">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Dummy Time : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <input class="form-control input-lg" name="dummy_time" value="{{ $plan->dummy_time }}" required type="text" placeholder="Time">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Repeat Compound : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    {{--<input class="form-control input-lg" name="compound" value="" required type="text" placeholder="Invest Compound">--}}
                                    <select name="compound_id" id="" class="form-control input-lg" required>
                                        <option value="">Select One</option>
                                        @foreach($compound as $c)
                                            @if($plan->compound_id == $c->id)
                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                            @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Plan Type : </label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    {{--<input class="form-control input-lg" name="compound" value="" required type="text" placeholder="Invest Compound">--}}
                                    <select name="plan_type_id" id="plan_type" class="form-control input-lg" required>
                                        <option value="">Select One</option>
                                        @foreach($plantype as $c)
                                            @if($plan->plan_type_id == $c->id)
                                                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                            @else
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="forex_inputs" style="display: none;">
                            <label class="col-sm-6 control-label">Stop Loss : </label>
                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <input class="form-control input-lg" name="stop_loss" value="{{$plan->stop_loss}}" type="text" placeholder="Stop Loss">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                            <label class="col-sm-6 control-label">Risk Factor : </label>
                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <input class="form-control input-lg" name="risk_factor" value="{{$plan->risk_factor}}" type="text" placeholder="Risk Factor">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Description : <i style="color: red;">Use Comma to separate the descriptions!</i></label>

                            <div class="col-md-12">
                                <div class="input-group mb15">
                                    <textarea class="form-control input-lg" name="description" type="text" placeholder="">{{$plan->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Plan Status : </label>

                            <div class="col-lg-12 bt-switch">
                                <div class="mb-30">
                                    <input type="checkbox" {{ $plan->status == 1 ? 'checked' : '' }} data-on-color="success" data-off-color="danger" data-width="100%" name="status">
                                </div>
                            </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-12">
                                    <button type="submit" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Update Plan</button>
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
    <script>
        jQuery(document).ready(function ($) {
            $('#plan_type').change(function () {
                var id = $(this).val();
                if (id === "2") {
                    $("#forex_inputs").show();
                }else{
                    $("#forex_inputs").hide();
                }
                // if (id === "1") {
                //     $("#forex_inputs").hide();
                // }
            });
        });
    </script>
@endsection

