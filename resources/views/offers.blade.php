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
            @foreach ($offers as $offer)
            @if($offer-> deleted==0)
            <tr>
                <td>{{ $offer->id }}</td>
                <td>{{ $offer->title  }}</td>
                <td>{{ $offer->description }} </td>
                <td type="date">{{ $offer->date_max }}</td>
                <td>{{ $offer->num_candidates }}</td>
                <td>{{ $offer->cicle_id }}</td>
            </tr>
            @endif
            @endforeach
            
        </table>
       
@endsection
