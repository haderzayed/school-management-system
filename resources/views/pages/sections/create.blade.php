


<form method="post" action="{{route('Sections.store')}}" >
    @csrf
    <h3> {{trans('sections_trans.add_section')}}</h3>
    <hr style="width:auto">
    <div class="row">
        <div class="col-md-6">
            <label>  {{trans('sections_trans.section_name_ar')}}  </label>
            <input type="text" value="" id="section_name_ar"  class="form-control" name="section_name_ar"  >

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> {{trans('sections_trans.section_name_en')}}  </label>
                <input type="text" value="" id="section_name_en" class="form-control" name="section_name_en" >

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
                <option value="{{$grade->id}}">{{$grade->name}}</option>
            @endforeach
        </select>
    </div>
    <br>

    <div class="col">
        <label for="inputName"
               class="control-label">{{ trans('sections_trans.class_select') }}</label>
        <select name="class_id" class="custom-select">

        </select>
    </div>
    <br>
    <div class="col">
        <label for="inputName" class="control-label">{{ trans('teachers_trans.teacher_select') }}</label>
        <select  class="custom-select" name="teacher_id[]" multiple aria-label="multiple select example">
            <!--placeholder-->
            <option value="" selected disabled>{{ trans('teachers_trans.teacher_select') }}</option>
            @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
            @endforeach
        </select>
    </div>
    <br>
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
                        $('select[name="class_id"]').empty();
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

