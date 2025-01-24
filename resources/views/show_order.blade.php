@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Detail') }}</div>

                    @php
                        $total_price = 0;
                    @endphp

                    <div class="card-body">
                        <h5 class="card-title">Order ID {{ $order->id }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>
                        @if ($order->is_paid == true)
                            <p class="card-text">Paid</p>
                            <img class="img-thumbnail" src="{{ url('storage/payment/' . $order->payment_receipt) }}" alt="Payment Receipt" srcset="">
                        @else
                            <p class="card-text">Unpaid</p>
                        @endif
                        <hr>
                        @foreach ($order->transactions as $transaction)
                       <div class=" d-flex align-items-center justify-content-flex-start mb-3 shadow-sm rounded-3 p-3">
                        <img class="object-fit-cover me-4" src="{{ url('storage/images/' . $transaction->product->image) }}" alt="{{ $transaction->product->name }}" height='100px' witdh='100px'>
                        <h3 class="">{{ $transaction->product->name }} - {{ $transaction->amount }} pcs</h3>
                        @php
                            $total_price += $transaction->product->price * $transaction->amount;
                        @endphp
                       </div>
                        @endforeach
                        <hr>
                        <p>Total: Rp{{ $total_price }}</p>
                        <hr>

                        @if ($order->is_paid == false && $order->payment_receipt == null && !Auth::user()->is_admin)
                            <form action="{{ route('submit_payment_receipt', $order) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Upload your payment receipt</label>
                                    <input type="file" name="payment_receipt" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit payment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
