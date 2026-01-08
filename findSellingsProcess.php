<?php

session_start(); //Starting a session initially or continuing an existing one.

require "connection.php"; //Requiring pre-made "connection.php" file to establish the connection with project's database.

$s = $_POST["s"]; //Grabbing the inserted subject search text that was sent using the POST method.
$d = $_POST["d"]; //Grabbing the selected dates that was sent using the POST method.
$Date1 = $_POST["d1"];
$date = new DateTime($Date1);
$date->add(new DateInterval('P1D')); // P1D means a period of 1 day
$d1 = $date->format('Y-m-d');

$query = " SELECT * FROM `invoice` "; //Starting a query to search project database to select/retrieve data essential for the current scenario.

if (!empty($s) ) { 
    $query .= " WHERE `invoice`.`id` LIKE '%" . $s . "%' "; //Continue's the started query further.
}

if (!empty($s) &&  !empty($d) && empty($d1)) {
    $query .= " AND `date`>='" . $d . "' ";
} else if (empty($s) && empty($s) && !empty($d) && empty($d1) ) {
    $query .= " WHERE `date`>='" . $d . "' ";
} 

if (!empty($s) &&  !empty($d1) && empty($d)) {
    $query .= " AND `date`<='" . $d1 . "' ";
} else if (empty($s) &&  !empty($d1) && empty($d) AND empty($s)) {
    $query .= " WHERE `date`<='" . $d1 . "' ";
} 

if (!empty($s) && !empty($d) && !empty($d1)) {
    $query .= " AND `date`>='" . $d . "' && `date`<='" . $d1 . "' ";
} else if (empty($s) && !empty($d1) && !empty($d) ) {
    $query .= " WHERE `date`>='" . $d . "' && `date`<='" . $d1 . "'  ";
} 

$query .= " ORDER BY `date` DESC "; //Continue's the started query further.


?>

<?php

if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . ""; //Finishing the started query.
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($selected_data = $results_rs->fetch_assoc()) { //This returns an associative array which contains the current row of the result object and automatically advances to the next row.
?>



    <div class="row mb-1">

                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["id"]; ?></label>
                        </div>
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product"] . "'");
                        $product_data = $product_rs->fetch_assoc();
                        ?>
                        <div class="col-3 bg-black text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                        </div>
                        <?php
                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user"] . "'");
                        $user_data = $user_rs->fetch_assoc();
                        ?>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1">
                                <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
                            </label>
                        </div>
                        <div class="col-2 bg-black text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1">Rs.<?php echo $selected_data["total"]; ?>.00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["qty"]; ?></label>
                        </div>
                        <div class="col-2 bg-black d-grid">
                            <?php
                            if ($selected_data["status"] == 0) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Confirm</button>
                            <?php
                            } else if ($selected_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Packing</button>
                            <?php
                            } else if ($selected_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Dispatch</button>
                            <?php
                            } else if ($selected_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Shipping</button>
                            <?php
                            } else if ($selected_data["status"] == 4) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1  rounded-0 disabled" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Delivered</button>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                <?php

                }

                ?>


<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
    <nav aria-label="Page navigation example"> <!--These are codes of pagination features-->
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= 1) {
                                        ?> onclick="findSellings(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                        } else {
                                                                                                            echo ("#");
                                                                                                        } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="findSellings('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="findSellings('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="findSellings('<?php echo ($pageno + 1); ?>')" <?php
                                                                                                            } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>