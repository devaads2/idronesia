<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Calendar Invoice</title>

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

  <div class="row justify-content-between align-items-start mb-3">
    <div class="col-md-7">
      <h6>Drone : {{ $droneName }}</h6>
    </div>
  </div>

  <div class="row px-3">
    @foreach ($rangeDate as $item)
    <div class="col-md-2 px-1 mb-3">
      <div class="card" style="border-radius: 5px !important;">
        <div class="card-body mx-auto">{{$item}}</div>
      </div>
    </div>
    @endforeach
  </div>

</body>

</html>