<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student as StudentModel;

class Student extends Component
{
    public $name, $email, $course;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'course' => 'required|string',
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

        session()->flash('message', 'Student added successfully!');
        $this->resetInputFields();

        $this->dispatchBrowserEvent('close-modal');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->course = '';
    }

    public function render()
    {
        return view('livewire.student');
    }
}
