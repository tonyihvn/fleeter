<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<p>Good day Sir/Ma,</p>
<p>
    Please, you have a pending request to approve a vehicle request form. <br> Click on the link below to approve the
    request.
    The Request information is as follows.
    <hr>
    Vehicle Requested By: {{ $data['sender'] }} <br>
    Departure From: {{ $data['from'] }} <br>
    Destination To: {{ $data['to'] }} <br>
    Expected Take-off Date/Time: {{ $data['expdeparture_timedate'] }} <br>
    Expected Return Date/Time: {{ $data['exparrival_timedate'] }} <br>
    Purpose: {{ $data['purpose'] }}
    <hr>
</p>

<a href="{{ env('APP_URL') }}/request/{{ $data['request_id'] }}" class="btn btn-success">View Request</a>

<p>Thank you.</p>
<p>IHVN Transport Office, <br>Abuja</p>
