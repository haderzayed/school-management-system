


<<form method="post" action="{{route('grades.update',$grade->id)}}" >
   @csrf
    <h3> {{trans('grades_trans.update_grade')}}</h3>
    <hr style="width:auto">
    <div class="row">
        <div class="col-md-6">
            <label>  {{trans('grades_trans.stage_name_ar')}}  </label>
            <input type="text" value="{{ $grade->getTranslation('name','ar') }}" id="stage_name_ar"  class="form-control" name="stage_name_ar" >

            @error('stage_name_ar')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> {{trans('grades_trans.stage_name_en')}}  </label>
                <input type="text" value="{{ $grade->getTranslation('name','en') }}" id="stage_name_en" class="form-control" name="stage_name_en" >
                @error('stage_name_en')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{trans('grades_trans.notes')}} </label>
        <textarea name="notes" class="form-control modal-textarea" id="notes" rows="3">{{$grade->notes}}</textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
        <button class="btn btn-success" id="save-data" type="submit" >{{trans('grades_trans.submit')}}</button>

    </div>
    <br><br>

</form>

