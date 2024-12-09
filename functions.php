<?php
// functions.php

function isPaidOrder(array $order) : bool
{
    if (array_key_exists('paid', $order)) {
        $isPaid = $order['paid'];
    } else {
        $isPaid = false;
    }

    return $isPaid;
}

function displayCustomer(string $customerEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $customer = $users[$i];
        if ($customerEmail === $customer['email']) {
            return $customer['full_name'] . '(' . $customer['age'] . ' ans)';
        }
    }
}

function getOrders(array $orders) : array
{
    $paidOrder = [];

    foreach($orders as $order) {
        if (isPaidOrder($order)) {
            $paidOrder[] = $order;
        }
    }

    return $paidOrder;
}
