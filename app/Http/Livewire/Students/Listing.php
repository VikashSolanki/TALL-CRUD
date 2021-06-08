<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $first_name = '';
    public $last_name= '';
    public $email= '';
    public $phone= '';
    public $dob= '';
    public $page = 1;
    public $search = '';
    public $perPage = 5;
    public $sortField ='id';
    public $sortAsc = false;
    protected $queryString = ['search'];
    
    /**
     * Listing the all student details
     * Searching and sorting the student details with pagination
     *
     * @return
     */
    public function render()
    {
        $this->search = trim($this->search);
        $this->page = (request('page')) ? request('page') : $this->page;
        
        return view('livewire.students.index', [
            'students' => Student::with('subjects')
            ->orWhereRaw("concat(first_name, ' ', last_name) like '%$this->search%' ")
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('phone', 'like', '%'.$this->search.'%')
            ->orWhere('dob', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage)
        ]);
    }
    
    /**
     * Sort the column for sorting
     *
     * @return string
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    /**
     * Update the search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Open the edit form
     *
     * @var array
     */
    public function edit($id)
    {
        return redirect()->route('students.edit', ['id' => $id]);
    }
     
    /**
     * Delete the student details
     *
     * @var array
     */
    public function delete($id)
    {
        try {
            $student = Student::find($id)->delete();
            if ($student) {
                session()->flash('message', 'Student deleted successfully.');
            } else {
                session()->flash('error', 'Opps somethis wrong!!');
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Opps somethis wrong!!');
        }
    }
}
