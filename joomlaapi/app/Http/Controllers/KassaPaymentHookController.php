<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\OrderVirtuemart;
use YandexCheckout\Model\Notification\NotificationSucceeded;
use YandexCheckout\Model\Notification\NotificationWaitingForCapture;
use YandexCheckout\Model\NotificationEventType;

class KassaPaymentHookController extends Controller
{
    public function index(Request $request) {
        $json = file_get_contents('php://input');
        $requestBody= json_decode($json, true);
        $orderid = $request->input('orderid');
        
        try {
            $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        } catch (Exception $e) {
            return array('error'=>true);
        // Обработка ошибок при неверных данных
        }
        
        $payment = $notification->getObject();
        
        $ov = OrderVirtuemart::where('virtuemart_order_id', $orderid)->first();
        $ov->order_status = 'C';
        $ov->save();
    }
}