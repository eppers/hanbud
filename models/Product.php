<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class Product extends Model{
        
    public static $_table = 'products';
    public static $_id_column = 'prod_id';
    
   
    public function subcategory() {
        return $this->belongs_to('Subcategory', 'subcat_id'); // Note we use the model name literally - not a pluralised version
    }
}
?>
