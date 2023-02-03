<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Articles</title>
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
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha maxima</th>
                <th>Nº candidatos</th>
                <th>Ciclo</th>
            </tr>
            @forelse ($articles as $article)
            @if($article-> deleted==0)
            <tr>
                <td>{{ $article->title  }}</td>
                <td>{{ $article->description }} </td>
                <td>{{ $article-> }}</td>
                <td>{{ $article-> }}</td>
                <td>{{ $article-> }}</td>
                <!-- <td><img src="{{ asset('images/'.$article->image) }}" width=150px height=150px></td>
                <td>
                    <form action="{{route('articles.delete', [$article->id])}}" method="POST">                                        
                        <a class="btn btn-primary" href="{{route('articles.edit', [$article->id])}}"><i class="fa fa-pencil"></i></a>
                        @csrf
                        <button type="submit" class="btn btn-danger" ><span class="fa fa-remove"></span></button>    
                    </form>
                </td> -->

            </tr>
            @endif
    </body>
</html>
