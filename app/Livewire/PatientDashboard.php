<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class PatientDashboard extends Component
{   
    use WithPagination;
    public $perPage = 5;
    public $searchName = "";
    public $searchEmail = "";
    public $searchCountry = "";
    public $gender = "";
    public $sortBy='created_at';
    public $sortDir='DESC';
    public $createdStartDate = "";
    public $createdEndDate = "";
    public $dobStartDate = "";
    public $dobEndDate = "";

    protected $queryString = [
        'sortBy' => ['except' => 'created_at'],
        'sortDir' => ['except' => 'DESC'],
        'searchName' => ['except' => ''],
        'searchEmail' => ['except' => ''],
        'gender' => ['except' => ''],
        'perPage' => ['except' => 5],
        'searchCountry' => ['except' => ''],
        'createdStartDate' => ['except' => ''],
        'createdEndDate' => ['except' => ''],
        'dobStartDate' => ['except' => ''],
        'dobEndDate' => ['except' => ''],
    ];

    public function updatedSearch(){
        $this->resetPage();
    }

    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir === "ASC")? "DESC":"ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function resetFilters(){
        $this->reset(['searchName', 'searchEmail', 'searchCountry', 'gender', 'createdStartDate', 'createdEndDate', 'dobStartDate', 'dobEndDate', 'sortBy', 'sortDir', 'perPage']);
    }

    public function render(){

        return view('livewire.patient-dashboard', [
            'patients' => Patient::when($this->searchName, function($query) {
                $query->where('first_name', 'like', '%' . str_replace(' ', '', $this->searchName) . '%')
                      ->orWhere('last_name', 'like', '%' . str_replace(' ', '', $this->searchName) . '%');
            })
            ->when($this->searchEmail, function($query) {
                $query->where('email', 'like', '%' . $this->searchEmail . '%');
            })
            ->when($this->searchCountry !== '', function($query) {
                $query->where('country', 'like', '%' . $this->searchCountry . '%');
            })
            ->when($this->gender !== '', function($query){
                $query->where('gender', $this->gender);
            })
            ->when($this->createdStartDate, function($query) {
                $query->whereDate('created_at', '>=', $this->createdStartDate);
            })
            ->when($this->createdEndDate, function($query) {
                $query->whereDate('created_at', '<=', $this->createdEndDate);
            })
            ->when($this->dobStartDate, function($query) {
                $query->whereDate('birth_date', '>=', $this->dobStartDate);
            })
            ->when($this->dobEndDate, function($query) {
                $query->whereDate('birth_date', '<=', $this->dobEndDate);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
