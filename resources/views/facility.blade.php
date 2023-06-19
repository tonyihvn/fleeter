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
                    <h1 class="m-0">Facilities</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Facilities</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card" style="padding: 15px;">

        <h3 class="card-header text-center" style="text-align:center;">Update Facility</h3>


        <form method="POST" action="{{ route('facilities.update', $facility->id) }}">
            @csrf
            <input name="_method" type="hidden" value="PUT">

            <input type="hidden" name="id" value="{{ $facility->id }}">

            <div class="row">
                <div class="form-group col-md-6"><label for="facility_name">Facility Name</label>
                    <input id="facility_name" type="text" class="form-control" name="facility_name"
                        value="{{ $facility->facility_name }}" required autofocus>

                </div>

                <div class="form-group col-md-3"><label for="facility_no">Facility Datim Number</label>
                    <input id="facility_no" type="text" class="form-control" name="facility_no"
                        value="{{ $facility->facility_no }}">

                </div>

                <div class="form-group col-md-3"><label for="geocordinates">GeoCordinates (Lat,Lon)</label>
                    <input id="geocordinates" type="text" class="form-control" name="geocordinates"
                        value="{{ $facility->geocordinates }}">

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4"><label for="state">State (For Nigeria)</label>
                    <select onchange="toggleLGA(this);" name="state" id="state" class="form-control">
                        <option value="{{ $facility->state }}" selected="selected">{{ $facility->state }}</option>
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
                        <option value="Nassarawa">Nassarawa</option>
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

                <div class="form-group col-md-4"><label for="lga">LGA</label>
                    <select name="lga" id="lga" class="select-lga form-control">
                        <option value="{{ $facility->lga }}" selected="selected">{{ $facility->lga }}</option>
                    </select>

                </div>

                <div class="form-group col-md-4"><label for="town">Town/District</label>
                    <input id="town" type="text" class="form-control" name="town"
                        value="{{ $facility->town }}">

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4"><label for="address">Address</label>
                    <input id="address" type="text" class="form-control" name="address"
                        value="{{ $facility->address }}">

                </div>

                <div class="form-group col-md-4"><label for="phone_number">Phone Number</label>
                    <input id="phone_number" type="text" class="form-control" name="phone_number"
                        value="{{ $facility->phone_number }}">

                </div>

                <div class="form-group col-md-4"><label for="contact_person">Contact Person</label>
                    <input id="contact_person" type="text" class="form-control" name="contact_person"
                        value="{{ $facility->contact_person }}">

                </div>
            </div>


            <div class="form-group col-md-12 text-right" style="margin-bottom:20px;">

                <button type="submit" class="btn btn-primary">
                    Update Facility
                </button>

            </div>
        </form>


    </div>

    <script src="{{ asset('/dist/js/lga.js') }}"></script>
@endsection
