<?php
/**
 * PHP class to replace standard Bitrix Image functions
 * Uses PHP-library Gumlet: https://github.com/gumlet/php-image-resize
 */
class ImageBx
{
	const IMAGE_BX_CONTAIN = 'resizeToBestFit';
	const IMAGE_BX_COVER = 'crop';
	const IMAGE_BX_EXACT = 'resize';

	const IMAGE_BX_CENTER = ImageResize::CROPCENTER;
	const IMAGE_BX_TOP = ImageResize::CROPTOP;
	const IMAGE_BX_BOTTOM = ImageResize::CROPBOTTOM;

	private static $arResizeTypeToNum = array(
		'resizeToBestFit' => 0,
		'crop' => 1,
		'resize' => 2,
	);

	private static $workingTime = 0;

  /**
   * Replacement for CFile::ResizeImageGet
   *
   * @param mixed $file
	 * @param array $arSize, 
	 * @param const $resizeType = self::IMAGE_BX_COVER, 
	 * @param const $resizePosition = self::IMAGE_BX_CENTER, 
	 * @param array $arFilters = false, 
	 * @param bool $bImmediate = false, 
	 * @param mixed $quality = false
   * @return array
   */
	public static function ResizeImageGet($file, $arSize, $resizeType = self::IMAGE_BX_COVER, $resizePosition = self::IMAGE_BX_CENTER, $arFilters = false, $bImmediate = false, $quality = false)
	{

        $crop = false;
	    if ($resizeType == self::IMAGE_BX_COVER)
			$crop = true;
        return ['src'=>smart_resize_ameton($file,$arSize["width"],$arSize["height"],JPEG_QUALITY,$crop,false,true)];

		if (self::$workingTime == 0)
		{
			self::$workingTime = time();
		}
		elseif ((time() - self::$workingTime) > 10)
		{
			header('Location: '.$_SERVER['REQUEST_URI']);
			die();
		}

		if (!is_array($file) && intval($file) > 0)
		{
			$file = CFile::GetFileArray($file);
		}

		if (!is_array($file) || !array_key_exists("FILE_NAME", $file) || !$file["FILE_NAME"])
			return false;

		if ($resizeType !== self::IMAGE_BX_CONTAIN && $resizeType !== self::IMAGE_BX_EXACT)
			$resizeType = self::IMAGE_BX_COVER;

    if (!is_array($arSize))
        $arSize = array();
    if (!array_key_exists("width", $arSize) || intval($arSize["width"]) <= 0)
        $arSize["width"] = 0;
    if (!array_key_exists("height", $arSize) || intval($arSize["height"]) <= 0)
        $arSize["height"] = 0;
    $arSize["width"] = intval($arSize["width"]);
    $arSize["height"] = intval($arSize["height"]);

    $uploadDirName = COption::GetOptionString("main", "upload_dir", "upload");

    $imageFile = "/".$uploadDirName."/".$file["SUBDIR"]."/".$file["FILE_NAME"];
    $arImageSize = false;
    $bFilters = is_array($arFilters) && !empty($arFilters);

    if ($arSize["width"] <= 0 && $arSize["height"] <= 0)
    {
			if ($bFilters)
			{
			  // Only filters. Leave size unchanged
			  $arSize["width"] = $file["WIDTH"];
			  $arSize["height"] = $file["HEIGHT"];
			  $resizeType = self::IMAGE_BX_COVER;
			}
			else
			{
			  global $arCloudImageSizeCache;
			  $arCloudImageSizeCache[$file["SRC"]] = array($file["WIDTH"], $file["HEIGHT"]);

			  return array(
			      "src" => $file["SRC"],
			      "width" => intval($file["WIDTH"]),
			      "height" => intval($file["HEIGHT"]),
			      "size" => $file["FILE_SIZE"],
			  );
			}
    }

    $io = CBXVirtualIo::GetInstance();
    $cacheImageFile = "/" . $uploadDirName . "/resize_cache/" . $file["SUBDIR"] . "/" . $arSize["width"] . "_" . $arSize["height"] . "_" . self::$arResizeTypeToNum[$resizeType] . (is_array($arFilters) ? md5(serialize($arFilters)) : "") . "/" . $file["FILE_NAME"];

    $cacheImageFileCheck = $cacheImageFile;
    if ($file["CONTENT_TYPE"] == "image/bmp")
    	$cacheImageFileCheck .= ".jpg";

    static $cache = array();
    $cache_id = $cacheImageFileCheck;
    if (isset($cache[$cache_id]))
    {
    	return $cache[$cache_id];
    }
    elseif (!file_exists($io->GetPhysicalName($_SERVER["DOCUMENT_ROOT"] . $cacheImageFileCheck)))
    {
			/****************************** QUOTA ******************************/
			$bDiskQuota = true;
			if (COption::GetOptionInt("main", "disk_space") > 0)
			{
				$quota = new CDiskQuota();
				$bDiskQuota = $quota->checkDiskQuota($file);
			}
			/****************************** QUOTA ******************************/

			if ($bDiskQuota)
			{
				if (!is_array($arFilters))
					$arFilters = array(
						array(IMG_FILTER_SCATTER, 3, 5),
					);

			  $sourceImageFile = $_SERVER["DOCUMENT_ROOT"] . $imageFile;
			  $cacheImageFileTmp = $_SERVER["DOCUMENT_ROOT"] . $cacheImageFile;
			  $bNeedResize = true;
			  $callbackData = null;

			  foreach (GetModuleEvents("main", "OnBeforeResizeImage", true) as $arEvent)
			  {
					if (ExecuteModuleEventEx($arEvent, array(
						$file,
						array($arSize, $resizeType, array(), false, $arFilters, $bImmediate),
						&$callbackData,
						&$bNeedResize,
						&$sourceImageFile,
						&$cacheImageFileTmp,
					)))
						break;
			  }

			  $quality_jpg = 70;
			  $quality_png = 6;
			  $quality_webp = 70;

			  if (!is_array($quality))
			  {
			  	if ($quality !== false)
			  	{
				  	$quality = intval($quality);

				  	if ($quality <= 9)
				  	{
				  		$quality_png = $quality;
				  	}
				  	else
				  	{
				  		$quality_jpg = $quality_webp = $quality;
				  	}
			  	}
			  }
			  else
			  {
			  	if (isset($quality[0]))
			  	{
			  		$quality_jpg = intval($quality[0]);
			  	}

			  	if (isset($quality[1]))
			  	{
			  		$quality_png = intval($quality[1]);
			  	}

			  	if (isset($quality[2]))
			  	{
			  		$quality_webp = intval($quality[2]);
			  	}
			  }

			  if ($bNeedResize)
			  {
				  $image = new ImageResize($sourceImageFile);
				  $image->quality_jpg = $quality_jpg;
				  $image->quality_png = $quality_png;
				  $image->quality_webp = $quality_webp;

				  if ($arSize["width"] && $arSize["height"])
				  {
					  if ($resizeType == "crop")
					  {
					  	$image->{$resizeType}($arSize["width"], $arSize["height"], true);
					  }
					  else
					  {
					  	$image->crop($arSize["width"], $arSize["height"], true, $resizePosition);
					  }
				  }
				  elseif ($arSize["width"] && !$arSize["height"])
				  {
				  	$image->resizeToWidth($arSize["width"], true);
				  }
				  elseif (!$arSize["width"] && $arSize["height"])
				  {
				  	$image->resizeToHeight($arSize["height"], true);
				  }

				  foreach ($arFilters as $filter)
				  {
						$image->addFilter(function($imageDesc) use ($filter) {
							if (count($filter) == 1) imagefilter($imageDesc, $filter[0]);
							if (count($filter) == 2) imagefilter($imageDesc, $filter[0], $filter[1]);
							if (count($filter) == 3) imagefilter($imageDesc, $filter[0], $filter[1], $filter[2]);
							if (count($filter) == 4) imagefilter($imageDesc, $filter[0], $filter[1], $filter[2], $filter[3]);
						});
				  }

				  if ($io->FileExists($cacheImageFileTmp))
				  {
				  	$io->Delete($cacheImageFileTmp);
				  }

				  mkdir(dirname($cacheImageFileTmp), 0755, true);
				  $image->save($cacheImageFileTmp);
			  }

			  if ($bNeedResize && file_exists($io->GetPhysicalName($cacheImageFileTmp)))
			  {
					$cacheImageFile = mb_substr($cacheImageFileTmp, mb_strlen($_SERVER["DOCUMENT_ROOT"],'UTF-8'),null,'UTF-8');

					/****************************** QUOTA ******************************/
					if (COption::GetOptionInt("main", "disk_space") > 0)
						CDiskQuota::updateDiskQuota("file", filesize($io->GetPhysicalName($cacheImageFileTmp)), "insert");
					/****************************** QUOTA ******************************/
			  }
			  else
			  {
					$cacheImageFile = $imageFile;
			  }

			  foreach (GetModuleEvents("main", "OnAfterResizeImage", true) as $arEvent)
			  {
					if (ExecuteModuleEventEx($arEvent, array(
						$file,
						array($arSize, $resizeType, array(), false, $arFilters),
						&$callbackData,
						&$cacheImageFile,
						&$cacheImageFileTmp,
						&$arImageSize,
					)))
						break;
			  }
			}
			else
			{
			  $cacheImageFile = $imageFile;
			}

			$cacheImageFileCheck = $cacheImageFile;
    }

		if (!is_array($arImageSize))
		{
			$arImageSize = CFile::GetImageSize($_SERVER["DOCUMENT_ROOT"] . $cacheImageFileCheck);

			$f = $io->GetFile($_SERVER["DOCUMENT_ROOT"] . $cacheImageFileCheck);
			$arImageSize[2] = $f->GetFileSize();
		}

		$cache[$cache_id] = array(
			"src" => $cacheImageFileCheck,
			"width" => intval($arImageSize[0]),
			"height" => intval($arImageSize[1]),
			"size" => $arImageSize[2],
		);

		return $cache[$cache_id];
	}
}
?>