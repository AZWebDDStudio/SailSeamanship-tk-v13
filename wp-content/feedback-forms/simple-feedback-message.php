<?php session_start(); ?>

<!DOCTYPE HTML>

<html>
<head>
<title>страница отправки</title>
<link href="form-styles/simple-feedback-message.css" rel="stylesheet" type="text/css" />
</head>

<body class="feedback">

<?php
error_reporting(0);

// Вывод формы
        function show_form() {
            $_SESSION['code'] = rand(1000, 9999);
            ?>

            <form action="" method="post">
                <div class="form-title">Сообщение для Yacht Seamanship</div>
                <div class="table">
                    <table>
                        <tr>
                            <td>
                                <div class="label">
                                    От (имя, фамилия): <span class="note">*</span>
                                </div>
                            </td>
                            <td>
                                Ваш @EMail: <span class="note">*</span>
                            </td>
                        </tr>
                        <tr>
                            <!--Поле ввода От:-->
                            <td>
                                <input type="text" name="input_name[0]" size="39" value="<?php
                                substr(htmlspecialchars(trim($_POST['input_name'][0])), 0, 500);
                                echo $_POST['input_name'][0];
                                ?>">
                                <input type="hidden" name="check[]" value="1">
                                <div class="subscribe">
                                    Пожалуйста, указывайте настоящее имя<br />
                                    и фамилию. На прозвища мы не реагируем.
                                </div>
                            </td>

                            <!--Поле ввода @EMail:-->
                            <td>
                                <input type="text" name="input_name[1]" size="39" value="<?php
                                substr(htmlspecialchars(trim($_POST['input_name'][1])), 0, 500);
                                echo $_POST['input_name'][1];
                                ?>">
                                <input type="hidden" name="check[]" value="1">
                                <div class="subscribe">
                                    Пожалуйста, указывайте реальный адрес.
                                </div>
                            </td>
                        </tr>

                        <!--Поле Текст сообщения:-->
                        <tr>
                            <td colspan="2">
                                <div class="label">
                                    Текст сообщения: <span class="note">*</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea rows="5" cols="30" name="input_name[2]"><?php
                                    substr(htmlspecialchars(trim($_POST['input_name'][2])), 0, 10000);
                                    echo $_POST['input_name'][2];
                                    ?></textarea>
                                <input type="hidden" name="check[]" value="1">
                            </td>
                        </tr>

                        <!--CAPTCHA:-->
                        <tr>
                            <td colspan="2">
                                <div class="label">
                                    Код подтверждения:
                                </div>
                                <input type="text" id="code" name="code" size="4" maxlength="4">
                                <img src="captcha.php" style="vertical-align: bottom;">
                            </td>
                        </tr>
                        
                        <!--Реферал-страница-->
                        <tr>
                            <td colspan="2"> 
                                <input type="hidden" name="pagetitle[1]" value="<?php $referer_page = $_SERVER['HTTP_REFERER']; echo $referer_page; ?>">
                            </td>
                        </tr>
                        
                        <!--Кнопка "Отправить заявку"-->
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Отправить заявку" name="submit" style="float: right;">
                            </td>
                        </tr>  

                    </table>
                </div>

                <div class="note">* Помечены поля, которые необходимо заполнить</div>

            </form>

            <?php
        }

        function complete_mail($refer_page) {

            if (empty($_POST['code']) OR empty($_SESSION['code'])) {
                echo '<div class="note">Вы не указали код подтверждения</div>';
                $sendemail = 'No';
            } elseif ($_POST['code'] != $_SESSION['code']) {
                echo '<div class="note">Код подтверждения не совпадает</div>';
                $sendemail = 'No';
            }

            $empty_input[] = 'Имя, Фамилия';
            $empty_input[] = '@ EMail';
            $empty_input[] = 'Текст сообщения';

// Проверка правильности заполнения поля @ EMail
            if ((strpos($_POST['input_name'][1], "@") == false) OR (strpos($_POST['input_name'][1], ".") == false) OR strpos($_POST['input_name'][1], " ") > 0) {
                $sendemail = 'No';
                echo '<div class="note">Необходимо правильно заполнить поле @ EMail!</div>';
            }
// Проверка заполнения обязательных полей
            for ($i = 0; $i < count($_POST['input_name']); $i++) {
                $_POST['input_name'][$i] = substr(htmlspecialchars(trim($_POST['input_name'][$i])), 0, 100000);
                if (substr(htmlspecialchars(trim($_POST['check'][$i])), 0, 1) == 1) {
                    if (empty($_POST['input_name'][$i])) {
                        $sendemail = 'No';
                        echo '<div class="note">Необходимо заполнить поле ' . $empty_input[$i] . '!</div>';
                    }
                }
            }
            if ($sendemail == 'No')
                show_form();
            $mess = '';
            $mess .= '<b>Имя, Фамилия: </b>' . $_POST['input_name'][0] . '<br />';
            $mess .= '<b>@ EMail: </b>' . $_POST['input_name'][1] . '<br /><br /><br />';
            $mess .= '<b>Текст сообщения: </b><br /><br />' . $_POST['input_name'][2] . '<br /><br /><br />';
            $mess .= '<b>Отправлено со страницы: </b>' . $_POST['pagetitle'][1] . '<br />';
// подключаем файл класса для отправки почты
// если Вы забыли его скачать - http://www.php-mail.ru/class.phpmailer.zip
            require 'class.phpmailer.php';

            $mail = new PHPMailer();
            $mail->From = $_POST['input_name'][1];                   // от кого email
            $mail->FromName = $_POST['input_name'][0];               // от кого имя
            $mail->AddAddress('sail.seamanship@gmail.com', 'Yacht Seamanship');     // кому - адрес, Имя
            $mail->IsHTML(true);                                     // выставляем формат письма HTML
            $mail->Subject = 'С сайта Yacht Seamanship отправлено сообщение...';  // тема письма
            $mail->Body = $mess;

            if ($sendemail != 'No') {
// отправляем наше письмо
                if (!$mail->Send())
                    die('Mailer Error: ' . $mail->ErrorInfo);
                ?>
                <div class="ok-message">
                    <?php
                    echo 'Спасибо!<br />Ваше сообщение отправлено.<br />Мы ответим Вам в ближайшее время.';
                    ?>
                </div>
                <?php
            }
        }

        if (!empty($_POST['submit']))
            complete_mail();
        else
            show_form();
            
?>


</body>
</html>