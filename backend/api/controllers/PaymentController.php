<?php

namespace backend\api\controllers;

use app\api\models\Cart;
use app\api\models\Meals;
use backend\api\models\Sales;
use backend\api\models\SalesMeals;
use backend\api\models\Userprofile;
use yii\db\Connection;
use yii\helpers\Json;
use yii\rest\ActiveController;

function validatecard($number)
{
    global $type;

    $cardtype = array(
        "visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex" => "/^3[47][0-9]{13}$/",
        "discover" => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );

    if (preg_match($cardtype['visa'], $number)) {
        $type = "visa";
        return true;

    } else if (preg_match($cardtype['mastercard'], $number)) {
        $type = "mastercard";
        return true;
    } else if (preg_match($cardtype['amex'], $number)) {
        $type = "amex";
        return true;

    } else if (preg_match($cardtype['discover'], $number)) {
        $type = "discover";
        return true;
    } else {
        return false;
    }
}

class PaymentController extends ActiveController
{
    public $modelClass = 'backend\api\models\Userprofile';

    public function actionPay($id, $card)
    {
        $discount = 0;
        if (validatecard($card)) {

            $profile = Userprofile::findOne(['id' => $id]);
            //cria nova fatura de pagamento
            $sale = new Sales();
            $sale->userprofilesid = $profile->id;

            $cartTotal = 0;
            //$cart = Cart::findAll(["userprofilesid" => $id]);
            $cart = Cart::find()->where(["userprofilesid" => $id])->andWhere(["state" => "active"])->all();
            //calcula preço total do carrinho
            foreach ($cart as $value) {
                $Totalvalue = $value->sellingprice * $value->itemquantity;
                $cartTotal = $cartTotal + $Totalvalue;
            }
            $sale->precototal = $cartTotal;
            //calcula se ha desconto ou nao
            if ($discount == 0) {
                $sale->paidamount = $sale->precototal;
            } else {
                $sale->paidamount = $sale->precototal * ($discount / 100);
                $sale->discount = ($discount / 100);
            }

            $sale->paymentmethod = "card";
            $sale->paymentstate = "paid";
            $sale->save();

            //transfere items do carrinho para a tabela de relaçao com a fatura (sales_meals)
            foreach ($cart as $item) {
                $newLine = new SalesMeals();
                $newLine->salesid = $sale->id;
                $newLine->mealid = $item->mealsid;
                $newLine->sellingprice = $item->sellingprice;
                $newLine->itemquantity = $item->itemquantity;
                $newLine->mesa = $item->mesa;
                $newLine->save();
                $item->state = "paid";
                $item->save();
            }
            $jsonResponse = true;
        } else
            $jsonResponse = false;

        return $jsonResponse;
    }

    public function actionCash($id)
    {
        $discount = 0;

        $profile = Userprofile::findOne(['id' => $id]);
        //cria nova fatura de pagamento
        $sale = new Sales();
        $sale->userprofilesid = $profile->id;

        $cartTotal = 0;
        //$cart = Cart::findAll(["userprofilesid" => $id]);
        $cart = Cart::find()->where(["userprofilesid" => $id])->andWhere(["state" => "active"])->all();
        //calcula preço total do carrinho
        foreach ($cart as $value) {
            $Totalvalue = $value->sellingprice * $value->itemquantity;
            $cartTotal = $cartTotal + $Totalvalue;
        }

        $sale->precototal = $cartTotal;
        //calcula se ha desconto ou nao
        if ($discount == 0) {
            $sale->paidamount = $sale->precototal;
        } else {
            $sale->paidamount = $sale->precototal * ($discount / 100);
            $sale->discount = ($discount / 100);
        }

        $sale->paymentmethod = "cash";
        $sale->paymentstate = "notpaid";
        $sale->save();

        //transfere items do carrinho para a tabela de relaçao com a fatura (sales_meals)
        foreach ($cart as $item) {
            $newLine = new SalesMeals();
            $newLine->salesid = $sale->id;
            $newLine->mealid = $item->mealsid;
            $newLine->sellingprice = $item->sellingprice;
            $newLine->itemquantity = $item->itemquantity;
            $newLine->mesa = $item->mesa;
            $newLine->save();
            $item->state = "notpaid";
            $item->save();
        }
        $jsonResponse = true;

        return $jsonResponse;
    }
}