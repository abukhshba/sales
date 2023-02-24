@extends('layout')
@section('body-content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>date</th>
                <th>user</th>
                <th>user</th>
                <th>products</th>
                <th>overall price</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->created_at}}</td>
                    <td>{{ $bill->users->name }}</td>
                    <td>
                        @forelse($products as $product)

                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product->name}}</td>

                        </tr>
                    </td>
                    <td></td>


                    <td><a class="btn btn-danger" href="{{ url("admin/bill/delete/$bill->id") }}">delete</a></td>
                </tr>
                @empty

                <tr>
                  <td class="text-center" colspan="6">no data found</td>
                </tr>
                @endforelse
        </tbody>
    </table>
@endsection
