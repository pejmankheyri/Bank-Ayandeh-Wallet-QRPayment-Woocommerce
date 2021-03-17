<?php

/**
 * Plugins helper file
 * 
 * PHP version 8.0
 * 
 * @category  PLugins
 * @package   Wordpress
 * @author    Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright 2021 All rights reserved.
 * @license   MIT
 * @version   1.0.0
 */


function QRGenerate_call($TerminalNumber, $SerialNumber, $Amount, $durationTime, $CallbackURL, $key)
{
  $url = 'https://qrpayment.efarda.ir/api/';

  $postData = array(
    'terminalNumber' => $TerminalNumber,
    'serialNumber' => $SerialNumber,
    'amount' => $Amount,
    'callBackUrl' => $CallbackURL,
    'Type' => '1',
    'durationTime' => $durationTime ? $durationTime : 10,
  );
  $postString = json_encode($postData);

  $ch = curl_init($url . "generateQr");
  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'key:' . $key
    )
  );
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

  $result = curl_exec($ch);
  curl_close($ch);

  return json_decode($result);
}

function QRcode($response_qrCodeValue, $order_id)
{
  $qr_code_file_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'qrcode' . DIRECTORY_SEPARATOR . 'qr_assets' . DIRECTORY_SEPARATOR;

  // If directory is not created, create a new directory 
  if (!file_exists($qr_code_file_path)) {
    mkdir($qr_code_file_path);
  }

  $QR_name = $order_id . '_' . time() . '.png';
  $filename  =  $qr_code_file_path . $QR_name;

  $qrCodeValue  =  $response_qrCodeValue;

  // After getting all the data, now pass all the value to generate QR code.
  QRcode::png($qrCodeValue, $filename, "M", 4, 2);

  chmod($filename, 0777);

  return $QR_name;
}

function QRIncuiry_call($token, $key)
{
  $url = 'https://qrpayment.efarda.ir/api/inquiry?token=' . $token;

  $ch = curl_init($url);
  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'key: ' . $key
    )
  );
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  $result = curl_exec($ch);
  curl_close($ch);

  return json_decode($result);
}
