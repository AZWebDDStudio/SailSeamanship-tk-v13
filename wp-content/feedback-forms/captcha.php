<?
                session_start ();
                $im = @imagecreate (50, 20) or die ("Cannot initialize new GD image stream!");
                //$bg = imagecolorallocate ($im, 255, 255, 255);
                $bg = imagecolorallocatealpha ($im, 0, 0, 0, 127);
                $char = $_SESSION['code'];

                $white = imagecolorallocate ($im, 0, 0, 0);
                imagettftext ($im, 15, 0, 1, 17, $white, "font.ttf", $char );

               //антикеширование
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");

                //создание рисунка в зависимости от доступного формата
                if (function_exists("imagepng")) {
                   header("Content-type: image/png");
                   imagepng($im);
                } elseif (function_exists("imagegif")) {
                   header("Content-type: image/gif");
                   imagegif($im);
                } elseif (function_exists("imagejpeg")) {
                   header("Content-type: image/jpeg");
                   imagejpeg($im);
                } else {
                   die("No image support in this PHP server!");
                }
                imagedestroy ($im);
?>