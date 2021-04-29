<?php

namespace App\Http\Controllers;

use RouterOS\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function index()
   {
       $client = new Client([
           'host'     => '192.168.10.1',
           'user'     => 'Kervis',
           'pass'     => 'Dynamics123',
           
       ]);
       /* ether1_FO_Cantv */
       // Execute export command via ssh, because API /export method has a bug
       $respuesta = $client->query('/interface/getall')->read();        
       
       $data = $this->convert_from_latin1_to_utf8_recursively($respuesta);
       
      
       return ($data);
   }

    public  function convert_from_latin1_to_utf8_recursively($dat)
    {
       if (is_string($dat)) {
          return utf8_encode($dat);
       } elseif (is_array($dat)) {
          $ret = [];
          foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);
 
          return $ret;
       } elseif (is_object($dat)) {
          foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);
 
          return $dat;
       } else {
          return $dat;
       }
    }
}
