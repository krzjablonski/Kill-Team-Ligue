@if($errors->any())
<div class="row">
  <div class="col">
    <div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Errors:</strong>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endif

@if (Session::has('success'))
<div class="row">
  <div class="col">
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success:</strong> {{Session::get('success')}}
    </div>
  </div>
</div>
@endif
