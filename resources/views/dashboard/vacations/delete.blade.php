@foreach ($vacations as $vacation)
<div class="modal" id="delete{{ $vacation->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">إحذر: ستقوم بحذف العملية!</h4>

                <form id="deleteVacationForm{{ $vacation->id }}" data-id="{{ $vacation->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <h5>
                            @foreach ($vacation->vacationEmployee as $employee)
                            <li style="list-style: none;">{{ $employee->name }}</li>
                            @endforeach
                        </h5>
                        <h6>{{ $vacation->typeVaction() }}</h6>
                        <h6>تفاصيل الأجازه : من يوم <span style="color: blue">{{ $vacation->start }}</span> الى <span style="color: blue">{{ $vacation->to }}</span></h6>
                        <div class="form-group">
                            <input type="hidden" name="page_id" value="1" class="form-control" id="recipient-name">
                            @if ($vacation->image)
                                <input type="hidden" name="filename" value="{{ $vacation->image->filename }}">
                            @endif
                            <input type="hidden" name="id" value="{{ $vacation->id }}">
                        </div>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-danger" onclick="deleteVacation({{ $vacation->id }})">تأكيد البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach