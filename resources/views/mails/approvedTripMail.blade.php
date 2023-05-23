<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

Dear {{ $data['name'] }},
<p>
    Your request vehicle vehicle has been approved.
<table class="table table-responsive"
    style="border: 1px solid grey; border-collapse: collapse; width: 100%; padding: 10px;">
    <tr>
        <th>Take off</th>
        <th>Destination</th>
        <th>Vehicle</th>
        <th>Driver</th>
    </tr>
    <tr>
        <td>From: {{ $data['from'] }}<br>
            Date/Time: {{ $data['ttime'] }}</td>
        <td>{{ $data['to'] }} <br>
            Date / Time {{ $data['atime'] }}</td>
        <td>{{ $data['vehicle'] }}</td>
        <td>{{ $data['driver'] }}</td>
    </tr>
    <tr>
        <td>Type: {{ $data['type'] }}</td>
        <td colspan="3">Note: {{ $data['remarks'] }}</td>
    </tr>
</table>

<p>Thank you.</p>
<br>
IHVN Transport Department
</p>
