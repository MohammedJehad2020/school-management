 <!-- delete_modal_Grade -->
 <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                     {{ trans('grades_trans.delete_Grade') }}
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('grades.destroy', $grade->id) }}" method="post">
                     {{ method_field('Delete') }}
                     @csrf
                     {{ trans('grades_trans.Warning_Grade') }}
                     <input type="text" class="form-control" disabled value="{{ $grade->getTranslation('Name', 'en') }}" name="Name_en" required>
                     <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                         <button type="submit" class="btn btn-danger">{{ trans('grades_trans.Delete') }}</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>