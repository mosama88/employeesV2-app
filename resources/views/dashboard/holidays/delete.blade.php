<!-- End Modal effects-->
<div class="modal" id="delete{{ $holiday->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">إحذر: ستقوم بحذف العملية !</h4>

                <form id="deleteHolidayForm{{ $holiday->id }}" data-id="{{ $holiday->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $holiday->id }}">
                        <h5>{{ $holiday->name }}</h5>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-danger" onclick="deleteHoliday({{ $holiday->id }})">تأكيد البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

