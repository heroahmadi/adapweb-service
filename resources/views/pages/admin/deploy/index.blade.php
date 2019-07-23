@extends('layouts.admin')
{{-- 
@section('custom-css')
    <style>
        .header-link {
            font-size: 29px;
        }
    </style>
@endsection --}}

@section('content')
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  Traffic  -->
        <div class="row">
            <div class="col-lg-12">
                @if (!$app)
                <div class="card">
                    <div class="card-header">
                        <h4>Deploy Web Application</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">
                                :message
                            </div>')) !!}
                        @endif
                        <form action="#" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="app_name" class="form-control-label">Application Name</label>
                                        <input type="text" name="app_name" id="app_name" class="form-control" placeholder="Application name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="endpoint" class="form-control-label">Application Endpoint</label>
                                        <div class="input-group">
                                            <div class="input-group-btn"><button class="btn btn-primary" type="button">http://{{ $ip }}/</button></div>
                                            <input type="text" name="endpoint" id="endpoint" placeholder="Application URI" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="yml" class=" form-control-label">Upload .yml file</label>
                                        <br>
                                        <input type="file" name="yml" id="yml" required>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="submit_button" class="btn btn-primary">Deploy</button>
                        </form>
                    </div>
                </div>
                @endif
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <iframe src="{{ url('/console') }}" frameborder="0" width="100%" height="400px"></iframe>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        <h4>Application</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="text-center">
                                    <h3>Currently Active App</h3>
                                    <p>{{ $app ? $app->app_name : 'No Active App Detected' }}</p>
                                    @if ($app)
                                    <a href="{{ url('/deploy/deactive') }}" class="btn btn-danger">Deactive App</a>
                                    <a href="{{ $app->endpoint }}" class="btn btn-success" target="_blank">Open App</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->

    <div class="modal fade" id="completedModal" tabindex="-1" role="dialog" aria-labelledby="completedModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="info">
                    <p>Uploading files...</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $("#deploy").addClass('active');
    </script>

    <script>
        $("#submit_button").click(function(){
            $("#completedModal").modal('toggle');
            var formData = new FormData();
            var app_name = $("#app_name").val();
            var endpoint = $("#endpoint").val();

            formData.append("app_name", app_name);
            formData.append("endpoint", endpoint);
            formData.append("yml", $("#yml")[0].files[0]);
            formData.append("_token", "{{ csrf_token() }}")

            $("#info").empty();
            $("#info").append(`
                <p>Application is deploying...</p>
                <div class="progress mb-3">
                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            `);

            $.ajax({
                url: '{{ url('/deploy') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function(data){
                    $("#info").empty();
                    $("#info").append(`
                        <p>Deploy failed.</p>
                        `+data.message+`
                    `);
                },
                success: function(data){
                    $("#info").empty();
                    $("#info").append(`
                        <p>Application successfully deployed. Check status by typing:</p>
                        <div class="alert alert-dark" role="alert">
                            watch docker stack ps -f desired-state=Running app
                        </div>
                        <a href="{{ url('/deploy') }}" class="btn btn-primary">Reload Page</a>
                    `);
                }
            });
        });
    </script>
@endsection