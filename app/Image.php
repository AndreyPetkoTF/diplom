<?php 

namespace App;

class Image {

	public $image = [];
	public $name = '';

	public function __construct($image) {
		$this->image = $image;
	}


	public function toImageFolder($folder) {
		$this->image->move($folder, $this->image->getClientOriginalName());
		$this->name = $this->image->getClientOriginalName();
	}


	public static function deleteImage($oldImage, $folder) {
		$filename = './' . $folder . '/' . $oldImage;

		if(file_exists($filename)) {
			unlink($filename);
		}
	}


	public function hasFile() {
		return !empty($this->image) && $this->image->isValid();
	}

	public function getName() {
		return $this->name;
	}

}