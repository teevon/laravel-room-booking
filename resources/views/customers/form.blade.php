<div class=form-group>
    <label for="title">Title: </label>
      <input type='text' placeholder="" name="title" value="{{ old('title') ?? $customer->title }}" class="form-control">
      {{ $errors->first('title')}} 
    </div>

    <div class=form-group>
      <label for="name">Name:</label>
      <input type='text' placeholder="" name="name" value="{{ old('name') ?? $customer->name }}" class="form-control">
      {{ $errors->first('name')}} 
    </div>

    <div class=form-group>
      <label for="email">Email:</label>
      <input type='text' placeholder="" name="email" value="{{ old('email') ?? $customer->email }}" class="form-control">
      {{ $errors->first('email')}} 
    </div>

    <div class="form-group">
      <label for='active'>Status</label>
      <select name="active" id="active" class="form-control">
      <option value="" disabled>Select Customer Status</option>
      <option value="1" {{ $customer->active == 'Active' ? 'selected' : '' }}>Active</option>
      <option value="0" {{ $customer->active == 'Inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
      {{ $errors->first('active')}} 
    </div>

    <div class="form-group">
    <label for='company_id'>Company</label>
      <select name="company_id" id="company_id" class="form-control">
      @foreach ($companies as $company)
        <option value='{{$company->id}}'> {{$company->name}} </option>
      @endforeach
      </select> 
    </div>

    @csrf