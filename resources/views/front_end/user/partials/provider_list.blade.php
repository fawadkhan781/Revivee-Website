<form action="javascript:add_previous_provider()" id="previous_provider_id">
    @csrf
    <input type="hidden" name="parent_id" value="{{$credential_id}}">
<div class="row ">
    @foreach($provider_list as $provider)
    <div class="col-4">
        <div class="align-items-baseline d-flex form-group">
            <input type="checkbox" name="provider_credential_id[]" id="providers_checkbox" value="{{$provider->credential_id}}" style="-webkit-transform: scale(1.6);margin-right:4px; ">
            <label class="mx-2" for="">{{$provider->provider_name}}</label>
        </div>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center mt-5">
    <button type="submit" class="btn btn-primary mx-2">Add Selected Providers</button>
    <a href="{{route('view_form',$credential_id)}}" class="btn btn-secondary mx-2">Add New Provider</a>
</div>
</form>
