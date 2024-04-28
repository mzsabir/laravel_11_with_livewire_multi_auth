<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $query='';
    public $lawerys=NULL;
    
    public function boot() 
    {
        if($this->query!="" && strlen($this->query)>1)
        {
            $this->lawerys="Test Lawyer";
            //$brands=Brand::where('brand_name', 'LIKE','%'.$this->query.'%',)->get();
            //$coupons=Coupon::with('brand')->where('text', 'LIKE','%'.$this->query.'%',)->get();
        }
    }    
    public function clear(){ 
        $this->query='';
    }

    public function render()
    {
        return view('livewire.sections.search',['$lawyers'=>$this->lawerys]);
    }
}
