@extends('layout') 
@section('content')
        <br>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">                
                    </div>
                </div>
            </div>
        <br>

        <div class="title m-b-md">
                    Noticias
        </div>
        
        <div>
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Ciclo</th>
            </tr>
            @foreach ($articles as $article)
            @if($article-> deleted==0)
            <tr>
                <td>{{ $article->id  }}</td>
                <td>{{ $article->title  }}</td>
                <td>{{ $article->description }} </td>
                <td><img src="{{ asset('images/'.$article->image) }}" width=150px height=150px></td>
                <td>{{ $article->cicle_id }}</td>
            </tr>
            @endif
            @endforeach
        </table>


    <div class="card-footer mr-auto">
        {{$articles->links()}}
    </div>
@endsection
