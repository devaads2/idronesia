<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
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
            <h3>Report Inventory Drone IDRONESIA</h3>
            <pre>
                Company address
                Tax ID
                phone
                fax
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>Created at :</strong> Linblum - Barrio teatral</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>No.</th>
        <th>Drone Name</th>
        <th>Max. Flying Altitude</th>
        <th>Adjustable Angel Camera</th>
        <th>EIS</th>
        <th>Control Distance</th>
        <th>Wifi Transmission</th>
        <th>Video Resolution</th>
        <th>Photo Resolution</th>
        <th>Product Weight</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($drone as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->drone_name }}</td>
            <td>{{ $item->max_flying_alt }}</td>
            <td>{{ $item->adjustable_angel_camera }}</td>
            <td>{{ $item->eis }}</td>
            <td>{{ $item->control_distance }}</td>
            <td>{{ $item->wifi_transmission }}</td>
            <td>{{ $item->video_res }}</td>
            <td>{{ $item->photo_res }}</td>
            <td>{{ $item->product_weight }}</td>
          </tr>
        @endforeach
      
    </tbody>
  </table>

</body>
</html>