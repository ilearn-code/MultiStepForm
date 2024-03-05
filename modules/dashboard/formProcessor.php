<?php
session_start();
include_once "../../core/constants.php";
include_once "../../core/helper.php";
include_once "./formClass.php";

if (empty($_POST)) {
    die('invalid access');

}

if (!isset($_POST['_action'])) {
    die('invalid access');
}
$action = $_POST;
// pr($_POST);



if ($action['_action'] === 'step1') {


    $err="";

    if (empty($action['mothersName'])) {
        $err.='Mother Name is required <br>';
    }

    if (empty($action['fathersName'])) {
        $err.='father Name is required  <br>';
    }
    if (empty($action['dob'])) {
        $err .= 'Dob is required  <br>';
    } elseif (strtotime($action['dob']) > time()) {
        $err .= 'Date of birth cannot be a future date <br>';
    }

    if (empty($action['nationality'])) {
        $err.='nationality is required <br>';
    }


    if (!nameValidate($action['mothersName']) && !empty($action['mothersName'])) {
        $err.='Enter a valid mothers name <br>';
    }


    if (!nameValidate($action['fathersName'])&& !empty($action['fathersName'])) {
        $err.='Enter a valid Fathers name  <br>';
    }

    if (!dobValidate($action['dob'])&& !empty($action['dob'])) {
        $err.='Enter a valid dob  <br>';
    }
  
    $listNations=['India' , 'Neplal' , 'Bangladesh' , 'Bhutan'];

    if(!in_array($action['nationality'] , $listNations))
    {
        $err.='Enter a valid country  <br>';
    }

    if($err)
    {

        header("location:index.php?err=$err");
        die();
    }



    $mothersName = $action['mothersName'];
    $fathersName = $action['fathersName'];
    $dob = $action['dob'];
  
    $nationality = $action['nationality'];


    $objectForm = new FormClass();
    $row = $objectForm->step1($mothersName, $fathersName, $dob, $nationality);
    if ($row->rowCount()) {

        header("location:index.php");
        exit;
    } else {
        die('form submittion failed');
    }




} elseif ($action['_action'] === 'step2') {


    $err="";
 

    if (empty($action['adhar_number'])) {
        $err.='adhar Number is required <br>';
    }



    if (!preg_match("/^\d{12}/", $action['adhar_number'])&& !empty($action['adhar_number'])) {
        $err.='Enter a valid adhar number  <br>';
    }


    if($_POST['age']>18)
    {
    if (empty($action['pan_number'])) {
        $err.='Pan number  is required  <br>';
    }
    
    if (!preg_match("/^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]$/", $action['pan_number'])&& !empty($action['pan_number'])) {
        $err.='Enter a valid pan number  <br>';
    }
}


    if($err)
    {

        header("location:index.php?err=$err");
        die();
    }

    $objectForm = new FormClass();

    $row = $objectForm->step2($_POST);
    if ($row->rowCount()) {
        
        header("location:index.php");
        exit;
    } else {
        die('form submittion failed');
    }


} elseif ($action['_action'] === 'step3') {



    $err="";


    if (empty($action['10th_percentage'])) {
        $err.='10th percentage is required <br>';
    }

    if (empty($action['12th_percentage'])) {
        $err.='12th percentage  is required  <br>';
    }


    if (empty($action['grad_percentage'])) {
        $err.='grad percentage  is required  <br>';
    }

    if (!preg_match("/^\d{1,2}(\.\d{1,2})?$/", $action['10th_percentage'])&& !empty($action['10th_percentage'])) {
        $err.='Enter a valid 10th percentage  <br>';
    }


    
    if (!preg_match("/^\d{1,2}(\.\d{1,2})?$/", $action['12th_percentage'])&& !empty($action['12th_percentage'])) {
        $err.='Enter a valid 12th percentage  <br>';
    }

    if (!preg_match("/^\d{1,2}(\.\d{1,2})?$/", $action['grad_percentage'])&& !empty($action['grad_percentage'])) {
        $err.='Enter a valid grad percentage  <br>';
    }




    if($err)
    {
        
        header("location:index.php?err=$err");
        die();
    }

    $objectForm = new FormClass();

    $row = $objectForm->step3($_POST);
    if ($row->rowCount()) {
        
        header("location:index.php");
        exit;
    } else {
        die('form submittion failed');
    }
}




?>