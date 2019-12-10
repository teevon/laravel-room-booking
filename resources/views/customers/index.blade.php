@extends('layouts.app')

@section('title')
  Customer List
@endsection

@section('content')
<h2>No Blade</h2>
<ul>
 <?php
  foreach ($customers as $customer) {
      echo '<li>Hello ' . $customer->name .'</li>';
  }
  ?>
</ul>

<div class="row">
  <div class="col-12">
    <h2>Customer List "Using Blade"</h2>
  </div>
</div>

<div class="row">
  <div class="col-12">
    @can('create', App\Customer::class)
    <p><a href="/customers/create">Add New Customer</a></p>
    @endcan
  </div>
</div>

  @foreach($customers as $customer)
  <div class="row">
    <div class="col-2">
      {{ $customer->id}}
    </div>
    <div class="col-4"> 
     @can('view', $customer)
      <a href="/customers/{{ $customer->id }}"> {{ $customer->name }} </a> 
     @endcan

     @cannot('view', $customer)
      {{ $customer->name }}
     @endcannot
    </div>
    <div class="col-4"> {{ $customer->company->name }}</div>
    <div class="col-2"> {{ $customer->active }}</div>
  </div>
  @endforeach
  <div class="row">
    <div class="col-12 d-flex justify-content-center pt-4">
     {{ $customers->links() }}
    </div>
  </div>

@endsection