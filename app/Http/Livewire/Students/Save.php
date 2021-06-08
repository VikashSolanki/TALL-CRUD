<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use App\Models\Subject;

class Save extends Component
{
    public $student_id = '';
    public $first_name= '';
    public $last_name= '';
    public $email= '';
    public $phone= '';
    public $dob= '';
    public $title = '';
    public $subjectList =[];
    public $subject_id = '';
    public $selectedId = [];
    public $btnText = '';

    /**
     * Set the validation message
     */
    protected $messages = [
        'first_name.required' => 'The First name cannot be empty.',
        'last_name.required' => 'The Last name cannot be empty.',
        'email.required' => 'The Email cannot be empty.',
        'email.email' => 'The Email format is not valid.',
        'phone.required' => 'The Phone number cannot be empty.',
        'dob.required' => 'The Date of Birth cannot be empty.',
        'dob.before' => 'The Date of Birth must be a date before today',
        'subject_id.required' => 'Please select subject',
        'subject_id.array' => 'Please select subject'
    ];

    /**
     * Add the validation rules
     */
    protected function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'dob' => 'required|before:today',
            'subject_id' => 'required|array',
            'email' => 'required|string|email|max:255|unique:students,email,' . $this->student_id
        ];
    }
  
    /**
     * The attributes that are mass assignable.
     * Render the create or update page
     *
     * @var array
     */
    public function render()
    {
        $this->title = empty($this->title) ? "Create new student" : $this->title;
        $this->btnText = empty($this->btnText) ? "Create" : $this->btnText;
        $this->subjectList = Subject::getSubjectList();
        
        return view('livewire.students.save');
    }
  
    /**
     * Save the student details
     * Update the student details
     *
     * @var array
     */
    public function store()
    {
        $this->validate();
        try {
            $studentSave = Student::updateOrCreate(['id' => $this->student_id], [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'dob' => $this->dob
            ]);
            if ($studentSave) {
                if (!empty($this->subject_id)) {
                    Subject::saveSubject($studentSave, $this->subject_id);
                }
                $messsage = ($this->student_id) ? 'Student updated successfully.' : 'Student created successfully.';
                session()->flash('message', $messsage);
            } else {
                session()->flash('message', 'Opps somethis wrong!!');
            }
            
            return redirect()->route('students.list');
        } catch (\Exception $ex) {
            session()->flash('message', 'Opps somethis wrong!!');

            return redirect()->route('students.list');
        }
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function mount($id = '')
    {
        if ($id) {
            $this->title = "Update student detail";
            $this->btnText = "Update";
            $this->students = Student::with('subjects')->find($id);
            $this->selectedId = !empty($this->students->subjects) ? $this->students->subjects->pluck('id')->toArray() : [];
            $this->student_id = $this->students->id ?? '';
            $this->first_name = $this->students->first_name ?? '';
            $this->last_name = $this->students->last_name ?? '';
            $this->email = $this->students->email ?? '';
            $this->phone = $this->students->phone ?? '';
            $this->dob = $this->students->dob ?? '';
        }
        $this->students = new Student();
    }
}
