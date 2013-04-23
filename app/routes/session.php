<?php

/*
 * Wyświetlenie strony głównej
 */
$app->get('/', function () use ($app) {

    $categories = Model::factory('Category')->order_by_asc('pos')->find_many();
    $workspace = '/public/img/categories';
    $app->render('productslist.php', array('rel'=>'menu1', 'list'=>$categories, 'link'=>'category', 'workspace'=>$workspace, 'title'=>'Strona główna'));
});


/**
 * Oferta
 */
$app->get('/oferta', function () use ($app) {

    $fotos = Model::factory('Foto')->order_by_asc('pos')->find_many();
    $app->render('offer.php', array('rel'=>'menu2', 'fotos'=>$fotos, 'title'=>'Oferta'));
});

/**
 * O firmie
 */
$app->get('/o-firmie', function () use ($app) {

    $app->render('about.php', array('rel'=>'menu3', 'title'=>'O firmie'));
});

/**
 * Kontakt
 */
$app->get('/kontakt', function () use ($app) {

    $app->render('contact.php', array('rel'=>'menu5', 'title'=>'Kontakt'));
});
/**
 * Katalog
 */
$app->get('/katalog/:vars', function ($vars) use ($app) {
    
    $varsArray = explode(',',$vars);
    $type = $varsArray[0]; //category, subcategory, product
    $id = intval($varsArray[1]); //type id
    
    $imgPath = '/public/img/';
    
    $cat = array();
    $subcat = array();
    $prod = array();  
    $link = '';
    
    switch ($type) {
      case 'category':
          $category = Model::factory('Category')->find_one($id);
          if($category instanceof Category) {          
            $list = $category->subcategories()->order_by_asc('pos')->find_many();  
            $title = $category->name;

            $cat['id'] = $category->cat_id;
            $cat['name'] = $title;
            $cat['clearUrl'] = cleanForShortURL($category->name);

            $link = 'subcategory';

            $render = 'productslist';
            $workspace = $imgPath.'producers';
            
          } else {
              $app->redirect('/');                   
          }
          break;
      
       case 'subcategory':
          $subcategory = Model::factory('Subcategory')->find_one($id);    
          if($subcategory instanceof Subcategory) {
            $list = $subcategory->products()->order_by_asc('pos')->find_many();
            $title = $subcategory->name;

            $category = $subcategory->category()->find_one();

            $cat['id'] = $category->cat_id;
            $cat['name'] = $category->name;
            $cat['clearUrl'] = cleanForShortURL($category->name);

            $subcat['id'] = $subcategory->subcat_id;
            $subcat['name'] = $subcategory->name;
            $subcat['img'] = $subcategory->img;
            $subcat['clearUrl'] = cleanForShortURL($subcategory->name);

            $link = 'product';

            $render = 'productslist';
            $workspace = $imgPath.'products';
            
          } else {
              $app->redirect('/');              
          }
          break;
      
       case 'product':
          $list = Model::factory('Product')->find_one($id);
          if($list instanceof Product) { 
            $title = $list->name;

            $subcategory = $list->subcategory()->find_one();
            $category = $subcategory->category()->find_one();

            $cat['id'] = $category->cat_id;
            $cat['name'] = $category->name;
            $cat['clearUrl'] = cleanForShortURL($category->name);          

            $subcat['id'] = $subcategory->subcat_id;
            $subcat['name'] = $subcategory->name;
            $subcat['clearUrl'] = cleanForShortURL($subcategory->name);

            $prod['id'] = $list->prod_id;
            $prod['name'] = $list->name;
            $prod['img'] = $list->img;
            $prod['desc'] = $list->desc;
            $prod['clearUrl'] = cleanForShortURL($list->name);

            $render = 'product';
            $workspace = $imgPath.'products';
            
          } else {
            $app->redirect('/');              
          }
          break;
      
       default:
          $render = 'productslist';  
          $list = array();
          $title = '';
          $workspace = '';
    };
    
    
    $app->render($render.'.php',array('list'=>$list, 'title'=>$title, 'category'=>$cat ,'producer'=>$subcat, 'product'=>$prod, 'link'=>$link, 'workspace'=>$workspace));
    
});


$app->get('/kontakt', function () use ($app) {

    $app->render('kontakt.php');
});


/*
 * Logowanie - wyświetlanie formularza
 */
$app->get('/logowanie', function () use ($app) {

    return$app->render('login.php');
});

/*
 * Logowanie - wysłanie formularza
 */
$app->post('/logowanie', function () use ($app) {
    $user = Model::factory('User')->where('login',$app->request()->post('login'))->where('password', md5($app->request()->post('password')))->find_one();
$login=$app->request()->post('login');
$pass=$app->request()->post('password');
var_dump($user);
    if ( $user instanceof User) {
            $_SESSION['user_id'] = $user->idUser;
            $_SESSION['login'] = $user->login;   
            $app->redirect('/home');
		
	}
    else {
        $app->render('login.php', array('info'=>'Login lub hasło niepoprawne'));
    }

});

/*
 * Wyloguj
 */
$app->get('/wyloguj', function () use ($app) {
    
    session_destroy();
    
    $app->redirect('/home');
});










?>
