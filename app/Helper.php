<?php 

namespace App;

class Helper {

	public static function toBool($item) {
		if($item) {
			$item = 1;
		} else {
			$item = 0;
		}

		return $item;

	}

	public static function getExtension($filename) {
		return end(explode(".", $filename));
	}


	// echo generate_password(intval($_POST['number']));

	public static function generatePassword($number)
	{
		$arr = array('a','b','c','d','e','f',
			'g','h','i','j','k','l',
			'm','n','o','p','r','s',
			't','u','v','x','y','z',
			'A','B','C','D','E','F',
			'G','H','I','J','K','L',
			'M','N','O','P','R','S',
			'T','U','V','X','Y','Z',
			'1','2','3','4','5','6',
			'7','8','9','0');
    // Генерируем пароль
		$pass = "";
		for($i = 0; $i < $number; $i++)
		{
      // Вычисляем случайный индекс массива
			$index = rand(0, count($arr) - 1);
			$pass .= $arr[$index];
		}
		return $pass;
	}

}