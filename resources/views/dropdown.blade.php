<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel AJAX Dependent Country State City Dropdown Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-4" >
    <div class="card mt-5">
        <h3 class="card-header p-3">Laravel 11 AJAX Dependent Country State City Dropdown Example - DevScriptSchool.com</h3>
        <div class="card-body">
            <form>
                <div class="form-group mb-3">
                    <select  id="country-dropdown" class="form-control">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $data)
                            <option value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <select id="state-dropdown" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <select id="city-dropdown" class="form-control">
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#country-dropdown').on('change', function () {
            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">-- Select State --</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        State Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#state-dropdown').on('change', function () {
            var idState = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    });
</script>
</body>
</html>
