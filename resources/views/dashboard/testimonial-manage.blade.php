@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <div class="col-md-12">
                        <button id="btn-add" name="btn-add" style="margin-bottom: 20px;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Testimonial</button>
                    </div>
                    <div class="table-responsive mt-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tasks-list" name="tasks-list">
                            <?php $no=0; ?>
                            @foreach ($testimonial as $cat)
                                <?php $no++; ?>
                                <tr id="task{{$cat->id}}">
                                    <td>{{$no}}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td width="15%">{{ $cat->position }}</td>
                                    <td>{{ $cat->description }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm btn-detail btn-icon icon-left open-modal" value="{{$cat->id}}"><i class="fa fa-edit"></i> Edit Testimonial</button>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm btn-detail btn-icon icon-left" href="{{route('delete-testimonial',$cat->id)}}"><i class="fa fa-trash"></i> Delete Testimonial</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="text-right">
                            {{ $testimonial->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Manage Testimonial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('manage-testimonial') }}" enctype="multipart/form-data">
                        @csrf
                <div class="modal-body">
                    
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="" required>
                             
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Position</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control has-error" id="position" name="position" placeholder="Position" value="" required>
                            
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Image</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control has-error" id="file" name="file" placeholder="Image" value="" required>
                            
                            </div>
                        </div>
                        <!--                        <div class="form-group error">-->
                        <!--                            <label for="inputTask" class="col-sm-3 control-label">Image</label>-->
                        <!--                            <div class="col-md-12">-->
                        <!--                                <input type="file" class="form-control" id="position" name="image" placeholder="Image" value="">-->
                    <!--{{--                                <p class="error text-center alert alert-danger hidden"></p>--}}-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Description</label>
                            <div class="col-md-12">
                                <textarea name="description" id="description" cols="30" rows="10"
                                          class="form-control has-error" placeholder="Description" required></textarea>
                            
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Save Testimonial</button>
                    <!--<input type="hidden" id="task_id" name="task_id" value="0">-->
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>

        $(document).ready(function () {

            var url = '{{ url('/admin/manage-testimonial') }}';

            //display modal form for creating new task
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });

            //create new task / update existing task
            $("#btn-save").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();
                var fd = new FormData();
                // var formData = {
                //     'name': $('#name').val(),
                //     'position': $('#position').val(),
                //     'description': $('#description').val(),
                //     'type_id': $('#type_id').val()
                // }
                
                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "POST"; //for updating existing resource
                    my_url += '/' + task_id;
                }
                
                var files = $('#file')[0].files;
                // Check file selected or not
                if(files.length > 0 ){
                   fd.append('file',files[0]);
                   fd.append('name',$('#name').val());
                   fd.append('position',$('#position').val());
                   fd.append('description',$('#description').val());
                   fd.append('type_id',$('#type_id').val());
                
                $.ajax({

                    type: type,
                    url: my_url,
                    data: fd,
                    dataType: 'json',
                    success: function (data) {
                        var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td width="15%">'+ data.position +'</td><td>'+ data.description +'</td>';
                        task += '<td><button class="btn btn-info btn-sm btn-icon icon-left btn-detail open-modal" value="' + data.id + '"><i class="fa fa-edit"></i> Edit Testimonial</button>';

                        if (state == "add"){ //if user added a new record
                            $('#tasks-list').append(task);
                        }else{ //if user updated an existing record

                            $("#task" + task_id).replaceWith( task );
                        }

                        $('#frmTasks').trigger("reset");

                        $('#myModal').modal('hide');
                        swal('Success','Successfully Testimonial Saved.','success');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                }
            });

            //display modal form for task editing
            $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                    //success data
                    $('#task_id').val(data.id);
                    $('#name').val(data.name);
                    $('#position').val(data.position);
                    $('#description').val(data.description);
                    $('#type_id').val(data.type_id);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                })
            });

        });
    </script>

@endsection