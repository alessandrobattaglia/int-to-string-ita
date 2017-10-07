<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Battaglia
 * Date: 30/09/2017
 * Time: 12:42
 */

define('INT_TO_STRING_ITA_SPACE', ' - ');

class IntToStringIta
{
    public static function test($number) {
        $class = new IntToStringIta();
        echo $number . ': ' . $class->convert($number);
    }

    public function convert($number) {
        if($number<0)
            return 'meno ' . $this->convert(-$number);

        $beforeTwenty = array(
            'zero',
            'uno',
            'due',
            'tre',
            'quattro',
            'cinque',
            'sei',
            'sette',
            'otto',
            'nove',
            'dieci',
            'undici',
            'dodici',
            'tredici',
            'quattordici',
            'quindici',
            'sedici',
            'diciassette',
            'diciotto',
            'diciannove',
            'venti'
        );
        $dozens = array(
            10 => 'dieci',
            20 => 'venti',
            30 => 'trenta',
            40 => 'quaranta',
            50 => 'cinquanta',
            60 => 'sessanta',
            70 => 'settanta',
            80 => 'ottanta',
            90 => 'novanta'
        );

        if($number<=20)
        {
            return $beforeTwenty[$number];
        }
        else if($number<100)
        {
            $unit = $number%10;
            return ''
            . $dozens[floor($number/10)*10]
            . ($unit!=0 ? INT_TO_STRING_ITA_SPACE . $this->convert($unit) : '');
        }
        else if($number<1000)
        {
            $hundreds = floor($number/100);
            $hundredsRest = $number%100;
            return ''
            . ($hundreds!=1 ? $this->convert($hundreds) . INT_TO_STRING_ITA_SPACE : '')
                . 'cento'
            . ($hundredsRest!=0 ? INT_TO_STRING_ITA_SPACE . $this->convert($hundredsRest) : '');
        }
        else if($number < 1000000) {
                $thousands = floor($number/1000);
                $thousandsRest = $number%1000;
                return ''
                . ($thousands==1 ? 'mille' : $this->convert($thousands) . INT_TO_STRING_ITA_SPACE . 'mila')
                . ($thousandsRest!=0 ? INT_TO_STRING_ITA_SPACE . $this->convert($thousandsRest) : '');
        }
        else {
            return 'Too hight number, I can say ' . $number%1000000 . ': ' . $this->convert($number%1000000);
        }
    }
}