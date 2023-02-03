<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>offers</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" 
        rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet"/>
    </head>

    <body> 
        <br>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">                
                    </div>
                </div>
            </div>
        <br>

        <div class="title m-b-md">
                    Ofertas
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha maxima</th>
                <th>Nº candidatos</th>
                <th>Ciclo</th>
            </tr>
            @forelse ($offers as $offer)
            @if($offer-> deleted==0)
            <tr>
                <td>{{ $offer->id }}</td>
                <td>{{ $offer->title  }}</td>
                <td>{{ $offer->description }} </td>
                <td>{{ $offer->date_max }}</td>
                <td>{{ $offer->num_candidates }}</td>
                <td>{{ $offer->cicle_id }}</td>
            </tr>
            @endif
    </body>
</html>
