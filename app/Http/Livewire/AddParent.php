<?php

namespace App\Http\Livewire;

use App\Models\blood;
use App\Models\my_parents;
use App\Models\nationality;
use App\Models\parent_attachment;
use App\Models\religion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public $successMessage ;
    public $catchError ;
    public $updateMode=false;
    public $show_table=true;
    public $currentStep=1,

        $email,$password,$photos,$Parent_id,

    //father input
        $father_name_ar,$father_name_en,
        $job_father_ar, $job_father_en,
        $national_id_father,$passport_id_father,
        $phone_father,$address_father,
        $blood_type_father_id,$religion_father_id,
        $nationality_father_id,

    //mother input
        $mother_name_ar,$mother_name_en,
        $job_mother_ar, $job_mother_en,
        $national_id_mother,$passport_id_mother,
        $phone_mother,$address_mother,
        $blood_type_mother_id,$religion_mother_id,
        $nationality_mother_id
    ;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'national_id_father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father' => 'min:10|max:10',
            'phone_father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'national_id_mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_mother' => 'min:10|max:10',
            'phone_mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities'=>nationality::all(),
            'Type_Bloods'=>blood::all(),
            'Religions'=>religion::all(),
            'my_parents'=>my_parents::all(),
        ]);
    }
    public function ShowFormAdd(){

        $this->show_table=false;
    }

    public function firstStepSubmit(){

      $this->validate([
            'email' => 'required|unique:my_parents,email,'.$this->id ,
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'job_father_ar' => 'required',
            'job_father_en' => 'required',
            'national_id_father' => 'required|unique:my_parents,national_id_father,' . $this->id,
            'passport_id_father' => 'unique:my_parents,passport_id_father,' . $this->id,
            'phone_father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blood_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'address_father' => 'required',
        ]);

        $this->currentStep=2;
    }
    public function secondStepSubmit(){

        $this->validate([

            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'job_mother_ar' => 'required',
            'job_mother_en' => 'required',
            'national_id_mother' => 'required|unique:my_parents,national_id_father,' . $this->id,
            'passport_id_mother' => 'unique:my_parents,passport_id_father,' . $this->id,
            'phone_mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_mother_id' => 'required',
            'blood_type_mother_id' => 'required',
            'religion_mother_id' => 'required',
            'address_mother' => 'required',
        ]);

        $this->currentStep=3;
    }

    public function submitForm(){

        try{
            DB::beginTransaction();
              $my_parents= my_parents::create([
                'email'=>$this->email,
                'password'=>Hash::make($this->password),
                // Father_INPUTS
                'father_name'=> ['en' => $this->job_father_en, 'ar' => $this->father_name_ar],
                'national_id_father'=>$this->national_id_father,
                'passport_id_father'=>$this->passport_id_father,
                'phone_father'=>$this->phone_father,
                'job_father'=>['en' => $this->job_father_en, 'ar' => $this->job_father_ar],
                'address_father'=>$this->address_father,
                'nationality_father_id'=>$this->nationality_father_id,
                'blood_type_father_id'=>$this->blood_type_father_id,
                'religion_father_id'=>$this->religion_father_id,

                // Mother_INPUTS
                'mother_name'=> ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar],
                'national_id_mother'=>$this->national_id_mother,
                'passport_id_mother'=>$this->passport_id_mother,
                'phone_mother'=>$this->phone_mother,
                'job_mother'=>['en' => $this->job_mother_en, 'ar' => $this->job_mother_ar],
                'address_mother'=>$this->address_mother,
                'nationality_mother_id'=>$this->nationality_mother_id,
                'blood_type_mother_id'=>$this->blood_type_mother_id,
                'religion_mother_id'=>$this->religion_mother_id,

            ]);


            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($my_parents['national_id_father'], $photo->getClientOriginalName(), $disk = 'parent_attachments');
                   parent_attachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' =>$my_parents['id'],
                    ]);
                }
            }
            DB::commit();
            $this->successMessage = trans('main_trans.Added Succsesufly');
            $this->clearForm();
            return redirect()->to('/add-parents');
        }catch(\Exception $e){

            $this->catchError = $e->getMessage();
        }
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;

        $My_Parent =    my_parents::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->email = $My_Parent->email;
        $this->password = $My_Parent->password;
        $this->father_name_ar = $My_Parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $My_Parent->getTranslation('father_name', 'en');
        $this->job_father_ar = $My_Parent->getTranslation('job_father', 'ar');;
        $this->job_father_en = $My_Parent->getTranslation('job_father', 'en');
        $this->national_id_father =$My_Parent->national_id_father;
        $this->passport_id_father = $My_Parent->passport_id_father;
        $this->phone_father = $My_Parent->phone_father;
        $this->nationality_father_id = $My_Parent->nationality_father_id;
        $this->blood_type_father_id = $My_Parent->blood_type_father_id;
        $this->address_father =$My_Parent->address_father;
        $this->religion_father_id =$My_Parent->religion_father_id;

        $this->mother_name_ar = $My_Parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $My_Parent->getTranslation('mother_name', 'en');
        $this->job_mother_ar = $My_Parent->getTranslation('job_mother', 'ar');;
        $this->job_mother_en = $My_Parent->getTranslation('job_mother', 'en');
        $this->national_id_mother =$My_Parent->national_id_mother;
        $this->passport_id_mother = $My_Parent->passport_id_mother;
        $this->phone_mother = $My_Parent->phone_mother;
        $this->nationality_mother_id = $My_Parent->nationality_mother_id;
        $this->blood_type_mother_id = $My_Parent->blood_type_mother_id;
        $this->address_mother =$My_Parent->address_mother;
        $this->religion_mother_id =$My_Parent->religion_mother_id;
    }

    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }


    public function submitForm_edit(){

        if ($this->Parent_id){

            my_parents::where('id',$this->Parent_id)->update([
                'email'=>$this->email,
                'password'=>Hash::make($this->password),
                // Father_INPUTS
                'father_name'=> ['en' => $this->job_father_en, 'ar' => $this->father_name_ar],
                'national_id_father'=>$this->national_id_father,
                'passport_id_father'=>$this->passport_id_father,
                'phone_father'=>$this->phone_father,
                'job_father'=>['en' => $this->job_father_en, 'ar' => $this->job_father_ar],
                'address_father'=>$this->address_father,
                'nationality_father_id'=>$this->nationality_father_id,
                'blood_type_father_id'=>$this->blood_type_father_id,
                'religion_father_id'=>$this->religion_father_id,

                // Mother_INPUTS
                'mother_name'=> ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar],
                'national_id_mother'=>$this->national_id_mother,
                'passport_id_mother'=>$this->passport_id_mother,
                'phone_mother'=>$this->phone_mother,
                'job_mother'=>['en' => $this->job_mother_en, 'ar' => $this->job_mother_ar],
                'address_mother'=>$this->address_mother,
                'nationality_mother_id'=>$this->nationality_mother_id,
                'blood_type_mother_id'=>$this->blood_type_mother_id,
                'religion_mother_id'=>$this->religion_mother_id,
            ]);

        }

        return redirect()->to('/add-parents');
    }

    public function delete($id){

        my_parents::find($id)->delete();
        $this->successMessage = trans('main_trans.Delete Succsesufly');
        return redirect()->to('/add-parents');

    }



    //clearForm
    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->national_id_father = '';
        $this->passport_id_father = '';
        $this->phone_father = '';
        $this->job_father ='';
        $this->address_father = '';
        $this->nationality_father_id = '';
        $this->blood_type_father_id = '';
        $this->religion_father_id ='';


        $this->mother_name = '';
        $this->national_id_mother = '';
        $this->passport_id_mother = '';
        $this->phone_mother = '';
        $this->job_mother ='';
        $this->address_mother = '';
        $this->nationality_mother_id = '';
        $this->Nationality_Mother_id = '';
        $this->blood_type_mother_id = '';
        $this->religion_mother_id ='';

    }



    public function back($step){
        $this->currentStep=$step;
    }
}
