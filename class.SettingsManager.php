<?php

class SettingsManager
{
	private static $data_file_name = 'kma_data.txt';
    public function __construct() {}
	
	public static function settings($val=false)
    {
        if($val)
			self::_save_to_file( $val );
        else
            return self::_extract_from_file();
    }
	
	public static function add_param($name, $value)
	{
		$data = self::_extract_from_file();
		$data[$name]=$value;
		self::_save_to_file( $data );
	}
	
	public static function update_param($name, $value){
		self::add_param( $name, $value);
	}
	
	public static function remove_param( $name )
	{
		$data = self::_extract_from_file();
		if( ! is_array( $data ) ) return false;
		if( in_array( $name, array_keys( $data ) ) ){
			unset( $data[$name] );
			self::_save_to_file( $data );
		}
	}
	
	public static function get_param( $name )
	{
		$data = self::_extract_from_file();
		if( isset( $data[$name] ) )
			return $data[$name];
		else
			return false;
	}
	
	private static function _save_to_file( $data )
	{	
		$encoded_data = json_encode( $data );
		@file_put_contents( self::$data_file_name, $encoded_data );
	}
	
	private static function _extract_from_file()
	{
		$content = @file_get_contents( self::$data_file_name );
		if( empty( $content ) ) return false;
		else
			return json_decode( $content, true);
	}
}
