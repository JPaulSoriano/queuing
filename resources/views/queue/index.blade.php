@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <h1 class="text-center font-weight-bold">Queue Form</h1>
            <form method="post" action="{{ route('queue.reg') }}">
                @csrf
                <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="customer_name" placeholder="Your Name" required>
                </div>
                <button type="submit" class="btn btn-primary my-2">Get Queue</button>
            </form>
        </div>
    </div>
</div>
@endsection
