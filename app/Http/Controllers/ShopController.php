<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


// use PayPal\Api\Amount;
// use PayPal\Api\Details;
// use PayPal\Api\ExecutePayment;
// use PayPal\Api\Payment;
// use PayPal\Api\PaymentExecution;
// use PayPal\Api\Transaction;

use App\Facade\PayPal;
use PHPUnit\TextUI\ResultPrinter;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function singleProudct($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.singleProduct', compact('product'));
    }
    
    public function orderProduct($id)
    {
        $apiContext = PayPal::apiContext();
      
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        
        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

       
        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);

        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

       
        $baseUrl = "http://blog-w-shop.test/";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
            ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

        
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // For Sample Purposes Only.
        $request = clone $payment;

        
        try {
            $payment->create($apiContext);
        } catch (\Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            print("Created Payment Using PayPal. Please visit the URL to Approve." . $request);
            exit(1);
        }

        
        $approvalUrl = $payment->getApprovalLink();

        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        print("Created Payment Using PayPal. Please visit the URL to Approve." .  "<a href='" . $approvalUrl . "' >" . $approvalUrl ."</a>");

        return $payment;
    }
}
