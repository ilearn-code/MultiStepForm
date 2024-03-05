<?php
include_once "../../core/dbController.php";
include_once "../../core/helper.php";
include_once "../../core/constants.php";
class FormClass extends dbController
{


public function step1($mothersName,$fathersName, $dob , $nationality)
{
    $id=$_SESSION['user'];


    $query="update ".DB_PREFIX."user_details  set user_id=:id , mothers_name=:mothersName, fathers_name=:fathersName, dob=:dob , nationality=:nationality , form_flag=:form_flag where user_id=:id";

    if($nationality==='India')
    {$param=[':mothersName'=>$mothersName ,':fathersName'=>$fathersName , ':dob'=>$dob , ':nationality'=>$nationality ,':id'=>$id , ':form_flag'=>2];
    }
    else
    {
        $param=[':mothersName'=>$mothersName ,':fathersName'=>$fathersName , ':dob'=>$dob , ':nationality'=>$nationality ,':id'=>$id , ':form_flag'=>3];
    
    }
    $row=$this->insertQuery($query,$param); 
    return $row;
}

public function step2($formData)
{
     $id=$_SESSION['user'];

     $adhar_number=$formData['adhar_number'];
  
  



    if ($formData['age']> 18) {

        $pan_number=$formData['pan_number'];
        $query="update ".DB_PREFIX."user_details set adhar_number=:adhar_number, pan_number=:pan_number , form_flag=:form_flag  where user_id=:id";
      
        $row=$this->insertQuery($query,[':adhar_number'=>$adhar_number ,':pan_number'=>$pan_number , ':id'=>$id , ':form_flag'=>3]); 
  
    }
    else
    {
        $query="update ".DB_PREFIX."user_details set adhar_number=:adhar_number , form_flag=:form_flag  where user_id=:id";
        $row=$this->insertQuery($query,[':adhar_number'=>$adhar_number , ':id'=>$id , ':form_flag'=>3]); 
  

    }

    return $row;

}

public function step3($formData)
{


    $id=$_SESSION['user'];
    $tenth_percentage=$formData['10th_percentage'];
    $twelve_percentage=$formData['12th_percentage'];

    $grad_percentage=$formData['grad_percentage'];
    $query="update ".DB_PREFIX."user_details set 10th_percentage=:10th_percentage, 12th_percentage=:12th_percentage , grad_percentage=:grad_percentage, form_flag=:form_flag  where user_id=:id";
    $row=$this->insertQuery($query,[':10th_percentage'=>$tenth_percentage ,':12th_percentage'=>$twelve_percentage ,':grad_percentage'=>$grad_percentage , ':id'=>$id , ':form_flag'=>4]); 
    return $row;

}





}



