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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <p>Proxy</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="result"></div>
                            </div>
                        </div> <!-- /.row -->
                    </div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
@endsection

@section('custom-js')
    <script>
        $("#{{ $app }}").addClass('active');
    </script>

    <script>
        function resizeIframe(obj) {
            var obj = $(obj);
            var height = document.body.scrollHeight + 'px';
            obj.attr('height', height);
        }
    </script>
@endsection