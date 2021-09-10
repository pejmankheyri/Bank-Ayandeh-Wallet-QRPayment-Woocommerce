<?php

/**
 * Plugins main class file
 * 
 * PHP version 8.0
 * 
 * @category  PLugins
 * @package   Wordpress
 * @author    Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright 2021 All rights reserved.
 */

class QRPayment extends WC_Payment_Gateway
{
  public function __construct()
  {
    $this->author = 'pejman kheyri';

    $this->id = 'QRPayment';
    $this->method_title = __('کیف پول بانک آینده', 'woocommerce');
    $this->method_description = __('تنظیمات پرداخت توسط کیف پول بانک آینده برای افزونه فروشگاه ساز ووکامرس', 'woocommerce');
    $this->icon = apply_filters('WC_QRPayment_logo', WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/assets/images/logo.png');
    $this->has_fields = false;

    $this->init_form_fields();
    $this->init_settings();

    $this->title = $this->settings['title'];
    $this->description = $this->settings['description'];

    $this->key = $this->settings['key'];
    $this->TerminalNumber = $this->settings['TerminalNumber'];
    $this->SerialNumber = $this->settings['SerialNumber'];
    $this->durationTime = $this->settings['durationTime'];

    $this->success_massage = $this->settings['success_massage'];
    $this->failed_massage = $this->settings['failed_massage'];

    if (version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>='))
      add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    else
      add_action('woocommerce_update_options_payment_gateways', array($this, 'process_admin_options'));
    add_action('woocommerce_receipt_' . $this->id . '', array($this, 'Check_QRPayment_gateway_status'));
    add_action('woocommerce_api_' . strtolower(get_class($this)) . '', array($this, 'Return_from_QRPayment_gateway'));
  }

  public function init_form_fields()
  {
    $this->form_fields = apply_filters(
      'WC_QRPayment_Config',
      array(

        'base_confing' => array(
          'title' => __('تنظیمات پایه ای', 'woocommerce'),
          'type' => 'title',
          'description' => '',
        ),
        'enabled' => array(
          'title' => __('فعالسازی/غیرفعالسازی', 'woocommerce'),
          'type' => 'checkbox',
          'label' => __('فعالسازی درگاه کیف پول بانک آینده', 'woocommerce'),
          'description' => __('برای فعالسازی درگاه پرداخت کیف پول بانک آینده باید چک باکس را تیک بزنید', 'woocommerce'),
          'default' => 'yes',
          'desc_tip' => true,
        ),
        'title' => array(
          'title' => __('عنوان درگاه', 'woocommerce'),
          'type' => 'text',
          'description' => __('عنوان درگاه که در طی خرید به مشتری نمایش داده میشود', 'woocommerce'),
          'default' => __('کیف پول بانک آینده', 'woocommerce'),
          'desc_tip' => true,
        ),
        'description' => array(
          'title' => __('توضیحات درگاه', 'woocommerce'),
          'type' => 'text',
          'desc_tip' => true,
          'description' => __('توضیحاتی که در طی عملیات پرداخت برای درگاه نمایش داده خواهد شد', 'woocommerce'),
          'default' => __('پرداخت توسط کیف پول بانک آینده شما', 'woocommerce')
        ),
        'key' => array(
          'title' => __('کلید', 'woocommerce'),
          'type' => 'text',
          'description' => __('کلید', 'woocommerce'),
          'default' => '',
          'desc_tip' => true
        ),
        'TerminalNumber' => array(
          'title' => __('کد ترمینال', 'woocommerce'),
          'type' => 'text',
          'description' => __('کد ترمینال', 'woocommerce'),
          'default' => '',
          'desc_tip' => true
        ),
        'SerialNumber' => array(
          'title' => __('سریال ترمینال', 'woocommerce'),
          'type' => 'text',
          'description' => __('سریال ترمینال', 'woocommerce'),
          'default' => '',
          'desc_tip' => true
        ),
        'durationTime' => array(
          'title' => __('زمان انقضا', 'woocommerce'),
          'type' => 'text',
          'description' => __('زمان انقضا به صورت دقیقه، که درصورت خالی بودن 10 دقیقه خواهد بود', 'woocommerce'),
          'default' => 10,
          'desc_tip' => true
        ),
        'payment_confing' => array(
          'title' => __('تنظیمات عملیات پرداخت', 'woocommerce'),
          'type' => 'title',
          'description' => '',
        ),
        'success_massage' => array(
          'title' => __('پیام پرداخت موفق', 'woocommerce'),
          'type' => 'textarea',
          'description' => __('متن پیامی که میخواهید بعد از پرداخت موفق به کاربر نمایش دهید را وارد نمایید . همچنین می توانید از شورت کد {transaction_id} برای نمایش کد پیگیری (شماره تراکنش) استفاده نمایید .', 'woocommerce'),
          'default' => __('با تشکر از شما . سفارش شما با موفقیت پرداخت شد .', 'woocommerce'),
        ),
        'failed_massage' => array(
          'title' => __('پیام پرداخت ناموفق', 'woocommerce'),
          'type' => 'textarea',
          'description' => __('متن پیامی که میخواهید بعد از پرداخت ناموفق به کاربر نمایش دهید را وارد نمایید . همچنین می توانید از شورت کد {fault} برای نمایش دلیل خطای رخ داده استفاده نمایید .', 'woocommerce'),
          'default' => __('پرداخت شما ناموفق بوده است . لطفا مجددا تلاش نمایید یا در صورت بروز اشکال با مدیر سایت تماس بگیرید .', 'woocommerce'),
        )
      )
    );
  }

  public function admin_options()
  {
    $action = $this->author;
    do_action('WC_Gateway_Payment_Actions', $action);
    parent::admin_options();
  }

  public function process_payment($order_id)
  {
    $order = new WC_Order($order_id);
    return array(
      'result' => 'success',
      'redirect' => $order->get_checkout_payment_url(true)
    );
  }

  public function Check_QRPayment_gateway_status($order_id)
  {
    ob_start();
    global $woocommerce;

    $woocommerce->session->order_id_QRPayment = $order_id;

    $order = new WC_Order($order_id);

    $currency = $order->get_currency();
    $currency = apply_filters('WC_QRPayment_Currency', $currency, $order_id);

    $Amount = intval($order->get_total());

    $Amount = apply_filters('woocommerce_order_amount_total_IRANIAN_gateways_before_check_currency', $Amount, $currency);
    if (strtolower($currency) == strtolower('IRT') || strtolower($currency) == strtolower('TOMAN') || strtolower($currency) == strtolower('Iran TOMAN') || strtolower($currency) == strtolower('Iranian TOMAN') || strtolower($currency) == strtolower('Iran-TOMAN') || strtolower($currency) == strtolower('Iranian-TOMAN') || strtolower($currency) == strtolower('Iran_TOMAN') || strtolower($currency) == strtolower('Iranian_TOMAN') || strtolower($currency) == strtolower('تومان') || strtolower($currency) == strtolower('تومان ایران'))
      $Amount = $Amount * 10;
    else if (strtolower($currency) == strtolower('IRHT'))
      $Amount = $Amount * 10000;
    else if (strtolower($currency) == strtolower('IRHR'))
      $Amount = $Amount * 1000;
    else if (strtolower($currency) == strtolower('IRR'))
      $Amount = $Amount * 1;

    $Amount = apply_filters('woocommerce_order_amount_total_IRANIAN_gateways_after_check_currency', $Amount, $currency);
    $Amount = apply_filters('woocommerce_order_amount_total_IRANIAN_gateways_irr', $Amount, $currency);
    $Amount = apply_filters('woocommerce_order_amount_total_QRPayment_gateway', $Amount, $currency);
    $products = array();

    $order_items = $order->get_items();
    foreach ($order_items as $product) {
      $products[] = $product['name'] . ' (' . $product['qty'] . ') ';
    }
    $products = implode(' - ', $products);

    $Description = 'خریدار : ' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . ' | ایمیل خریدار :' . $order->get_billing_email() . ' | موبایل خریدار :' . $order->get_billing_phone() . ' | محصولات : ' . $products;
    $Tell = intval($order->get_billing_phone());

    $Description = apply_filters('WC_QRPayment_Description', $Description, $order_id);
    do_action('WC_QRPayment_Gateway_Payment', $order_id, $Description);

    $CallbackURL = add_query_arg('wc_order', $order_id, WC()->api_request_url('QRPayment'));

    if (!extension_loaded('curl')) {
      $order->add_order_note(__('تابع cURL روی هاست شما فعال نیست .', 'woocommerce'));
      wc_add_notice(__('تابع cURL روی هاست فروشنده فعال نیست .', 'woocommerce'), 'error');
      return false;
    }

    echo "<ul>";

    $successfully_paid = false;
    @$QRPayment_generate = $_POST['QRPayment_generate'];
    @$QRPayment_inquiry = $_POST['QRPayment_inquiry'];
    @$QRPayment_inquiry_QR_name = $_POST['QRPayment_inquiry_QR_name'];
    @$QRPayment_inquiry_token = $_POST['QRPayment_inquiry_token'];
    @$QRPayment_inquiry_deepLink = $_POST['QRPayment_inquiry_deepLink'];

    if ($QRPayment_generate) {
      try {

        $response = QRGenerate_call($this->TerminalNumber, $this->SerialNumber, $Amount, $this->durationTime, $CallbackURL, $this->key);

        if ($response) {
          $response_result = $response->result;
          $response_description = $response->description;
          $response_token = $response->token;
          $response_qrCodeValue = $response->qrCodeValue;
          $response_deepLink = $response->deepLink;
        } else {
          wc_add_notice(__('خطا در هنگام اتصال به سرور کیف پول بانک آینده .', 'woocommerce'), 'error');
          wp_redirect(wc_get_checkout_url());
          exit;
        }
      } catch (\Throwable $th) {

        $Note = sprintf(__('خطا در هنگام اتصال به سرور کیف پول بانک آینده : %s', 'woocommerce'), $response_result);
        $Note = apply_filters('WC_QRPayment_Send_to_Gateway_Failed_Note', $Note, $order_id);
        $order->add_order_note($Note);
        $Notice = sprintf(__('در هنگام اتصال به سرور کیف پول بانک آینده خطای زیر رخ داده است : <br/>%s', 'woocommerce'), $response_description);
        $Notice = apply_filters('WC_QRPayment_Send_to_Gateway_Failed_Notice', $Notice, $order_id);
        if ($Notice) {
          wc_add_notice($Notice, 'error');
        }

        do_action('WC_QRPayment_Send_to_Gateway_Failed', $order_id);

        // throw $th;
      }

      if ($response_qrCodeValue) {

        $QR_name = QRcode($response_qrCodeValue, $order_id);

        echo '<li class="qrcode-description-start"> ابتدا بارکد زیر را توسط نرم افزار کیف پول بانک آینده موبایلتان اسکن و پرداخت نمایید. </li>';
        echo '<li class="qrcode"> <img src="' . plugin_dir_url(dirname(__FILE__)) . 'includes/qrcode/qr_assets/' . $QR_name . '"> <a href="' . $response_deepLink . '"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'includes/assets/images/QRMob.png"></a> </li>';
        echo '<li class="qrcode-description-end"> در صورت پرداخت سفارش، نمایش بارکد حذف و پیغام موفقیت آمیز بودن سفارش نمایش داده می شود. </li>';
        echo "<li class='token'> کد پیگیری : " . $response_token . " </li>";
      } else {
        wc_add_notice(__('خطا در ایجاد QR کد کیف پول بانک آینده .', 'woocommerce'), 'error');
      }
    }
    $action = $this->author;
    do_action('WC_Gateway_Payment_Actions', $action);

    $form = '<form action="" method="POST" name="QRPayment-checkout-form" class="QRPayment-checkout-form" id="QRPayment-checkout-form">';
    if (!$QRPayment_generate && !$QRPayment_inquiry_token) {
      $form .= ' <input type="submit" name="QRPayment_generate" class="button alt" id="QRPayment-generate-button" value="' . __('ایجاد بارکد جهت پرداخت', 'woocommerce') . '"/> ';
    }

    if ($QRPayment_inquiry || $QRPayment_inquiry_token) {

      if ($QRPayment_inquiry_QR_name) {
        echo '<li class="qrcode-description-start"> ابتدا بارکد زیر را توسط نرم افزار کیف پول بانک آینده موبایلتان اسکن و پرداخت نمایید. </li>';
        echo '<li class="qrcode"> <img src="' . plugin_dir_url(dirname(__FILE__)) . 'includes/qrcode/qr_assets/' . $QRPayment_inquiry_QR_name . '"> <a href="' . $QRPayment_inquiry_deepLink . '"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'includes/assets/images/QRMob.png"></a> </li>';
        echo '<li class="qrcode-description-end"> در صورت پرداخت سفارش، نمایش بارکد حذف و پیغام موفقیت آمیز بودن سفارش نمایش داده می شود. </li>';
      }

      if ($QRPayment_inquiry_token) {
        $result = QRIncuiry_call($QRPayment_inquiry_token, $this->key);
      } else {
        $result = [];
      }

      if ($result) {
        if ($result->result === "0") {
          $successfully_paid = true;
          $verifyCode = '';
          echo "<li class='result-code'> موبایل : " . $result->mobile . " </li>";
        } else {
          $successfully_paid = false;
          $verifyCode = $result->result;
          echo "<li class='result-code'> کد خطا : " . $result->result . " </li>";

          $tr_id = '<br/>کد پیگیری : ' . $QRPayment_inquiry_token;

          $Note_failed = sprintf(__('پرداخت شما انجام نشده است : <br> کد خطا : %s <br> %s', 'woocommerce'), $verifyCode, $tr_id);
          $Note_failed = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Note', $Note_failed, $order_id, $verifyCode, $QRPayment_inquiry_token);
          if ($Note_failed)
            $order->add_order_note($Note_failed, 1);

          $Notice_failed = wpautop(wptexturize($this->failed_massage));

          $Notice_failed = str_replace("{transaction_id}", $QRPayment_inquiry_token, $Notice_failed);

          $Notice_failed = str_replace("{fault}", $verifyCode, $Notice_failed);
          $Notice_failed = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Notice', $Notice_failed, $order_id, $verifyCode, $QRPayment_inquiry_token);
          if ($Notice_failed)
            wc_add_notice($Notice_failed, 'error');

          do_action('WC_QRPayment_Return_from_Gateway_Failed', $order_id, $verifyCode, $QRPayment_inquiry_token);
        }
        echo "<li class='result-description'> توضیح : " . $result->description . " </li>";
        echo "<li class='result-token'> کد پیگیری : " . $QRPayment_inquiry_token . " </li>";
        echo "<li class='result-date'> تاریخ پیگیری : " . $result->doTime . " </li>";
      } else {
        wc_add_notice(__('خطا در دریافت اطلاعات پرداخت از سرور کیف پول بانک آینده .', 'woocommerce'), 'error');
      }
    }

    if ($QRPayment_generate || $QRPayment_inquiry || $QRPayment_inquiry_token) {
      if ($QRPayment_generate) {
        $hidden_QR_name = $QR_name;
        $hidden_response_token = $response_token;
      }
      if ($QRPayment_inquiry || $QRPayment_inquiry_token) {
        $hidden_QR_name = $QRPayment_inquiry_QR_name;
        $hidden_response_token = $QRPayment_inquiry_token;
        $hidden_response_deepLink = $QRPayment_inquiry_deepLink;
      }
      $form .= ' <input type="hidden" name="QRPayment_inquiry_QR_name" id="QRPayment_inquiry_QR_name" value="' . $hidden_QR_name . '"/> ';
      $form .= ' <input type="hidden" name="QRPayment_inquiry_token" id="QRPayment_inquiry_token" value="' . $hidden_response_token . '"/> ';
      $form .= ' <input type="hidden" name="QRPayment_inquiry_deepLink" id="QRPayment_inquiry_deepLink" value="' . $hidden_response_deepLink . '"/> ';

      if ($successfully_paid === false) {

        $form .= "<script type='text/javascript'>
            setInterval(function(){ document.forms['QRPayment-checkout-form'].submit(); }, 10000);
          </script>";
        $form .= ' <input style="display: none;" type="submit" name="QRPayment_inquiry" class="button alt" id="QRPayment-payment-button" value="' . __('پیگیری پرداخت', 'woocommerce') . '"/> ';
      }
    }

    if ($successfully_paid === false) {
      $form .= ' <a class="button cancel" href="' . wc_get_checkout_url() . '">' . __('بازگشت', 'woocommerce') . '</a> ';
    }
    $form .= '</form><br/> </ul>';
    $form = apply_filters('WC_QRPayment_Form', $form, $order_id, $woocommerce);

    do_action('WC_QRPayment_Gateway_Before_Form', $order_id, $woocommerce);
    echo $form;
    do_action('WC_QRPayment_Gateway_After_Form', $order_id, $woocommerce);

    $action = $this->author;
    do_action('WC_Gateway_Payment_Actions', $action);

    if ($successfully_paid === true) {

      update_post_meta($order_id, '_transaction_id', $hidden_response_token);

      $order->payment_complete($hidden_response_token);
      $woocommerce->cart->empty_cart();

      $Note_success = sprintf(__('پرداخت موفقیت آمیز بود .<br/> کد پیگیری: %s', 'woocommerce'), $hidden_response_token);
      $Note_success = apply_filters('WC_QRPayment_Return_from_Gateway_Success_Note', $Note_success, $order_id, $hidden_response_token);
      if ($Note_success)
        $order->add_order_note($Note_success, 1);

      $Notice_success = wpautop(wptexturize($this->success_massage));

      $Notice_success = str_replace("{transaction_id}", $hidden_response_token, $Notice_success);

      $Notice_success = apply_filters('WC_QRPayment_Return_from_Gateway_Success_Notice', $Notice_success, $order_id, $hidden_response_token);
      if ($Notice_success)
        wc_add_notice($Notice_success, 'success');

      do_action('WC_QRPayment_Return_from_Gateway_Success', $order_id, $hidden_response_token);

      wp_redirect(add_query_arg('wc_status', 'success', $this->get_return_url($order)));
      exit;
    }
  }

  public function Return_from_QRPayment_gateway()
  {
    global $woocommerce;

    $callback_res = json_decode(file_get_contents('php://input'), true);

    $call_back_result = $callback_res['result'];
    $token = $callback_res['token'];

    $action = $this->author;
    do_action('WC_Gateway_Payment_Actions', $action);
    if (isset($_GET['wc_order']))
      $order_id = $_GET['wc_order'];
    else
      $order_id = $woocommerce->session->order_id_QRPayment;

    if ($order_id) {

      $order = new WC_Order($order_id);

      if ($token) {
        $result = [];
        $result = QRIncuiry_call($token, $this->key);

        if ($result) {
          if ($result->result === "0") {
            update_post_meta($order_id, '_transaction_id', $token);

            $order->payment_complete($token);
            $woocommerce->cart->empty_cart();

            $Note_success = sprintf(__('پرداخت از طریق لینک بازگشتی سرور کیف پول بانک آینده موفقیت آمیز بود .<br/> کد پیگیری: %s', 'woocommerce'), $token);
            $Note_success = apply_filters('WC_QRPayment_Return_from_Gateway_Success_Note', $Note_success, $order_id, $token);
            if ($Note_success)
              $order->add_order_note($Note_success, 1);

            $Notice_success = wpautop(wptexturize($this->success_massage));
            $Notice_success = str_replace("{transaction_id}", $token, $Notice_success);
            $Notice_success = apply_filters('WC_QRPayment_Return_from_Gateway_Success_Notice', $Notice_success, $order_id, $token);
            if ($Notice_success)
              wc_add_notice($Notice_success, 'success');

            do_action('WC_QRPayment_Return_from_Gateway_Success', $order_id, $token);

            wp_redirect(add_query_arg('wc_status', 'success', $this->get_return_url($order)));
            exit;
          } else {

            $tr_id = '<br/>کد پیگیری : ' . $token;

            $Note_failed = sprintf(__('پرداخت شما انجام نشده است : <br> کد خطا : %s <br> %s', 'woocommerce'), $result->result, $tr_id);
            $Note_failed = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Note', $Note_failed, $order_id, $result->result, $token);
            if ($Note_failed)
              $order->add_order_note($Note_failed, 1);

            $Notice_failed = wpautop(wptexturize($this->failed_massage));
            $Notice_failed = str_replace("{transaction_id}", $token, $Notice_failed);
            $Notice_failed = str_replace("{fault}", $result->result, $Notice_failed);
            $Notice_failed = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Notice', $Notice_failed, $order_id, $result->result, $token);
            if ($Notice_failed)
              wc_add_notice($Notice_failed, 'error');

            do_action('WC_QRPayment_Return_from_Gateway_Failed', $order_id, $result->result, $token);

            wp_redirect(wc_get_checkout_url());
            exit;
          }
        } else {
          $action = $this->author;
          do_action('WC_Gateway_Payment_Actions', $action);

          $Note = sprintf(__('خطا در هنگام دریافت اطلاعات پرداخت با فراخوانی لینک بازگشت از سرور کیف پول بانک آینده ', 'woocommerce'));
          $Note = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Note', $Note, $order_id);
          if ($Note)
            $order->add_order_note($Note, 1);

          $Notice = wpautop(wptexturize($this->failed_massage));
          $Notice = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Notice', $Notice, $order_id);
          if ($Notice)
            wc_add_notice($Notice, 'error');

          do_action('WC_QRPayment_Return_from_Gateway_Failed', $order_id);

          wp_redirect(wc_get_checkout_url());
          exit;
        }
      } else {

        $action = $this->author;
        do_action('WC_Gateway_Payment_Actions', $action);

        $tr_id = '<br/>کد خطا : ' . $call_back_result;

        $Note = sprintf(__('خطا در هنگام دریافت توکن با فراخوانی لینک بازگشت از سرور کیف پول بانک آینده : %s', 'woocommerce'), $tr_id);
        $Note = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Note', $Note, $order_id, $call_back_result);
        if ($Note)
          $order->add_order_note($Note, 1);

        $Notice = wpautop(wptexturize($this->failed_massage));
        $Notice = str_replace("{fault}", $call_back_result, $Notice);
        $Notice = apply_filters('WC_QRPayment_Return_from_Gateway_Failed_Notice', $Notice, $order_id, $call_back_result);
        if ($Notice)
          wc_add_notice($Notice, 'error');

        do_action('WC_QRPayment_Return_from_Gateway_Failed', $order_id, $call_back_result);

        wp_redirect(wc_get_checkout_url());
        exit;
      }
    }
  }
}

