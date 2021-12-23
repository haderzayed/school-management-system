@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents_trans.name_ar')}}</label>
                        <input type="text" wire:model="mother_name_ar" class="form-control" >
                        @error('mother_name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.name_en')}}</label>
                        <input type="text" wire:model="mother_name_en" class="form-control" >
                        @error('mother_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.job_ar')}}</label>
                        <input type="text" wire:model="job_mother_ar" class="form-control">
                        @error('job_mother_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.job_en')}}</label>
                        <input type="text" wire:model="job_mother_en" class="form-control">
                        @error('job_mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.National_ID')}}</label>
                        <input type="text" wire:model="national_id_mother" class="form-control">
                        @error('national_id_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Passport_ID')}}</label>
                        <input type="text" wire:model="passport_id_mother" class="form-control">
                        @error('passport_id_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.Phone')}}</label>
                        <input type="text" wire:model="phone_mother" class="form-control">
                        @error('phone_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents_trans.Nationality_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="nationality_mother_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        @error('nationality_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents_trans.Blood_Type_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_mother_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        @error('blood_type_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parents_trans.Religion_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="religion_mother_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('religion_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parents_trans.Address')}}</label>
                    <textarea class="form-control" wire:model="address_mother"   id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('address_mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                {{trans('parents_trans.Back')}}
                </button>

                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="secondStepSubmit">{{trans('parents_trans.Next')}}
                </button>

            </div>
        </div>
    </div>
