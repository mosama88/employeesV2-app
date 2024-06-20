<!-- Basic modal -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة نيابة / إداره</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('dashboard.departments.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group mb-3">
                        <label>أسم النيابة / إداره</label>
                        <input type="text" name="branch" value="{{old('branch')}}" class="form-control @error('car_model') is-invalid @enderror" id="inputName" placeholder="أدخل أسم النيابة">
                        @error('branch')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
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
