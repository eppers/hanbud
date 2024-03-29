<?php
 
/*
 * TODO: obrazek dodać w przypadku braku loga producenta (subkategorie)
 * Zarzadzanie zdjeciami w ofercie ( na podstawie ogrodow )
 * Strona glowna wyswietla kategorie, poprawione wyswietlanie produktow w liscie
 * Zarzadanie obrazkami kategorii w PA  
 * 
 */

$app->get('/admin/', function () use ($app) {
    $app->redirect('/admin/catalog/category/all');
});


/*
 * Categories ......................................................................
 */

$app->get('/admin/catalog/category/all', function () use ($admin) {
    $categories=Model::factory('Category')->order_by_asc('pos')->find_many();
    $admin->render('/category/list.php',array('categories'=>$categories));
    
    $_SESSION['msg'] = '';
});

/**
 * Add category
 */

$app->get('/admin/catalog/category/add', function () use ($admin) {
 
    $admin->render('/category/edit.php',array('form'=>'add'));

    
});

$app->post('/admin/catalog/category/add', function () use ($admin) {

    $category = Model::factory('Category')->create();
    $category->name   = $admin->app->request()->post('name');
    $category->pos  = $admin->app->request()->post('pos');
    
         if (isset($_FILES['file'])) {

            $error = Image::setImage($_FILES, $category::$_workspace, true, array('width'=>250, 'height'=>112));

            if($error['status']==1) {

                    $admin->render('/category/edit.php', array('category'=>$category, 'form'=>'add', 'error'=>$error));
                exit();
            } else {

            $category->img  = $error['uploaded_file'];
            $category->save();
            $_SESSION['status']='0';
            $_SESSION['msg']='Kategoria została dodana pomyślnie';

            Menu::generate();
            
            $admin->app->redirect('/admin/catalog/category/all');
            }

        } else {

        $error['status']='1';
        $error['msg']='Kategoria nie została utworzona';
        
        $admin->render('/category/edit.php', array('category'=>$category, 'form'=>'add', 'error'=>$error));
        }
    
    
});


/*
 * Edit category
 */
$app->get('/admin/catalog/category/edit/:id', function ($id) use ($admin) {
 
    $category=Model::factory('Category')->find_one($id);
    
    if($category instanceof Category) {

        $admin->render('/category/edit.php',array('category'=>$category, 'form'=>'edit'));
    }
    else $admin->redirect('/admin/catalog/category/all');
});

$app->post('/admin/catalog/category/edit/:id', function ($id) use ($admin) {

    $category=Model::factory('Category')->find_one($id);
    
    if($category instanceof Category) {

        $category->name   = $admin->app->request()->post('name');
        $category->pos  = $admin->app->request()->post('pos');
    
        if (isset($_FILES['file'])) {

            $error = Image::setImage($_FILES, $category::$_workspace, true, array('width'=>250, 'height'=>112));

            if($error['status']==1) {

                    $admin->render('/category/edit.php', array('category'=>$category, 'form'=>'edit', 'error'=>$error));
                exit();
            } else {

            $category->img  = $error['uploaded_file'];

            }

        } else {
        
        $category->img  = $admin->app->request()->post('img');

        }
        
        $category->save();
        $_SESSION['status']='0';
        $_SESSION['msg']='Kategoria została dodana pomyślnie';

        Menu::generate();
            
        $admin->app->redirect('/admin/catalog/category/all');
        
    } else {
        
        $error['status']='1';
        $error['msg']='Kategoria nie została wyedytowana';
        
    }

    $admin->render('/category/edit.php', array('category'=>$category, 'form'=>'edit', 'error'=>$error));
    
});

/*
 * Category delete
 */
