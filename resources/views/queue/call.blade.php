@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center mb-5">
        <h1>Registrar {{ $currentRegistrarNumber }} Queue</h1>
    </div>
    <div class="row my-2">
        <h1>Now Serving:</h2>
        @if ($currentQueue)
            <form method="post" class="form-inline" action="{{ route('queue.call.next', $currentRegistrarNumber) }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Next Queue</button>
            </form>
        @endif
    </div>
    <div class="row my-2">
        @if ($currentQueue)
            <h3>{{ $currentQueue->customer_name }} #{{ $currentQueue->queue_number }}</h3>
        @else
            <h3>No customers in the queue.</p>
        @endif
    </div>
    <div class="row my-2">
        <h1>Queue List:</h2>
        <form method="post" action="{{ route('queue.refresh', $currentRegistrarNumber) }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">Refresh Queue List</button>
        </form>
    </div>
    <div class="row my-2">
        @if (count($queues) > 0)
            <ul class="list-group">
                @foreach ($queues as $queue)
                    <li class="list-group-item">{{ $queue->customer_name }} #{{ $queue->queue_number }}</li>
                @endforeach
            </ul>
        @else
            <p>No customers in the queue.</p>
        @endif
    </div>
</div>
@endsection
