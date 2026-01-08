<?php

require "connection.php";
session_start();

$receiver = $_SESSION["adminstrator"]["email"];
$sender = $_GET["e"];
$msg_rs = Database::search("SELECT * FROM `dm` WHERE `user`='" . $sender . "'");
Database::iud("UPDATE `dm` SET `status`='1' WHERE `user`='" . $sender . "'");

$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["user"] == $sender && $msg_data["to_admin"] == 1) {

?>

        <!-- received -->
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-8 rounded bg-success">
                    <div class="row">

                        <div class="col-12 pt-2">
                            <span class="text-white fs-4 fw-bold"><?php echo $msg_data["content"]; ?></span>
                        </div>

                        <div class="col-12 text-end pb-2">
                            <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- received -->

    <?php

    } else if ($msg_data["user"] == $sender && $msg_data["to_admin"] == 0)  {

    ?>

        <!-- sent -->
        <div class="col-12 mt-2">
            <div class="row">
                <div class="offset-4 col-8 rounded bg-primary">
                    <div class="row">

                        <div class="col-12 pt-2">
                            <span class="text-white fs-4 fw-bold"><?php echo $msg_data["content"]; ?></span>
                        </div>

                        <div class="col-12 text-end pb-2">
                            <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- sent -->

<?php
    }
}

?>