<?php
include "../config/db.php";
include "../includes/academic_period.php";
if(isset($_POST['userCategory'])){
    $category = $_POST['userCategory'];
    switch($category){
        case "c3R1ZHk=" :
            $userCategory = "Student";
            echo '<select class="form-control form-control-lg" id="myClass">
                        <option value="">Select Class</option>';
                for($i = 0; $i<count($classData); $i++):
                    echo '<option value="'. $classData[$i]->class.'">'. $classData[$i]->class.'</option>';
                endfor; 
            echo '</select>';
            break;
        case "d29yaw==" :
            $userCategory = "Staff";
            echo '<select class="form-control form-control-lg" id="staffType">
                        <option value="">Select Staff Type</option>
                        <option value="Teaching">Teaching Staff</option>
                        <option value="Non-teaching">Non-teaching Staff</option>
                    </select>';
            break;
    }

}


?>