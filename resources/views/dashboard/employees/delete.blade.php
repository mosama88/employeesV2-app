<!-- End Modal effects-->
<div class="modal" id="delete{{ $employee->id }}">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">إحذر: ستقوم بحذف العملية !</h4>

                <form action="{{ route('dashboard.employees.destroy', $employee->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h5>{{ $employee->name }}</h5>

                        <div class="form-group">
                            <input type="hidden" name="page_id" value="1" class="form-control"
                                   id="recipient-name">
                            @if ($employee->image)
                                <input type="hidden" name="filename" value="{{ $employee->image->filename }}">
                            @endif
                            <input type="hidden" name="id" value="{{ $employee->id }}">
                        </div>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-danger">تأكيد البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
