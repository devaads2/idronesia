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
        <th>Kits Name</th>
        <th>Kits Type</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($kits as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->kits_name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->description }}</td>
          </tr>
        @endforeach
      
    </tbody>
  </table>

</body>
</html>