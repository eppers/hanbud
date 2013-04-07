<?php

class Menu {
    
    protected $menuPath = "./template/menu.tpl.php";

    public function generate(array $categories) {

        $file = fopen($this->menuPath, "wb");

        $text = '<h2>Kategorie produktów</h2>

                <ul class="offer-menu" id="nested-menu">';
                foreach ($categories as $cat) {
                    
                $text .= '<li class="level-1 active">
                            <strong>'.$cat["name"].'</strong>
                            <ul>';

                            foreach ($cat["subcats"] as $subcat) {
                                    $text .= "<li><a href='/hanbud/katalog/subcategory,".$subcat->subcat_id.",".cleanForShortURL($subcat->name)."'>".$subcat->name."</a></li>\r";
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
