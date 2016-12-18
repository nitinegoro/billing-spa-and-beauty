<?php 
/**
 *
 * @package Administrator Module
 * @source CI - AdminLTE
 * @edited Vicky Nititnegoro 
 **/


/**
 * Active Menu
 *
 * @param String Method
 * @param String Controller
 * @return string
 **/
if(!function_exists('active_link_controller'))
{
	function active_link_controller($controller)
	{
        $ci    =& get_instance();
        $class = $ci->router->fetch_class();

        return ($class == $controller) ? 'active open ' : NULL;
	}
} 

/**
 * Active Sub menu
 *
 * @param String Method
 * @param String Controller
 * @return string
 **/
if(!function_exists('active_link_method'))
{
	function active_link_method($method, $class_controller = FALSE)
	{
        $ci    =& get_instance();
        $method_in_class = $ci->router->fetch_method();
        $class  = $ci->router->fetch_class();

        if($class_controller !== FALSE)
        	return ($method_in_class == $method && $class == $class_controller) ? 'active' : NULL;
        
        return ($method_in_class == $method) ? 'active' : NULL;
	}
} 


/**
 * Random RGBA Color
 *
 * @param Integer
 * @return String
 **/
if(! function_exists('random_color') )
{
    function random_color($number = 0)
    {
        $str = '#';
        for ($i = 0; $i < 6; $i++) {
            $randNum = rand(0, 15);
            switch ($randNum) {
                case 10: $randNum = 'A';
                    break;
                case 11: $randNum = 'B';
                    break;
                case 12: $randNum = 'C';
                    break;
                case 13: $randNum = 'D';
                    break;
                case 14: $randNum = 'E';
                    break;
                case 15: $randNum = 'F';
                    break;
            }
            $str .= $randNum;
        }
        return $str;
    }
}

/**
 * Set Duration From time to date
 *
 * @param Time
 * @return string (Date)
 **/
if( ! function_exists('set_duration')) 
{
    function set_duration($time = '01:00:00')
    {
        // rubah duration ke detik
        $detik = seconds_from_time($time) + 10; 
        // Panggil dat php
        $dt = DateTime::createFromFormat('d/m/Y h:i A', date('d/m/Y h:i A')); 
        // tambahkan detik ke waktu sekarang
        $dt->add(new DateInterval("PT{$detik}S"));             
        return $dt->format('m/d/Y h:i A');                 
    }
}

/**
 * Time Unix To Seconds
 *
 * @param Integer (Time Unix)
 * @return Integer
 **/
if( ! function_exists('seconds_from_time')) 
{
    function seconds_from_time($time) 
    { 
        list($h, $m, $s) = explode(':', $time); 
        return ($h * 3600) + ($m * 60) + $s; 
    } 
}

/**
 * Seconds to Time Unix
 *
 * @param Integer (Time Unix)
 * @return Integer
 **/
if( ! function_exists('time_from_seconds')) 
{
    function time_from_seconds($seconds) 
    { 
        $h = floor($seconds / 3600); 
        $m = floor(($seconds % 3600) / 60); 
        $s = $seconds - ($h * 3600) - ($m * 60); 
        return sprintf('%02d:%02d:%02d', $h, $m, $s); 
    } 
}

/**
 * Added Zero on invoice number
 *
 * @param Integer
 * @return string
 **/
if ( ! function_exists('invoice_number')) {
    function invoice_number($no_pesan)
    {
        $no = strlen($no_pesan);
        switch ($no) {
            case 1:
                $pesan = '00000'.$no_pesan;
                break;
            case 2:
                $pesan = '0000'.$no_pesan;
                break;
            case 3:
                $pesan = '000'.$no_pesan;
                break;
            case 4:
                $pesan = '00'.$no_pesan;
                break;
            case 5:
                $pesan = '0'.$no_pesan;
                break;
            default:
                $pesan = $no_pesan;
                break;
        }
        return $pesan;
    }
}