<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Habilitar
|--------------------------------------------------------------------------
|
| habilitar el control de acceso por fuerza bruta
|
*/
$config['habilitar'] = TRUE;


/*
|--------------------------------------------------------------------------
| Cantidad de Fallos
|--------------------------------------------------------------------------
|
| cantidad de fallos limite antes de pasar
| a estar bloqueada la direccion IP
|
*/
$config['cantidad_fallos'] = '10';


/*
|--------------------------------------------------------------------------
| Cantidad de Fallos
|--------------------------------------------------------------------------
|
| segundos transcurridos necesarios para anular los
| datos almacenados en base de datos acerca de la direccion IP
| 3600 => 1hs,  43200 => 12hs, 86400 => 24hs, 604800 => 7 dias
|
*/
$config['segundos_desbloquear'] = ENVIRONMENT == 'development' ? 3600 : 86400;


/* End of file config.php */
/* Location: ./application/modules/backend/config/bruteforce_ip.php */
