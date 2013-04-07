<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class Category extends Model{
        
    public static $_table = 'categories';
    public static $_id_column = 'cat_id';
    
    public function subcategories() {
        return $this->has_many('Subcategory', 'cat_id'); // Note we use the model name literally - not a pluralised version
    }
   
}
?>
