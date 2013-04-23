<?php

class Menu {
    
    protected static $_menuPath = "./template/menu.tpl.php";

    public static function generate() {
    
        $categories = Model::factory('Category')->order_by_asc('pos')->find_many();
        
        foreach($categories as $cat) {
            if($cat instanceof Category) {

                $catArray['name'] = $cat->name;
                $catArray['id'] = $cat->cat_id;
                $catArray['subcats'] = $cat->subcategories()->order_by_asc('pos')->find_many();

                $catArrays[] = $catArray;
            }
        }
        
        self::generateFile($catArrays);
    }
    
    protected static function generateFile(array $categories) {

        $file = fopen(self::$_menuPath, "wb");

        $text = '<h2>Kategorie produktów</h2>

                <ul class="offer-menu" id="nested-menu">';
                foreach ($categories as $cat) {
                    
                $text .= '<li class="level-1 active" rel="'.$cat['id'].'">
                            <a href="/katalog/category,'.$cat['id'].','.cleanForShortURL($cat['name']).'"><strong>'.$cat["name"].'</strong></a>
                            <ul>';

                            foreach ($cat["subcats"] as $subcat) {
                                    $text .= "<li><a href='/katalog/subcategory,".$subcat->subcat_id.",".cleanForShortURL($subcat->name)."'>".$subcat->name."</a></li>\r";
                            };
                 $text .= '</ul>
                        </li>';
                 
                }
                       
                       
                $text .= '</ul>';
                
        fwrite($file, $text);
        fclose($file);
    }
}

?>
