<?php
    // Get image 
    $img = imagecreatefromjpeg('img/jew-b.jpg');
    
    // Write text  
    $white = imagecolorallocatealpha($img, 255, 255, 255, 40);
    $black = imagecolorallocate($img, 0, 0, 0);
    $txt = 
"Пример исполнения
Лимонное золото 585 пробы
Вес: 20гр
Длина: 5 см
Кольцо: вообще крутое";

    $txt = mb_convert_encoding($txt, "HTML-ENTITIES", "UTF-8");
    $txt = preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $txt);
    $font = "C:\Windows\Fonts\arial.ttf"; 
     
    
    // Image size
    $width = imagesx($img);
    $height = imagesy($img); 

    // Text size 
    $text_size = imagettfbbox(24, 0, $font, $txt);
    $text_width = max([$text_size[2], $text_size[2]]) - min([$text_size[0], $text_size[6]]);
    $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

    $coordX = $width - $text_width - 10;

    // Background for text 
    imagefilledrectangle($img, $coordX-20, $text_height, $coordX+$text_width+10, -$text_height+50, $white);

    // Parametrs for text on image 
    imagettftext(
        $img, //Image 
        24,  // Font size 
        0,  // Angle  
        $coordX, 30 , // X Y Coordinates
        $black, // Color
        $font, //  Font to use
        $txt  // Text to write 
    ); 

    // Output image in browser 
    header('Content-type: image/jpeg');
    imagejpeg($img);
    imagedestroy($img);
    
    // OR SAVE TO A FILE 
    // THE LAST PARAMETER IS THE QUALITY FROM 0 to 100
    // imagejpeg($img, "test.jpg", 100);
?>