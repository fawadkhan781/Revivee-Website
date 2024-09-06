<div class="">
    <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{Auth::user()->full_name}}</span></h5>
    <p class="text-grey">Welcome to Atlantis RCM</p>
    <div class="insurance-strip text-white p-2" style="font-size: 15px;">
        <h5>{{$day}} {{date('F', mktime(0, 0, 0, $month, 10));}}</h5>
    </div>
    <div class="user_dashboad_profilcards">
        <div class="container">
        <i class="fa fa-arrow-left mb-3 text-black-50" onclick="billing_folders({{$month}})"></i>
        <form action="javascript:create_billing_documents()" id="billing_documents_id">
            @csrf
            <input type="hidden" name="month" id="month_id" value="{{$month}}">
            <input type="hidden" name="day" id="day_id" value="{{$day}}">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Upload Document</label>
                        <input type="file" name="document_file" class="form-control" accept=
                            "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                            text/plain, application/pdf, image/*">
                    </div>
                </div>
                <div class="col-6 pt-2" >
                    <button type="submit" class="btn btn-info mt-4">Submit</button>
                </div>
            </div>
        </form>
        <hr>
        <h4>Billing Document List</h4>
        @if(isset($billing_documents))
            <div class="row">
                @foreach($billing_documents->billing_document as $billing_document)
                    <div class="pl-3 ">
                        <div><a class="btn btn-info" download href="{{asset('public/billing_documents/'.$billing_document->document_file)}}"><i class="fa fa-file-o"></i> Uploaded File{{$loop->index+1}}</a></div>
                        <i class="fa fa-times-circle text-danger mt-n5" style="margin-left: 140px;background-color: white; border-radius: 5px;" onclick="delete_document({{$billing_document->id}})"></i>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </div>
</div>
