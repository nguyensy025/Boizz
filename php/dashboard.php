<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './layout_dashboard/head.php'; ?>
</head>

<body>
    <div class="main-wrapper">
        <?php include './layout_dashboard/header.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count">
                            <div class="dash-counts">
                                <h4>100</h4>
                                <h5>Customers</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1">
                            <div class="dash-counts">
                                <h4>100</h4>
                                <h5>Suppliers</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2">
                            <div class="dash-counts">
                                <h4>100</h4>
                                <h5>Purchase Invoice</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3">
                            <div class="dash-counts">
                                <h4>105</h4>
                                <h5>Sales Invoice</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="file"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <?php
                    $sql = "SELECT 
                        c.*, i.* 
                        FROM invoices i
                        JOIN checkout c ON i.checkout_id = c.id;
                    ";
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    ?>
                    <div class="card-body">
                        <h4 class="card-title">SUCCESSFUL ORDER</h4>
                        <div class="table-responsive dataview">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>First Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Order Date</th>
                                        <th>Quantity</th>
                                        <th>price</th>
                                        <th>Subtotal</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    foreach ($results as $a) { ?>
                                        <tr>
                                            <td><?php echo $stt; ?></td>
                                            <td><?= $a['firstname'] ?></td>
                                            <td><?= $a['address'] ?></td>
                                            <td><?= $a['email'] ?></td>
                                            <td><?= $a['phone'] ?></td>
                                            <td><?= $a['invoice_date'] ?></td>
                                            <td><?= $a['quantity'] ?></td>
                                            <td><?= number_format($a['price']) ?></td>
                                            <td><?= number_format($a['total_amount']) ?></td>
                                            <td> <a href="edit.php?id=<?= $a['id'] ?>"><button class="btn btn-primary"><?= $a['payment_status'] ?></button></a> </td>
                                        </tr>
                                    <?php
                                        $stt++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>