<?php
class enc{
    private static $METHOD="AES-256-CBC";
	private static $SECRET_KEY="mmmmmaaaaaxiiiiiiimoooplixxx";
	private static $SECRET_IV="101712";
    public static function mytext($string){
        $output=FALSE;
        $key=hash('sha256', self::$SECRET_KEY);
        $iv=substr(hash('sha256', self::$SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, self::$METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
}
?>