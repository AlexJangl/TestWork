<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="mdb.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="mr-2">Users</h1>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <div class="butBlock butUp"></div>
                                    <div class="result my-5">

                                    </div>
                                    <div class="butBlock butDown"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    include_once 'deleteModal.php';
                    include_once 'userModal.php';
                    include_once 'userErrorModal.php';
                    include_once 'selectErrorModal.php';
                ?>
            </div>
        </div>
    </div>
</div>
<script src="jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" charset="utf-8" src="main.js"></script>
</body>
</html>
