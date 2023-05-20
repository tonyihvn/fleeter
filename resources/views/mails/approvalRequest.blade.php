<p>Good day,</p>
<p>
    Please, you have a pending request to approve a vehicle request form. <br> Click on the link below to approve the
    request.
    The Request information is as follows. <br>
    Departure From: {{ $data->from }} <br>
    Destination To: {{ $data->to }} <br>
    Expected Take-off Date/Time: {{ $data->expdeparture_timedate }} <br>
    Expected Arrival Date/Time: {{ $data->exparrival_timedate }} <br>
    Purpose: {{ $data->purpose }} <br>
</p>

<a href="{{ env('APP_ENV') }}/request/{{ $rid }}" class="btn btn-success">View Request</a>

<p>Thank you.</p>
<p>IHVN Transport Office, <br>Abuja</p>
