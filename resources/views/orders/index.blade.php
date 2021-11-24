@extends('layouts.admin')

@section('title', 'Orders List')
@section('content-header', 'Order List')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-primary">Open POS</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mt-3 mb-5">
            <div class="offset-4 col-md-8">
                <form action="{{route('orders.index')}}">
                    <div class="row align-items-center">
                        <div class="col-md-5 d-flex align-items-center">
                            <label class="col-3 px-0"  for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control col-9" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5 d-flex align-items-center">
                            <label class="col-3 px-0"  for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date"  class="form-control col-9" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Received Amount</th>
                    <th>Status</th>
                    <th>To Pay</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Change</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('orders.destroy', $order)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

