
<form method="post" action="{{route('Sections.update',$section->id)}}" >
    @csrf
    <h3> {{trans('sections_trans.update_section')}}</h3>
    <hr style="width:auto">
    <div class="row">
        <div class="col-md-6">
            <label>  {{trans('sections_trans.section_name_ar')}}  </label>
            <input type="text" value="{{$section->getTranslation('name','ar') }}" id="section_name_ar"  class="form-control" name="section_name_ar"  >

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> {{trans('sections_trans.section_name_en')}}  </label>
                <input type="text" value="{{$section->getTranslation('name','en') }}" id="section_name_en" class="form-control" name="section_name_en" >

            </div>
        </div>
    </div>

    <div class="col">
        <label for="inputName"
               class="control-label">{{ trans('sections_trans.section_select') }}</label>
        <select  name="grade_id"class="custom-select">
            <!--placeholder-->
            <option value="" selected disabled>{{ trans('sections_trans.section_select') }}</option>
            @foreach($grades as $grade)
                <option value="{{$grade->id}}"  @if($grade ->id == $section -> grade_id) selected @endif>{{$grade->name}}</option>
            @endforeach
        </select>
    </div>
    <br>

    <div class="col">
        <label for="inputName"
               class="control-label">{{ trans('sections_trans.class_select') }}</label>
        <select name="class_id" class="custom-select">

            <option value="{{ $section->classroom->id }}" selected>{{$section->classroom->class_name }}</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
        <button class="btn btn-success" id="save-data" type="submit" >{{trans('grades_trans.submit')}}</button>

    </div>
    <br><br>

</form>


<script>
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change',function (){
            var grade_id=$(this).val();
            if(grade_id){
                $.ajax({
                    url:`{{url('/Sections/classrooms/')}}/${grade_id}`,
                    type:'get',
                    data:"json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }else {
                alert('AJAX load did not work');
            }
        });
    });
</script>
