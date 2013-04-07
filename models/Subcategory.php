<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class Subcategory extends Model{
        
    public static $_table = 'subcategories';
    public static $_id_column = 'subcat_id';
    
    
    public function category() {
        return $this->belongs_to('Category', 'cat_id');
    }
    
    public function products() {
        return $this->has_many('Product', 'subcat_id'); // Note we use the model name literally - not a pluralised version
    }
   

}
?>
