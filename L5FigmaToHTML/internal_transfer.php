<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Transfer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php include 'navbar.html' ?>

<div class="main-content w-75 col-md-6 offset-md-2">
    <h2>Internal Transfer</h2>
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Deposit to trading account</h5>
                    <p>Available USDT: 208849.740000 USDT</p>
                    <div class="mb-3">
                        <input type="text" class="form-control mb-2" placeholder="Amount">
                        <select class="form-select mb-2">
                            <option selected>Tether</option>

                        </select>
                        <button class="btn btn-warning w-100">Deposit</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Withdrawal from trading account</h5>
                    <p>Available USDT: 49374.318959945 USDT</p>
                    <div class="mb-3">
                        <input type="text" class="form-control mb-2" placeholder="Amount">
                        <select class="form-select mb-2">
                            <option selected>Tether</option>

                        </select>
                        <button class="btn btn-warning w-100">Withdraw</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.html' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>