<?php

namespace App\Helpers;

class CaptchaHelper
{
    public static function generate()
    {
        // Generate random string (huruf & angka acak)
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Hilangkan huruf/angka yang mirip
        $length = 6;
        $captchaText = '';
        
        for ($i = 0; $i < $length; $i++) {
            $captchaText .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Simpan ke session
        session([
            'captcha_code' => $captchaText,
            'captcha_time' => time()
        ]);
        
        return $captchaText;
    }
    
    public static function createImage()
    {
        $code = self::generate();
        
        // Ukuran gambar
        $width = 200;
        $height = 70;
        
        // Buat image
        $image = imagecreatetruecolor($width, $height);
        
        // Warna background (gradient)
        $bgColor1 = imagecolorallocate($image, 240, 240, 255);
        $bgColor2 = imagecolorallocate($image, 220, 230, 255);
        
        // Fill gradient background
        for ($i = 0; $i < $height; $i++) {
            $r = 240 - ($i * 20 / $height);
            $g = 240 - ($i * 10 / $height);
            $b = 255;
            $color = imagecolorallocate($image, $r, $g, $b);
            imageline($image, 0, $i, $width, $i, $color);
        }
        
        // Tambah noise (titik-titik acak)
        for ($i = 0; $i < 200; $i++) {
            $noiseColor = imagecolorallocate($image, rand(150, 220), rand(150, 220), rand(150, 220));
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
        }
        
        // Tambah garis-garis acak (untuk distorsi)
        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
            imageline(
                $image,
                rand(0, $width / 2),
                rand(0, $height),
                rand($width / 2, $width),
                rand(0, $height),
                $lineColor
            );
        }
        
        // Tulis text dengan distorsi
        $textColors = [
            imagecolorallocate($image, 60, 80, 200),
            imagecolorallocate($image, 200, 60, 80),
            imagecolorallocate($image, 80, 160, 60),
            imagecolorallocate($image, 160, 80, 160)
        ];
        
        $letterSpacing = $width / (strlen($code) + 1);
        
        for ($i = 0; $i < strlen($code); $i++) {
            $fontSize = rand(20, 26);
            $angle = rand(-15, 15);
            $x = $letterSpacing * ($i + 1) + rand(-5, 5);
            $y = ($height / 2) + rand(-5, 10);
            $color = $textColors[array_rand($textColors)];
            
            // Gunakan font bawaan PHP atau font TrueType jika ada
            imagettftext($image, $fontSize, $angle, $x, $y, $color, self::getFontPath(), $code[$i]);
        }
        
        // Output sebagai PNG
        ob_start();
        imagepng($image, null, 9);
        $imageData = ob_get_clean();
        imagedestroy($image);
        
        return $imageData;
    }
    
    private static function getFontPath()
    {
        // Coba beberapa lokasi font yang umum di Windows/Linux
        $possibleFonts = [
            'C:\Windows\Fonts\arial.ttf', // Windows
            'C:\Windows\Fonts\verdana.ttf',
            '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf', // Linux
            '/System/Library/Fonts/Helvetica.ttc', // Mac
            public_path('fonts/arial.ttf'), // Custom
        ];
        
        foreach ($possibleFonts as $font) {
            if (file_exists($font)) {
                return $font;
            }
        }
        
        // Fallback ke font bawaan GD (kurang bagus tapi tetap jalan)
        return 5;
    }
    
    public static function validate($userInput)
    {
        $correctCode = session('captcha_code');
        $captchaTime = session('captcha_time');
        
        // Captcha expired setelah 5 menit
        if (!$captchaTime || (time() - $captchaTime) > 300) {
            return false;
        }
        
        // Case insensitive comparison
        return strtoupper($userInput) === strtoupper($correctCode);
    }
    
    public static function clear()
    {
        session()->forget(['captcha_code', 'captcha_time']);
    }
}
