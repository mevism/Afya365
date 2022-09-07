<?php

use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #69b899; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
<body  style="margin: 0; padding: 0; background-color:#07313a;" yahoo="fix">
    <?php $this->beginBody() ?>
    <table  style="text-align:center; margin-left:200px; border-collapse: collapse; width: 100%; max-width: 600px; border:0px;">
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table    style="width:100%; border:0px;">
                        <tr>
                            <td  style="margin-left:400px; color: #aaaaaa; font-family: Arial, sans-serif; font-size: 12px;">
                                  <a href="#" style="color: #69b899;"></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td  style=" background:#69b899; padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="img/proui_logo.png" alt="Izzo Computers"   style="display:block;width:152;height:152;" />
                </td>
            </tr>
            <tr>
                <td class="justify-content-center" style=" background-color:#ffffff; padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    <b>Welcome ...</b><br/>
                    <?= $content ?>
                </td>
            </tr>
            <!-- <tr>
                <td class="justify-content-center" style=" background-color:#f9f9f9; padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    <table  style="background-color: #69b899; border:0px" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td  height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a href="#" style="text-align:center; color: #ffffff; text-align: center; text-decoration: none;">Activate Account</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> -->
            <tr>
                <td class="justify-content-center"  style=" background-color:#dddddd; padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>Izzo Computers</b><br/>Moi Avenue &bull; Mombasa, Kenya
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table  style="border: 0px; width:100%;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="justify-content-center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                2022 &copy; <a href="" style="color: #69b899;">Mevis</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
