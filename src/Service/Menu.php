<?php
namespace App\Service;

class Menu {
    public function getItems() {
	return array(
            array('path' => 'default_home', 'label' => 'HOME'),
            // array('path' => 'makler_list', 'label' => 'MAKLER-LISTE'),
            // array('path' => 'stock_shareholders', 'label' => 'AKTIONÄR-LISTE'),
            // array('path' => 'bcuser_list', 'label' => 'BCUSER-LISTE'), 
            // array('path' => 'campus_termin_list', 'label' => 'CAMPUS')
        );
    }
}