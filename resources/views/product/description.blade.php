<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
   <style>
       h3{
           color: #388b82;
       }
   </style>
</head>
<body>
<div class="container">
    <h3>Product Description</h3>
    <table>
            <tr>
                <td>
                    <p>{!! $data->description !!}</p>
                </td>
            </tr>
    </table>
    <h3>Product About</h3>
    <p>{!! $data->about !!}</p>
</div>
</body>
</html>
