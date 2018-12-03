@extends('APIProducts.layout')
 
@section('content')
<?php 
/*echo "<pre>";
print_r($products); 
echo "</pre>";

echo count($products);
 */
?>
 
 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products from API</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    
     <table class="table table-bordered">
         <tr>
             <th>No</th>
             <th>Name</th>
             <th>Details</th>
             <th width="280px">Action</th>
         </tr>
         @foreach ($products as $product)
         <tr>
          
             <td>{{ $product['name'] }}</td>
             <td>{{ $product['detail'] }}</td>
             <td>{{ $product->detail }}</td>
             <td>
      
             </td>
         </tr>
         @endforeach
     </table>
   
       
      
@endsection