<?php
include "../common/header.php";
include_once '../../core/dbController.php';


if (!isLogin()) {

    header('location:../auth/login.php');

}


$id = $_SESSION['user'];
$query = 'select form_flag , nationality from ' . DB_PREFIX . 'user_details where user_id=:id';
$objectDB = new dbController();
$row = $objectDB->runQuery($query, [':id' => $id]);
$result = $row->fetch(PDO::FETCH_ASSOC);
pr($result);


if ($result['form_flag'] === 1) {


    ?>


    <form action="formProcessor.php" method="post">

        <input type="text" name="mothersName" placeholder="Mothers Name">
        <input type="text" name="fathersName" placeholder="Fathers Name">
        <input type="date" name="dob">
        <select name="nationality">
            <option value="India">India</option>
            <option value="Nepal">Nepal</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Bhutan">Bhutan</option>
        </select>
        <input type="hidden" name="_action" value="step1">
        <button type="submit">Submit</button>

    </form>

    <?php
} elseif ($result['form_flag'] === 2) {


    



    $pan_query="select dob from  ".DB_PREFIX."user_details where user_id=:id";
   
    $pan_row=$objectDB->runQuery($pan_query,[':id'=>$id]);
    $pan_data=$pan_row->fetch(PDO::FETCH_ASSOC);
    echo var_dump($pan_data);
     $dob = $pan_data['dob'];
    $dob = new DateTime($dob);
    $today = new DateTime();
    $age = $dob->diff($today)->y;
  
    // echo "DOB: " . $dob->format('Y-m-d') . "<br>";
    // echo "Today: " . $today->format('Y-m-d') . "<br>";
    // echo "Age: " . $age . "<br>";
    ?>
    <form action="formProcessor.php" method="post">

        <input type="number" name="adhar_number" placeholder="Enter Adhar Number">
        <?php
       if($age>18)
        {
?>
<input type="text" name="pan_number" placeholder="Enter PAN Number">
       <?php }?>
       <input type="hidden" name="age" value=<?php echo $age;?> placeholder="Enter Adhar Number">
        <input type="hidden" name="_action" value="step2">
        <button type="submit">Submit</button>
    </form>
    <?php
} elseif ($result['form_flag'] === 3) {
    ?>

    <form action="formProcessor.php" method="post">

        <input type="text" name="10th_percentage"  placeholder="Enter 10th % upto 2 decimal digits">
        <input type="text" name="12th_percentage"  placeholder="Enter 12th %   upto 2 decimal digits">
        <input type="text" name="grad_percentage"  placeholder="Enter grad %   upto 2 decimal digits">
        <input type="hidden" name="_action" value="step3">
        <button type="submit">Submit</button>
    </form>



    <?php
} elseif ($result['form_flag'] === 4) {
    ?>


    Thank you. your application has been submitted and waiting to be approved.


    <?php
}
?>

<div class="error">

    <?php
    if (!empty($_GET) && isset($_GET['err'])) {
        echo $_GET['err'];
    }

    ?>


</div>

<?php



include "../common/footer.php";