$app->get('/admin/catalog/category/delete/:id', function ($id) use ($admin) {

    $category=Model::factory('Category')->find_one($id);
    
    if($category instanceof Category) {
        
        $remove = Image::remove($category->img, $category::$_workspace, true);
        if($remove) {
            $category->delete();

            $_SESSION['status']='0';
            $_SESSION['msg']='Kategoria została skasowana poprawnie';
          
            Menu::generate();
            
        } else {
        
            $_SESSION['status']='1';
            $_SESSION['msg']=$remove;
        
        }

    } else {
        
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->app->redirect('/admin/catalog/category/all');

});


/*
 * ----------------------------------- PRODUCER (SUBCATEGORY) ----------------------------------
 * Producer - view list
 */
$app->get('/admin/catalog/producer/all', function () use ($admin) {
    
    $subcategories=Model::factory('Subcategory')->order_by_asc('pos')->find_many();
    
    $admin->render('/subcategory/list.php',array('subcategories'=>$subcategories));
    $_SESSION['msg'] = '';
});

/*
 * Add producer
 */
$app->get('/admin/catalog/producer/add', function () use ($admin) {
    
    $categories = Model::factory('Category')->find_many();
    
    $admin->render('/subcategory/edit.php',array('categories'=>$categories, 'form'=>'add'));
});

$app->post('/admin/catalog/producer/add', function () use ($admin) {
   
    $subcategory = Model::factory('Subcategory')->create();
    $subcategory->cat_id   = $admin->app->request()->post('cat_id');
    $subcategory->name   = $admin->app->request()->post('name');
    $subcategory->pos  = $admin->app->request()->post('pos');

    $category = Model::factory('Category')->find_one($admin->app->request()->post('cat_id'));
    $categories = Model::factory('Category')->find_many();
    
    if($category instanceof Category) {
    
        if (isset($_FILES['file'])) {

            $error = Image::setImage($_FILES, $subcategory::$_workspace, true, array('width'=>250, 'height'=>112));

            if($error['status']==1) {

                    $admin->render('/subcategory/edit.php', array('categories'=>$categories, 'producer'=>$subcategory, 'form'=>'add', 'error'=>$error));
                exit();
            } else {

            $subcategory->img  = $error['uploaded_file'];
            $subcategory->save();
            $_SESSION['status']='0';
            $_SESSION['msg']='Producent został dodany pomyślnie';

            Menu::generate();
            
            $admin->app->redirect('/admin/catalog/producer/all');
            }

        } else {

        $error['status']='1';
        $error['msg']='Producent nie został utworzony';
        
        $admin->render('/subcategory/edit.php', array('catagories'=>$categories, 'producer'=>$subcategory, 'form'=>'add', 'error'=>$error));
        }
        
    } else {
        
        $error['status']='1';
        $error['msg']='Producent nie został utworzony';
        
        $admin->render('/subcategory/edit.php', array('catagories'=>$categories, 'producer'=>$subcategory, 'form'=>'add', 'error'=>$error));
    }
    
});

/*
 * Producer - edit
 */
$app->get('/admin/catalog/producer/edit/:id', function ($id) use ($admin) {
    $subcategory=Model::factory('Subcategory')->find_one($id);
    $categories=Model::factory('Category')->find_many();

    $admin->render('/subcategory/edit.php',array('categories'=>$categories, 'producer'=>$subcategory, 'form'=>'edit'));
});

$app->post('/admin/catalog/producer/edit/:id', function ($id) use ($admin) {

    $subcategory=Model::factory('Subcategory')->find_one($id);
    $categories=Model::factory('Category')->find_many();
    
    if($subcategory instanceof Subcategory) {
        
        $subcategory->cat_id =  $admin->app->request()->post('cat_id');
        $subcategory->name =  $admin->app->request()->post('name');
        $subcategory->pos =  $admin->app->request()->post('pos');
           
            if (isset($_FILES['file'])) {

                $error = Image::setImage($_FILES, $subcategory::$_workspace, true, array('width'=>250, 'height'=>112));

                if($error['status']==1) {
                        $admin->render('/subcategory/edit.php', array('categories'=>$categories, 'producer'=>$subcategory, 'form'=>'edit', 'error'=>$error));
                    exit();
                } else {

                $subcategory->img  = $error['uploaded_file'];

                }

            } else {

                $subcategory->img  = $admin->app->request()->post('img');
            }
            
                $subcategory->save();

                $_SESSION['status']='0';
                $_SESSION['msg']='Producent został wyedytowany poprawnie';
                
                Menu::generate();
                
                $admin->app->redirect('/admin/catalog/producer/all');
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/subcategory/edit.php', array('categories'=>$categories, 'producer'=>$subcategory, 'form'=>'edit', 'error'=>$error));

});

/*
 * Producer - delete
 */

$app->get('/admin/catalog/producer/delete/:id', function ($id) use ($admin) {
    
    $subcategory=Model::factory('Subcategory')->find_one($id);
    
    if($subcategory instanceof Subcategory) {
        
        $remove = Image::remove($subcategory->img, $subcategory::$_workspace, true);
        if($remove) {
            $subcategory->delete();

            $_SESSION['status']='0';
            $_SESSION['msg']='Producent został skasowany poprawnie';
            
            Menu::generate();
            
        } else {
            $_SESSION['status']='1';
            $_SESSION['msg']=$remove;            
        }
    } else {
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->app->redirect('/admin/catalog/producer/all');
});


/*
 * ----------------------------------- Products ----------------------------------
 * View product
 */
$app->get('/admin/catalog/product/all', function () use ($admin) {
    $tabList = array();
    
    $producers = Model::factory('Subcategory')->order_by_asc('pos')->find_many();
    
    foreach($producers as $producer) {
        
        if($producer instanceof Subcategory) {

            $products = $producer->products()->order_by_asc('pos')->find_many();
            
            foreach( $products as $product ) {
                if($product instanceof Product) {
                            
                    $tabTemp['product_name']=$product->name;
                    $tabTemp['product_pos']=$product->pos;
                    $tabTemp['product_img']=$product->img;
                    $tabTemp['product_id']=$product->prod_id;
                    $tabTemp['producer_name'] = $producer->name;
                    $tabTemp['producer_id'] = $producer->subcat_id;

                    $tabList[]=$tabTemp;
                  
                }
                
            }
            
        }
    }

    $admin->render('/product/list.php',array('products'=>$tabList));
    
    $_SESSION['msg'] = '';
});


/*
 * Product add
 */
$app->get('/admin/catalog/product/add', function () use ($admin) {
    
    $producers=Model::factory('Subcategory')->find_many();

    $admin->render('/product/edit.php',array('producers'=>$producers, 'form'=>'add'));
});

$app->post('/admin/catalog/product/add', function () use ($admin) {
        
    $producer=Model::factory('Subcategory')->find_one($admin->app->request()->post('producer_id'));
    $producers=Model::factory('Subcategory')->find_many();
    
    if($producer instanceof Subcategory) {
            $product = Model::factory('Product')->create();
            $product->subcat_id =  $admin->app->request()->post('producer_id');
            $product->name =  $admin->app->request()->post('name');
            $product->pos =  $admin->app->request()->post('pos');
            
            if (isset($_FILES['file'])) {

                $error = Image::setImage($_FILES, $subcategory::$_workspace, true, array('width'=>284, 'height'=>203));

                if($error['status']==1) {
                        $admin->render('/product/edit.php', array('producers'=>$producers, 'form'=>'edit', 'error'=>$error));
                    exit();
                } else {

                $product->img  = $error['uploaded_file'];

                }

            } else {

                $product->img  = $admin->app->request()->post('img');
            }
            
            $product->save();
            $_SESSION['status']='0';
            $_SESSION['msg']='Rodzaj został dodany pomyślnie';
            Menu::generate();
            $admin->app->redirect('/admin/catalog/product/all');
            
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
            
        $admin->render('/product/edit.php', array('producers'=>$producers, 'form'=>'add', 'error'=>$error));
        exit();
    }
  

});


/*
 * Product edit
 */
$app->get('/admin/catalog/product/edit/:id', function ($id) use ($admin) {
    
    $product=Model::factory('Product')->find_one($id);
    $producers=Model::factory('Subcategory')->find_many();

    $admin->render('/product/edit.php',array('producers'=>$producers, 'product'=>$product, 'form'=>'edit'));
});

$app->post('/admin/catalog/product/edit/:id', function ($id) use ($admin) {

    $product=Model::factory('Product')->find_one($id);
    
    $producers=Model::factory('Subcategory')->find_many();
 
        
    
    if($product instanceof Product) {
        
        $product->subcat_id =  $admin->app->request()->post('producer_id');
        $product->name =  $admin->app->request()->post('name');
        $product->pos =  $admin->app->request()->post('pos');
        $product->desc =  $admin->app->request()->post('desc');
        
                   
            if (isset($_FILES['file'])) {

                $error = Image::setImage($_FILES, $product::$_workspace, true, array('width'=>284, 'height'=>203));

                if($error['status']==1) {
                        $admin->render('/product/edit.php', array('producers'=>$producers, 'product'=>$product, 'form'=>'edit', 'error'=>$error));
                    exit();
                } else {

                $product->img  = $error['uploaded_file'];

                }

            } else {

                $product->img  = $admin->app->request()->post('img');
            }
            
                $product->save();

                $_SESSION['status']='0';
                $_SESSION['msg']='Produkt został wyedytowany poprawie';
                Menu::generate();
                
                $admin->app->redirect('/admin/catalog/product/all');
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
 //   $admin->render('/product/edit.php', array('producers'=>$producers, 'product'=>$product, 'form'=>'edit', 'error'=>$error));

});

/*
 * Product delete
 */
$app->get('/admin/catalog/product/delete/:id', function ($id) use ($admin) {
   
    $product=Model::factory('Product')->find_one($id);
    
    if($product instanceof Product) {
        
        $remove = Image::remove($product->img, $product::$_workspace, true);
        if($remove) {
            $product->delete();

            $_SESSION['status']='0';
            $_SESSION['msg']='Produkt został usunięty poprawnie';

        } else {
            $_SESSION['status']='1';
            $_SESSION['msg']=$remove;            
        }
    } else {
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->app->redirect('/admin/catalog/product/all');
    
});



/*
 * Oferta - Gallery ......................................................................
 */

$app->get('/admin/offer/all', function () use ($admin) {
    $fotos=Model::factory('Foto')->order_by_asc('pos')->find_many();
    $admin->render('/foto/list.php',array('fotos'=>$fotos));
    
    $_SESSION['msg'] = '';
});

/**
 * Add foto
 */

$app->get('/admin/offer/add', function () use ($admin) {
 
    $admin->render('/foto/edit.php',array('form'=>'add'));

    
});

$app->post('/admin/offer/add', function () use ($admin) {
   
    $foto = Model::factory('Foto')->create();
    $foto->pos   = $admin->app->request()->post('pos');
    $foto->alt  = $admin->app->request()->post('alt');
    $foto->desc = $admin->app->request()->post('desc');
    
    if (isset($_FILES['file'])) {

        $error = Image::setImage($_FILES,$foto::$_workspace,true,array('width'=>800, 'height'=>800));

        if($error['status']==1) {
                $admin->render('/foto/edit.php', array('foto'=>$foto, 'form'=>'add', 'error'=>$error));
            exit();
        } else {


        $foto->img  = $error['uploaded_file'];
        $foto->save();
        $_SESSION['status']='0';
        $_SESSION['msg']='Pozycja została dodana pomyślnie';
    
        $admin->app->redirect('/admin/offer/all');
    
        
        }

    } else {

    $error['status']='1';
    $error['msg']='Pozycja nie została dodana. Spróbuj ponownie.';

    }
    

    $admin->render('/foto/edit.php', array('foto'=>$foto, 'form'=>'add', 'error'=>$error));

});

/*
 * Edit foto
 */
$app->get('/admin/offer/edit/:id', function ($id) use ($admin) {
    $foto=Model::factory('Foto')->find_one($id);
    
    $admin->render('/foto/edit.php',array('foto'=>$foto, 'form'=>'edit'));
});

$app->post('/admin/offer/edit/:id', function ($id) use ($admin) {

    $foto=Model::factory('Foto')->find_one($id);
    
    if($foto instanceof Foto) {
    $foto->pos   = $admin->app->request()->post('pos');
    $foto->alt   = $admin->app->request()->post('alt');
    $foto->desc = $admin->app->request()->post('desc');
    
    $foto->save();

        $_SESSION['status']='0';
        $_SESSION['msg']='Pozycja została wyedytowane poprawnie';
    
        $admin->app->redirect('/admin/offer/all');
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/foto/edit.php', array('foto'=>$foto, 'form'=>'edit', 'error'=>$error));

});
/*
 * Delete foto
 */
$app->get('/admin/offer/delete/:id', function ($id) use ($admin) {
    $foto=Model::factory('Foto')->find_one($id);
    
    if($foto instanceof Foto) {
        $remove = Image::remove($foto->img, $foto::$_workspace,true);
        if($remove) {
            $foto->delete();
            
            $_SESSION['status']='0';
            $_SESSION['msg']='Pozycja zostało usunięta';
    
        } else {
            $_SESSION['status']='1';
            $_SESSION['msg']=$remove;
    

        }
    } else {
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak';
    }
    $admin->app->redirect('/admin/offer/all');
});

/*
 * Sites ......................................................................
 */
$app->get('/admin/site/all', function () use ($admin) {
    $sites=Model::factory('Site')->find_many();
    $admin->render('/site/list.php',array('sites'=>$sites));
    
    $_SESSION['msg'] = '';
});


/*
 * Edit site
 */
$app->get('/admin/site/edit/:id', function ($id) use ($admin) {
 
    $site=Model::factory('Site')->find_one($id);
    
    if($site instanceof Site) {

        $admin->render('/site/edit.php',array('site'=>$site, 'form'=>'edit'));
    }
    else $admin->redirect('/admin/site/all');
});

$app->post('/admin/site/edit/:id', function ($id) use ($admin) {
 
    $site=Model::factory('Site')->find_one($id);
    
    if($site instanceof Site) {

        $site->content   = $admin->app->request()->post('content');
        $site->save();
        
        $_SESSION['status']='0';
        $_SESSION['msg']='Strona została wyedytowana pomyślnie';
        
    } 
    
    $admin->app->redirect('/admin/site/all');
});
