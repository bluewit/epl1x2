<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Titlecomponent {
 private $titles = array();
 private $separator = '  >  ';
 //private $start = '<div id="breadcrumb">';
 //private $end = '</div>';

 public function __construct($params = array()){
  if (count($params) > 0){
   $this->initialize($params);
  }  
 }
 
 private function initialize($params = array()){
  if (count($params) > 0){
   foreach ($params as $key => $val){
    if (isset($this->{'_' . $key})){
     $this->{'_' . $key} = $val;
    }
   }
  }
 }

 function add($title){  
  if (!$title) return;
  $this->titles[] = array('title' => $title);
 }
 
 function output(){
  $output = '';	
  if ($this->titles) {	
   foreach ($this->titles as $key => $crumb) {	
    if ($key){ 
     $output .= $this->separator;
    }
    $output .= $crumb['title'];
   }  
   return $output;
  }  
  return 'Basecamp168 System';
  
 }

}