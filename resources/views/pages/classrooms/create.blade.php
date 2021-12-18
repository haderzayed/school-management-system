
@section('css')

@endsection

<form method="post" action="{{route('grades.store')}}" >
   @csrf
    <h3> {{trans('grades_trans.add_grade')}}</h3>
    <hr style="width:auto">
    <div class="row">
        <div class="col-md-6">
            <label>  {{trans('grades_trans.stage_name_ar')}}  </label>
            <input type="text" value="" id="stage_name_ar"  class="form-control" name="stage_name_ar"  >
            @error('stage_name_ar')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> {{trans('grades_trans.stage_name_en')}}  </label>
                <input type="text" value="" id="stage_name_en" class="form-control" name="stage_name_en" >
                @error('stage_name_en')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{trans('grades_trans.notes')}} </label>
        <textarea name="notes" class="form-control modal-textarea" id="notes" rows="3"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
        <button class="btn btn-success" id="save-data" type="submit" >{{trans('grades_trans.submit')}}</button>

    </div>
    <br><br>

</form>

@section('js')

   <script type="text/javascript">
      /*  $("#save-data").click(function(e){
            alert('pppppppp');
            e.preventDefault();

            let _token = $("input[name='_token']").val();
            let stage_name_ar = $("#stage_name_ar").val();
            let stage_name_en = $("#stage_name_en").val();
            let notes = $("#notes").val();

            $.ajax({
                url: '{{route('grades.store')}}',
                type:'POST',
                data: {
                    _token:_token,
                    stage_name_ar:stage_name_ar,
                    stage_name_en:stage_name_en,
                    notes:notes,
                },
                success: function(data) {
                    console.log(response);
                    if(response.status==true){
                        Swal.fire({
                            text:response.msg,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    }else{
                        Swal.fire({
                            text:response.msg,
                            icon:'error',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            });

        });*/


    </script>



@endsection
