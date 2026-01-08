<?php
session_start();
require "connection.php";


$recever_email = $_SESSION["logged-in-user"]["email"];

$msg_rs = Database::search("SELECT * FROM `dm` WHERE `user`='" . $recever_email . "' ");
$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["user"] == $recever_email && $msg_data["to_admin"] == 0) {
        $img_rs = Database::search("SELECT * FROM `admin_pfp` ");
        $img_data = $img_rs->fetch_assoc();


?>
        <!-- sender -->
        <div class="media w-75">
            <?php
            if (isset($img_data["path"])) {
            ?>
                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">&nbsp;&nbsp;<span class="badge bg-black">Pa's Crew Member</span>
            <?php
            } else {
            ?>
                <img src="resource/basic_user.svg" width="50px" class="rounded-circle">&nbsp;&nbsp;<span class="badge bg-black">Pa's Crew Member</span>
            <?php
            }

            ?>

            <div class="media-body me-4">
                <div class="bg-black rounded py-2 px-3 mb-2 rounded-0">
                    <p class="mb-0 fw-bold text-white"><?php echo $msg_data["content"]; ?></p>
                </div>
                <p class="small fw-bold text-black-50 text-end mb-5"><?php echo $msg_data["date_time"]; ?></p>

            </div>
        </div>
        <!-- sender -->
    <?php

    } else if ($msg_data["user"] == $recever_email && $msg_data["to_admin"] == 1) {

    ?>
        <!-- receiver -->
        <div class="offset-3 col-9 media w-75 text-end justify-content-end align-items-end">

            <div class="media-body">
                <div class="bg-primary rounded py-2 px-3 mb-2  rounded-0">
                    <p class="mb-0 text-white"><?php echo $msg_data["content"]; ?></p>
                </div>
                <p class="small fw-bold text-black-50 text-end mb-5"><?php echo $msg_data["date_time"]; ?></p>
            </div>
        </div>
        <!-- receiver -->
<?php
    }
    if ($msg_data["status"] == 2 && $msg_data["to_admin"] == 0) {
        Database::iud("UPDATE `dm` SET `status`='1' WHERE `user`='" . $recever_email . "'");
    }
}

?>