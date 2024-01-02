<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Response;

trait FilesTrait {

	public function display($path, $raw = false) {
		$file = Storage::get($path);

		if ($raw) {
			$filename = basename($path);
			$file_extension = strtolower(substr(strrchr($filename,"."),1));

			switch ($file_extension) {
				case 'docx':
				case 'doc':
					$type = 'application/msword';
				case 'xlsx':
				case 'xls':
					$type = 'application/excel';
				case 'pdf':
					$type = 'application/pdf';
				default:
			}

			$response = Response::make($img, 200);
			$response->header('Content-Type', $type);
			return $response;
		}

		return $file;
	}

	public function getPath() {

	}

	public function saveFile() {

	}
}