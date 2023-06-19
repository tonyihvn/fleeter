@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Facilities</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">New Facility</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card" style=" padding:15px;">

        <form method="POST" action="{{ route('facilities.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6"><label for="facility_name">Facility Name</label>
                    <input id="facility_name" type="text" class="form-control" name="facility_name" required autofocus>

                </div>

                <div class="form-group col-md-3"><label for="facility_no">Facility Datim Number</label>
                    <input id="facility_no" type="text" class="form-control" name="facility_no">

                </div>
                <div class="form-group col-md-3"><label for="geocordinates">GeoCordinates (Lat,Lon)</label>
                    <input id="geocordinates" type="text" class="form-control" name="geocordinates">

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4"><label for="state" class="active">State (For Nigeria)</label>
                    <select onchange="toggleLGA(this);" name="state" id="state" class="form-control">
                        <option value="" selected="selected">- Select State -</option>
                        <option value="FCT">Abuja FCT</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross River">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nasarawa">Nasarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                        <option value="Outside Nigeria">Outside Nigeria</option>
                    </select>

                </div>

                <div class="form-group col-md-4"><label for="lga" class="active">LGA</label>
                    <select name="lga" id="lga" class="select-lga form-control" required>
                        <option value="" disabled selected>Select LGA</option>
                    </select>

                </div>

                <div class="form-group col-md-4"><label for="town">Town/District</label>
                    <input id="town" type="text" class="form-control" name="town">

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4"><label for="address">Address</label>
                    <input id="address" type="text" class="form-control" name="address">

                </div>

                <div class="form-group col-md-4"><label for="phone_number">Phone Number</label>
                    <input id="phone_number" type="text" class="form-control" name="phone_number">

                </div>

                <div class="form-group col-md-4"><label for="contact_person">Contact Person</label>
                    <input id="contact_person" type="text" class="form-control" name="contact_person">

                </div>
            </div>
            <div class="form-group col-md-12">

                <button type="submit" class="btn btn-primary float-right">
                    Add Facility
                </button>

            </div>
        </form>


    </div>

    <script src="{{ asset('dist/js/lga.js') }}"></script>
@endsection
