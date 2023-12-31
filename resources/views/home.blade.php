@extends('layouts.app')

@section('content')
    @can('isUser')
        @include('user-dashboard')
    @endcan
{{--    @can('isAdmin')--}}
{{--        @include('admin-dashboard')--}}
{{--    @endcan--}}
    @can('isSuperAdmin')
        <div class="alert alert-info" role="alert">
            This is Supper Admin Dashboard.
        </div>
    @endcan
{{--    @if (session('status'))--}}
{{--        <div class="alert alert-success" role="alert">--}}
{{--            {{ session('status') }}--}}
{{--        </div>--}}
{{--    @endif--}}
@endsection

@push('scripts')
    <script>
        new DataTable('#example', {
            pagingType: 'full_numbers'
        });

        $(document).ready(function () {

            // Attach a click event to the button
            $('#sendData').on('click', function () {
                var inputData = $("#inputText").val();
                // debugger;
                // Send an Ajax request
                $.ajax({
                    type: 'POST',
                    url: '{{ route("submit.text") }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        inputText: inputData
                    },
                    success: function (data) {
                        console.log(data);
                        $('#result').html(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
