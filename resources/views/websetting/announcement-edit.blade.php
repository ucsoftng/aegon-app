@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('announcement-update',$menu->id)}}">
                        @csrf
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-6 control-label"><b>Title : </b></label>

                            <div class="col-md-12">
                                <input value="{{ $menu->title }}" type="text" name="title" id="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-6 control-label"><b>Announcement Description : </b></label>

                            <div class="col-md-12">
                                <textarea name="description" id="area1" rows="10"
                                          class="textarea_editor form-control " required>{{ $menu->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block margin-top-10" onclick="nicEditors.findEditor('area1').saveContent();"><i class="entypo-direction"></i> Update Announcement</button>
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
