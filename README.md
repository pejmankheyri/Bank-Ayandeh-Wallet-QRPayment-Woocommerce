<p align="center">
<img src="https://play-lh.googleusercontent.com/3eRxtWMCBbxTe5bxIcNWB4emRduRafLFXCGz4hlZT1P5RrKqP8V6pf5UAItFaZPkDw=s180" />
</p>
<p align="center">
  <a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://poser.pugx.org/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce/v/stable" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://img.shields.io/packagist/dt/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://poser.pugx.org/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce/d/monthly" alt="Monthly Downloads"></a>
<a href="https://packagist.org/packages/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce"><img src="https://img.shields.io/github/license/pejmankheyri/bank-ayandeh-wallet-qrpayment-woocommerce" alt="License"></a>
<a href="https://app.fossa.com/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce?ref=badge_shield" alt="FOSSA Status"><img src="https://app.fossa.com/api/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce.svg?type=shield"/></a>
</p>

<div dir="rtl">
  
# افزونه پرداخت با کیف پول بانک آینده

نام یک افزونه کاربردی برای سیستم فروشگاه ساز رایگان ووکامرس می باشد که شما را قادر می سازد تا براحتی امکان پرداخت سفارشات توسط کیف پول بانک آینده را برای کاربرانتان فراهم کنید.

مشتریان شما هنگام خرید گزینه پرداخت با کیف پول بانک آینده را انتخاب می کنند و سپس پرداخت انجام می شود.

## نصب با آپلود فایل

* پوشه `QRPayment` را در مسیر `/wp-content/plugins/` کپی کنید.
* افزونه را از طریق منوی `افزونه ها` در وردپرس فعال کنید.
* [تنظیمات افزونه را در بخش `پرداخت ها`ی ووکامرس انجام دهید.](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce/new/master#%D8%AA%D9%86%D8%B8%DB%8C%D9%85%D8%A7%D8%AA)

## نصب از منوی افزونه ها

* وارد منوی افزونه های وردپرس شوید.
* گزینه `افزودن` را در بالای صفحه انتخاب کنید.
* در صفحه باز شده `بارگذاری افزونه` را کلیک نمایید.
* پک افزونه را از بالا بخش `code` قسمت `Download ZIP` دانلود کنید.
* با انتخاب پک افزونه دانلود شده نصب آن را انجام دهید.
* مجددا به قسمت `افزونه ها` بازگردید و افزونه را فعال نمایید.
* [تنظیمات افزونه را انجام دهید.](https://github.com/pejmankheyri/Bank-Ayandeh-Wallet-QRPayment-Woocommerce/new/master#%D8%AA%D9%86%D8%B8%DB%8C%D9%85%D8%A7%D8%AA)


## امکانات

* بخش تنظیمات برای مدیریت بهتر پلاگین از دید کاربر
* نمایش اخطار های (Notice) متناسب با فعالیت کاربر هنگام پرداخت با کیف پول در بخش کاربری فروشگاه ووکامرس
* نمایش و ثبت تمامی یادداشت های (Note) ایجاد شده در پلاگین در صفحه سفارشات بخش یادداشت های ووکامرس
* سازگار با انواع واحد پولی های `ریال`، `تومان`،‌ `هزار ریال` و `هزار تومان`
* مدیریت خودکار پرداخت و وضعیت سفارش کاربر هنگام بازگشت از درگاه (Callback) بانک آینده هنگام موفق بودن پرداخت کاربر
* قابلیت افزودن شورت کد های `{transaction_id}` (کد پیگیری) و  `{fault}` (کد خطا) در بخش پیام های پرداخت موفق و ناموفق

## تنظیمات

* وارد بخش `پیکربندی` در منوی ووکامرس شوید.
* تب `پرداخت ها` را در بالای صفحه انتخاب نمایید.
* کیف پول بانک آینده را پیدا کنید و روی قسمت `مدیریت` کلیک کنید.
* تنظیمات پلاگین را انجام دهید:

    | تنظیمات | توضیح |
    | ------ | ------ |
    | فعالسازی/غیرفعالسازی | فعالسازی درگاه کیف پول بانک آینده |
    | عنوان درگاه | عنوان درگاه که در طی خرید به مشتری نمایش داده میشود |
    | توضیحات درگاه | توضیحاتی که در طی عملیات پرداخت برای درگاه نمایش داده خواهد شد |
    | کلید | کلیدی که از بانک آینده دریافت می کنید |
    | کد ترمینال | کد ترمینالی که برای اتصال به درگاه از بانک آینده دریافت می کنید |
    | سریال ترمینال | سریال ترمینالی که برای اتصال به درگاه از بانک آینده دریافت می کنید |
    | زمان انقضا | زمان انقضای qrکدی که برای پرداخت لازم است کاربر اسکن و پرداخت انجام دهد |
    | پیام پرداخت موفق | متن پیامی که میخواهید بعد از پرداخت موفق به کاربر نمایش دهید |
    | پیام پرداخت ناموفق | متن پیامی که میخواهید بعد از پرداخت ناموفق به کاربر نمایش دهید |

* تغییرات را `ذخیره` کنید.

## کمک به توسعه

از Pull request ها استقبال می کنیم.

برای تغییرات عمده ، لطفاً ابتدا یک issue را باز کنید تا در مورد آنچه می خواهید تغییر دهیم و بحث کنیم.

## لایسنس

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce.svg?type=small)](https://app.fossa.com/projects/git%2Bgithub.com%2Fpejmankheyri%2FBank-Ayandeh-Wallet-QRPayment-Woocommerce?ref=badge_small)

</div>
