@extends('layouts.user.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Name</th>
                <th>Room_name</th>
                <th>Room_price</th>
                <th>date_start</th>
                <th>date_end</th>
                <th>pre_water</th>
                <th>current_water</th>
                <th>water_price</th>
                <th>pre_electric</th>
                <th>current_electric</th>
                <th>electric_price</th>
                <th>total_price_service</th>
                <th>bill_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($User_bill as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->room_name }}</td>
                <td>{{ $item->room_price }}</td>
                <td>{{ $item->date_start }}</td>
                <td>{{ $item->date_end }}</td>
                <td>{{ $item->pre_water }}</td>
                <td>{{ $item->current_water }}</td>
                <td>{{ $item->water_price }}</td>
                <td>{{ $item->pre_electricity }}</td>
                <td>{{ $item->current_electricity }}</td>
                <td>{{ $item->electricity_price }}</td>
                <td>{{ $item->total_price_service }}</td>
                <td>{{ $item->bill_id }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection