<?php

$merchantData = [
    'responseURL' => $_POST['host'] . 'slirx_paymentmethod/index/response',
];

if (isset($_POST['merchant_id'])): ?>
    <form action="<?= $merchantData['responseURL'] ?>" method="POST">
        <input type="hidden" name="order_id" value="<?= $_POST['order_id'] ?>"/>

        <div>
            Merchant id: <?= $_POST['merchant_id'] ?>
        </div>
        <div>
            Amount: <?= $_POST['amount'] ?>
        </div>
        <div>
            <label for="transaction_id">Transaction id</label>:
            <input type="text" name="transaction_id" value="<?= rand(1000, 9999) ?>"/>
        </div>
        <div>
            <input type="checkbox" id="paid" name="paid" value="1" checked="checked"/>
            <label for="paid">Paid</label>
        </div>
        <div>
            <input type="submit" value="OK"/>
        </div>
    </form>
<?php
endif;
