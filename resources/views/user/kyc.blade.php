@extends('layouts.mobile-user')
@section('content')
    <div class="card card-style">
        <div class="content">
            <div class="card-header">
                User Verification
            </div>
            <div class="card-body">

                <div class="panel-body">
                    @if($member->passport_image == null)
                        <form class="identity-upload" id="upload-image-form" enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="identity-content">
                                <h4>Upload your ID card</h4>
                                <span class="text-danger">(Driving License or Government ID card)</span>
                                <div class="divider"></div>
                                <p class="text-danger text-center">Uploading your ID helps us ensure the safety and
                                    security of your funds</p>
                            </div>
                            <div class="divider"></div>
                            <div class="form-group">
                                <label class="mr-sm-2">Upload Front ID: </label>
                                <span class="float-right">Maximum file size is 100KB</span>
                                <div class="file-upload-wrapper" data-text="front ID">
                                    <input name="front_id" type="file" class="form-control"
                                           value="" required>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="form-group">
                                <label class="mr-sm-2">Upload Back ID: </label>
                                <span class="float-right">Maximum file size is 100KB</span>
                                <div class="file-upload-wrapper" data-text="back ID">
                                    <input name="back_id" type="file" class="form-control"
                                           value="" required>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div id="modal-loader" style="display: none; text-align: center;">
                                <img src="{{ asset('img/ajax_loader.gif') }}" style="width: 50px; height: 50px;">
                                <p>We are verifying your ID, Please wait...</p>
                            </div>
                            <span class="text-danger" id="image-input-error"></span>
                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100 bkyc"
                                        id="bkyc"> Upload Documents
                                    <i
                                            class="fa fa-send"></i></button>
                            </div>
                        </form>
                    @else
                        <div class="text-center">
                            <img src="{{asset('img/checked.png')}}" alt="verified" style="width: 150px; height: 150px;">
                            <h3>User Documents Verified Successfully</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('adminz/assetz/vendors/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(function () {
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

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#upload-image-form').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $('#modal-loader').show();

            $.ajax({
                type: 'POST',
                url: `/kyc-update`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        window.setTimeout(function () {
                            $('#modal-loader').hide();
                            // swal({
                            //     title: "success",
                            //     text: "Documents Uploaded Successfully",
                            //     type: "success",
                            //     confirmButtonText: "OK"
                            // });
{{--                            {{session()->flash('message', 'Documents Uploaded Successfully!')}}--}}
{{--                                    {{Session::flash('type', 'success')}}--}}
{{--                                    {{Session::flash('title', 'success')}}--}}
                                window.location.href = "/user/user-kyc";
                        }, 20000);
                    }
                },
                error: function (response) {
                    console.log(response);
                    $('#modal-loader').hide();
                    $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });
    </script>
@endsection