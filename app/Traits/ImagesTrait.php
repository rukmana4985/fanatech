<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Image;
use Response;

trait ImagesTrait {

	public function display($path, $raw = false) {
		$img = Storage::get($path);

		if ($raw) {
			$filename = basename($path);
			$file_extension = strtolower(substr(strrchr($filename,"."),1));

			switch ($file_extension) {
				case 'gif':
					$type = 'image/gif';
					break;
				case 'png':
					$type = 'image/png';
					break;
				case 'jpeg':
				case 'jpg':
					$type = 'image/jpeg';
					break;
				default:
			}

			$response = Response::make($img, 200);
			$response->header('Content-Type', $type);
			return $response;
		}
		return $img;
	}

	public function getPath() {

	}

	public function saveImage($path, $img) {
		$save_image = Storage::put($path, (string) $img->encode());
	}

	public function getName($img) {
		return $img->getClientOriginalName();
	}

	public function getHashName($img, $path) {
		return $img->hashName($path);
	}

	public function image($img) {
		// Using Image Intervention
		return Image::make($img);
	}

	public function getWidth($img) {
		return $img->width();
	}

	public function getHeight() {
		return $img->height();
	}

	public function resizeImage($img, $w, $h) {
		return $img->resize($w, $h);
	}

	public function compressImage($img, $response, $quality) {
		return $img->encode($response,$quality);
	}

	public function showResponse($img, $type) {
		return $img->response($type);
	}

	public function createThumbnail($img) {
		return $img->fit(200);
	}

	public function insertWatermark($img) {
		return $img->insert('public/bar.jpg');
	}

	public function cropImage($img) {

	}
} 