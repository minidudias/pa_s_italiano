<?php
require "connection.php";

if(isset($_GET["ca"])){
    $cat_id=$_GET["ca"];

    $bra_rs=Database::search("SELECT * FROM `attribute` WHERE `category_id`='".$cat_id."'");
    $bra_nr=$bra_rs->num_rows;

    if($bra_nr>0){

        for($x=0; $x<$bra_nr; $x++){

        $brad=$bra_rs->fetch_assoc();
        ?>
        <option value="0" hidden>Select Meal Attribute from the List</option>
        <option value="<?php echo $brad["id"]; ?>"> <?php echo $brad["attribute"];?> </option> 
        <?php
        }        

    }else{

        $all_brands=Database::search("SELECT * FROM `attribute`");
        $all_num=$all_brands->num_rows;

        for($y=0;$y<$all_num;$y++){
            $all_data=$all_brands->fetch_assoc(); ?>
        <option value="<?php echo $all_data["id"]; ?>"> <?php echo $all_data["attribute"];?> </option> 
        <?php                
        }

    }
}

