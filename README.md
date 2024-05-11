<p align="center">
<img src="https://user-images.githubusercontent.com/3329008/111814350-9bf4b900-88ef-11eb-86c6-0461eaf54203.png" /> + 
<img src="https://user-images.githubusercontent.com/3329008/111814402-a8791180-88ef-11eb-8c68-79cc872bc9fb.png" />
</p>
<p align="center">
  <a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://poser.pugx.org/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce/v/stable" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://img.shields.io/packagist/dt/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://poser.pugx.org/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce/d/monthly" alt="Monthly Downloads"></a>
<a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://img.shields.io/github/license/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce" alt="License"></a>
<a href="https://app.fossa.com/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce?ref=badge_shield" alt="FOSSA Status"><img src="https://app.fossa.com/api/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce.svg?type=shield"/></a>
</p>

<div dir="rtl">
  
# Bank Ayandeh wallet payment extension

It is the name of a practical plugin for the free WooCommerce store builder system that enables you to easily provide your users with the possibility of paying for orders using the bank Ayandeh wallet.

Your customers choose the option to pay with the wallet of the bank Ayandeh when shopping, and then the payment is made.

> [Install by uploading a file](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D9%86%D8%B5%D8%A8-%D8%A8%D8%A7-%D8%A2%D9%BE%D9%84%D9%88%D8%AF-%D9%81%D8%A7%DB%8C%D9%84)
> 
> [Install from the plugins menu](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D9%86%D8%B5%D8%A8-%D8%A7%D8%B2-%D9%85%D9%86%D9%88%DB%8C-%D8%A7%D9%81%D8%B2%D9%88%D9%86%D9%87-%D9%87%D8%A7)
> 
> [Features](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D8%A7%D9%85%DA%A9%D8%A7%D9%86%D8%A7%D8%AA)
> 
> [Settings](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D8%AA%D9%86%D8%B8%DB%8C%D9%85%D8%A7%D8%AA)
> 
> [Development Assistance](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%DA%A9%D9%85%DA%A9-%D8%A8%D9%87-%D8%AA%D9%88%D8%B3%D8%B9%D9%87)
> 
> [License](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D9%84%D8%A7%DB%8C%D8%B3%D9%86%D8%B3)
> 
> [Plugin Images](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D8%AA%D8%B5%D8%A7%D9%88%DB%8C%D8%B1-%D8%A7%D9%81%D8%B2%D9%88%D9%86%D9%87)

## Install by uploading a file

* Copy `Bank-Ayandeh-Wallet-QRPayment-Woocommerce` folder to `/wp-content/plugins/` path.
* Activate the plugin through the `Plugins` menu in WordPress.
* [Configure the plugin in the WooCommerce Payments section.](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D8%AA%D9%86%D8%B8%DB%8C%D9%85%D8%A7%D8%AA)

## Install from the plugins menu

* Enter the WordPress plugins menu.
* Select the `Add` option at the top of the page.
* On the page that opens, click `Upload Plugin`.
* Download the plugin pack from the `code` section of the `Download ZIP` section above.
* Select the downloaded plugin pack and install it.
* Go back to the `Extensions` section and activate the extension.
* [Configure the plugin.](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce#%D8%AA%D9%86%D8%B8%DB%8C%D9%85%D8%A7%D8%AA)


## Features

* Settings section for better management of the plugin from the user's point of view
* Displaying notices according to the user's activity when paying with a wallet in the user section of the WooCommerce store
* Display and register all the notes (Notes) created in the plugin on the orders page of the WooCommerce notes section
* Compatible with all types of currency units: Rial, Toman, Thousand Rial and Thousand Toman.
* Automatic management of payment and order status of the user when returning from the Callback portal of Bank Ayandeh when the user's payment is successful
* The ability to add `{transaction_id}` (tracking code) and `{fault}` (error code) short codes in the section of successful and unsuccessful payment messages
* Mobile support when paying

## Settings

* Enter the `configuration` section in the WooCommerce menu.
* Select the `Payments` tab at the top of the page.
* Find the Bank Ayandeh wallet and click on the `Management` section.
* Make plugin settings:

    | Settings | Description |
    | ------ | ------ |
    | Activation/deactivation | Activation of the Bank Ayandeh wallet portal |
    | Port title | The title of the portal that is displayed to the customer during the purchase |
    | Port description | The description that will be displayed during the payment operation for the portal |
    | Key | The key you receive from the Bank Ayandeh |
    | Terminal code | The terminal code that you receive from Bank Ayandeh to connect to the portal |
    | Terminal series | The serial number of the terminal that you receive from Bank Ayandeh to connect to the port |
    | expiration time | The expiration time of the qrcode that the user needs to scan and pay for payment |
    | Successful payment message | The text of the message you want to display to the user after successful payment |
    | Payment failed message | The text of the message you want to display to the user after an unsuccessful payment |

* Save the changes.

## Development Assistance

We welcome pull requests.

For major changes, please open an issue first so we can discuss what you want to change.

## License

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce.svg?type=small)](https://app.fossa.com/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce?ref=badge_small)

</div>

<div dir="rtl">

## Plugin Images

* <a href="https://user-images.githubusercontent.com/3329008/111613124-6ff40d80-87f3-11eb-9c27-a033ea1886b8.png" target="_blank">Image 01</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613161-77b3b200-87f3-11eb-9d62-ce595ae4cf21.png" target="_blank">Image 02</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613226-87cb9180-87f3-11eb-9e0e-ef6c454c8701.png" target="_blank">Image 03</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613259-90bc6300-87f3-11eb-8664-66b69b467ea8.png" target="_blank">Image 04</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613292-97e37100-87f3-11eb-8e3c-37fb94007913.png" target="_blank">Image 05</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613315-9fa31580-87f3-11eb-99cf-5af9441809cd.png" target="_blank">Image 06</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613344-a893e700-87f3-11eb-8776-9b0cb6954315.png" target="_blank">Image 07</a>
* <a href="https://user-images.githubusercontent.com/3329008/111613372-afbaf500-87f3-11eb-8da8-42cca2718fa0.png" target="_blank">Image 08</a>
* <a href="https://user-images.githubusercontent.com/3329008/111614726-299fae00-87f5-11eb-88bc-d5cdadbd2fd8.png" target="_blank">Image 09</a>

</div>
