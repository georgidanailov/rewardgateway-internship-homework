<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php include 'navbar.html' ?>

<div class="p-4 w-75 col-md-6 offset-md-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Wallet Overview</h2>
        <div>
            <button class="btn btn-warning me-2">Deposit</button>
            <button class="btn btn-secondary me-2">Withdraw</button>
            <button class="btn btn-secondary">Transfer</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Estimated Balance</h5>
                    <h3 class="card-text">993.313456 BTC</h3>
                    <div class="chart-container">

                        <img src="https://via.placeholder.com/250x150.png" alt="Asset Allocation" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4>Fiat Balance</h4>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">EUR</h5>
                    <p class="card-text">208849.74 EUR</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">USD</h5>
                    <p class="card-text">58849.74 USD</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">BGN</h5>
                    <p class="card-text">301849.74 EUR</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
    </div>

    <h4>Crypto Balance</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ADA</h5>
                    <p class="card-text">1712.00 ADA</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">BTC</h5>
                    <p class="card-text">993.313456 BTC</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ETH</h5>
                    <p class="card-text">82.02 ETH</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">USDT</h5>
                    <p class="card-text">208849.74 ADA</p>
                    <button class="btn btn-warning">Deposit</button>
                    <button class="btn btn-secondary">Exchange</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.html' ?>

</body>
</html>