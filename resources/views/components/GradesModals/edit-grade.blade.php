 <!-- edit_modal_grade -->
 <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                     {{ trans('grades_trans.edit_Grade') }}
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 
                 <!-- add_form -->
                 <form action="{{ route('grades.update', $grade->id) }}" method="post">
                     {{ method_field('patch') }}
                     @csrf
                     <div class="row">
                         <div class="col">
                             <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                 :</label>
                             <input id="Name" type="text" name="Name" class="form-control" value="{{ $grade->getTranslation('Name', 'ar') }}" required>
                             <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                         </div>
                         <div class="col">
                             <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                 :</label>
                             <input type="text" class="form-control" value="{{ $grade->getTranslation('Name', 'en') }}" name="Name_en" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                             :</label>
                         <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->Notes }}</textarea>
                     </div>
                     <br><br>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                         <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 </div>