


<<form method="post" action="{{route('Classrooms.update',$classroom->id)}}" >
   @csrf
    <h3> {{trans('classrooms_trans.update_classroom')}}</h3>
    <hr style="width:auto">
    <div class="row">
        <div class="col-md-6">
            <label>  {{trans('grades_trans.stage_name_ar')}}  </label>
            <input type="text" value="{{ $classroom->getTranslation('class_name','ar') }}" id="stage_name_ar"  class="form-control" name="stage_name_ar" >

            @error('stage_name_ar')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> {{trans('grades_trans.stage_name_en')}}  </label>
                <input type="text" value="{{ $classroom->getTranslation('class_name','en') }}" id="stage_name_en" class="form-control" name="stage_name_en" >
                @error('stage_name_en')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{trans('grades_trans.notes')}} </label>
        <select name="grade" class="select2 form-control">
            @if($grades-> count() > 0)
                @foreach($grades as $grade)
                    <option value="{{$grade-> id }}" @if($grade ->id == $classroom -> grade_id) selected @endif>{{$grade ->name}}</option>
                @endforeach
            @endif

        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
        <button class="btn btn-success" id="save-data" type="submit" >{{trans('grades_trans.submit')}}</button>

    </div>
    <br><br>

</form>

