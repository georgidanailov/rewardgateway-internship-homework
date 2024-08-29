<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php include 'navbar.html' ?>

<div class="main-content w-75 col-md-6 offset-md-2">
    <h2>Transaction History</h2>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="selectCoin" class="form-label">Select Coin</label>
                    <select id="selectCoin" class="form-select">
                        <option selected>Bitcoin</option>
                        <option>Ethereum</option>
                        <option>Cardano</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="paymentType" class="form-label">Payment Type</label>
                    <select id="paymentType" class="form-select">
                        <option selected>All Type</option>
                        <option>Deposit</option>
                        <option>Exchange</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="creationDateFrom" class="form-label">Creation Date</label>
                    <input type="date" class="form-control" id="creationDateFrom">
                </div>
                <div class="col-md-2">
                    <label for="creationDateTo" class="form-label">Creation Date</label>
                    <input type="date" class="form-control" id="creationDateTo">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select">
                        <option selected>All</option>
                        <option>Approved</option>
                        <option>Waiting</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-warning w-100">Search</button>
                </div>
            </div>
        </div>
    </div>

    <h4>History results</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
            <tr>
                <th>Type</th>
                <th>From Coin</th>
                <th>To Coin</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Deposit</td>
                <td>12.000000 BTC</td>
                <td>12.000000</td>
                <td>2022-02-28 13:09:00</td>
                <td class="text-success">Approved</td>
            </tr>
            <tr>
                <td>Exchange</td>
                <td>1.000000 BTC</td>
                <td>1.000000 ADA</td>
                <td>2022-02-28 13:09:21</td>
                <td class="text-success">Approved</td>
            </tr>
            <tr>
                <td>Deposit</td>
                <td>1.000000 BTC</td>
                <td>1.000000</td>
                <td>2022-02-28 14:53:02</td>
                <td class="text-warning">Waiting</td>
            </tr>
            
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.html' ?>

</body>
</html>