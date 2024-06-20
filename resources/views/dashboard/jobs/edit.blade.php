<!-- Basic modal -->
<div class="modal" id="edit{{ $job->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل بيانات الدرجه الوظيفية</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('dashboard.jobs.update', 'test') }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $job->id }}">

                    <div class="form-group mb-3">
                        <label>أسم الدرجه الوظيفية</label>
                        <input type="text" name="name" value="{{$job->name}}" class="form-control" id="inputName" placeholder="أدخل أسم الوظيفة">
                    </div>

                    
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit" type="button">تأكيد البيانات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->



