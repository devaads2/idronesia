<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Flight Invoice</title>

  <style type="text/css">
    * {
      font-family: Verdana, Arial, sans-serif;
    }

    table {
      font-size: x-small;
    }

    tfoot tr td {
      font-weight: bold;
      font-size: x-small;
    }

    .gray {
      background-color: lightgray
    }
  </style>
</head>

<body>

  <table width="100%">
    <tr>
      <td align="right">
        <h3>{{$title}}</h3>
      </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
      <td><strong>Created at :</strong> Linblum - Barrio teatral</td>
    </tr>

  </table>

  <br />

  <table class="table table-striped mt-3" width="100%">
    <tr>
      <td style="width: 20%;">ID Transaction</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->id_projects }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Start Date</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->start_date }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Until Date</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->until_date }}</td>
    </tr>
    <tr>
      <td>Mission Flight</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->mission_flight }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Location</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->latitude }}, {{ $detail->longitude }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Customer</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->name }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Remote Pilot</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->name }}</td>
    </tr>
  </table>
  <table class="table table-responsive table-striped mt-3">
    <tr>
      <td style="width: 20%;">Drone</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->drone_name }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Batteries</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->batteries_name }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Equipments</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->equipments_name }}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Kit</td>
      <td style="width: 2%;">:</td>
      <td>{{ $detail->kits_name }}</td>
    </tr>
  </table>
  <!-- <div class="text-center">
    <img class="w-50" src="{{ asset('assets/photos/drone.jpeg') }}" alt="">
  </div> -->

</body>

</html>