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
            @foreach ($apps as $app_name => $url)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="text-center">
                                        <h3>{{ ucwords($app_name) }}</h3>
                                        <br>
                                        <a href="{{ $url }}" target="_blank" class="btn btn-primary">View Dashboard</a>
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div>
                    </div>
                </div><!-- /# column -->
            @endforeach
        </div>
        <!--  /Traffic -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
@endsection

@section('custom-js')
    <script>
        $("#dashboards").addClass('active');
    </script>

    <script>
        function resizeIframe(obj) {
            var obj = $(obj);
            var height = document.body.scrollHeight + 'px';
            obj.attr('height', height);
        }
    </script>
@endsection