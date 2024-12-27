<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Student as StudentModel;
use Livewire\Component;

class Student extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $email,$phone_number, $course, $student_id;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'email' => ['required', 'email'],
            'course' => 'required|string',
            'phone_number' => ['required', 'regex:/^[6-9][0-9]{9}$/']
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStudent()
    {
        $validatedData = $this->validate();

        StudentModel::create($validatedData);
        session()->flash('message', 'Student Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editStudent(int $student_id)
    {
        $student = StudentModel::find($student_id);
        if ($student) {

            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->email = $student->email;
            $this->phone_number = $student->phone_number;
            $this->course = $student->course;
        } else {
            return redirect()->to('/students');
        }
    }

    public function updateStudent()
    {
        $validatedData = $this->validate();

        StudentModel::where('id', $this->student_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'course' => $validatedData['course']
        ]);
        session()->flash('message', 'Student Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteStudent(int $student_id)
    {
        $this->student_id = $student_id;
    }

    public function destroyStudent()
    {
        StudentModel::find($this->student_id)->delete();
        session()->flash('message', 'Student Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->course = '';
    }

    public function render()
    {

        $students = StudentModel::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(3);
        return view('livewire.student', ['students' => $students]);
    }
}
