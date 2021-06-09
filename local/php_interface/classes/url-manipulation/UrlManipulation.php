<?php
/**
 * PHP class for manipulation and extending urls
 */
class UrlManipulation
{
	public static function setParam($param, $value)
	{
		$query = $_GET;
		$query[$param] = $value;
		$query_result = http_build_query($query);

		return $query_result;
	}

	public static function setParams($params)
	{
		$query = $_GET;

		if (is_array($params) && !empty($params))
		{
			foreach($params as $param => $value){
				$query[$param] = $value;
			}
		}
		
		$query_result = http_build_query($query);

		return $query_result;
	}

	public static function getParam($param)
	{
		$query = $_GET;

		return $query[$param];
	}
}
?>