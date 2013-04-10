<?php
 
/*
 * TODO: obrazek dodać w przypadku braku loga producenta (subkategorie)
 * 
 * 
 */

$app->get('/admin/', function () use ($app) {
    $app->redirect('/admin/catalog/category/all');
});


/*
 * Categories ......................................................................
 */

$app->get('/admin/catalog/category/all', function () use ($admin) {
    $categories=Model::factory('Category')->find_many();
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
    $category->save();

    $_SESSION['status']='0';
    $_SESSION['msg']='Kategoria została wyedytowana poprawnie';
        
        
    $admin->app->redirect('/admin/catalog/category/all');
    
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
        $category->save();

        $_SESSION['status']='0';
        $_SESSION['msg']='Kategoria została wyedytowana poprawnie';
        
        
        $admin->app->redirect('/admin/catalog/category/all');
        
    }
    else {
        $_SESSION['status']='1';
        $_SESSION['msg']='Kategoria nie została wyedytowana. Spróbuj ponownie';
        
        $admin->render('/category/edit.php', array('category'=>$category));
    }
  
    
});

/*
 * Category delete
 */
$app->post('/admin/catalog/category/delete/:id', function ($id) use ($admin) {

    $category=Model::factory('Category')->find_one($id);
    
    if($category instanceof Category) {

        $category->delete();

        $_SESSION['status']='0';
        $_SESSION['msg']='Kategoria została skasowana poprawnie';

    } else {
        
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak';
    }
    
    $admin->app->redirect('/admin/catalog/category/all');
    
});


/*
 * ----------------------------------- PRODUCER (SUBCATEGORY) ----------------------------------
 * Producer - view list
 */
$app->get('/admin/catalog/producer/all', function () use ($admin) {
    
    $subcategories=Model::factory('Subcategory')->find_many();
    
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
    $subcategory->name   = $admin->app->request()->post('nazwa');
    $subcategory->pos  = $admin->app->request()->post('pos');

    $category = Model::factory('Category')->find_one($admin->app->request()->post('cat_id'));
    
    
    if($category instanceof Category) {
    
        if (isset($_FILES['file'])) {

            $error = Image::setImage($_FILES, $subcategory::$_workspace, true, array('width'=>250, 'height'=>112));

            if($error['status']==1) {

                    $categories = Model::factory('Category')->find_many();
                
                    $admin->render('/subcategory/edit.php', array('catagories'=>$categories, 'subcategory'=>$subcategory, 'form'=>'add', 'error'=>$error));
                exit();
            } else {

            $subcategory->img  = $_SESSION['uploaded_file'];
            $subcategory->save();
            $_SESSION['status']='0';
            $_SESSION['msg']='Producent został dodany pomyślnie';

            $admin->app->redirect('/admin/catalog/producer/all');
            }

        } else {

        $error['status']='1';
        $error['msg']='Producent nie został utworzony';
        $categories = Model::factory('Category')->find_many();
        
        $admin->render('/subcategory/edit.php', array('catagories'=>$categories, 'subcategory'=>$subcategory, 'form'=>'add', 'error'=>$error));
        }
        
    } else {
        
        $error['status']='1';
        $error['msg']='Producent nie został utworzony';
        $categories = Model::factory('Category')->find_many();
        
        $admin->render('/subcategory/edit.php', array('catagories'=>$categories, 'subcategory'=>$subcategory, 'form'=>'add', 'error'=>$error));
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
        
        $remove = Image::remove($subcategory->img, $subcategory::$_workspace);
        if($remove) {
            $subcategory->delete();

            $_SESSION['status']='0';
            $_SESSION['msg']='Producent został skasowany poprawnie';
            
            $admin->app->redirect('/admin/catalog/producer/all');

        } else {
            $error['status']='1';
            $error['msg']=$remove;            
        }
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak';
    }
    
    $admin->render('/subcategory/edit.php',array('form'=>'add', 'error'=>$error));
});


/*
 * ----------------------------------- Products ----------------------------------
 * View product
 */
$app->get('/admin/catalog/product/all', function () use ($admin) {
    $tabList = array();
    
    $producers = Model::factory('Subcategory')->find_many();
    
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

    $produkt=Model::factory('Product')->find_one($id);
    
    $producers=Model::factory('Subcategory')->find_many();
 
        
    
    if($product instanceof Product) {
        
        $product->subcat_id =  $admin->app->request()->post('producer_id');
        $product->name =  $admin->app->request()->post('name');
        $product->pos =  $admin->app->request()->post('pos');
        
                   
            if (isset($_FILES['file'])) {

                $error = Image::setImage($_FILES, $subcategory::$_workspace, true, array('width'=>284, 'height'=>203));

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
                
                $admin->app->redirect('/admin/catalog/product/all');
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/product/edit.php', array('producers'=>$producers, 'product'=>$product, 'form'=>'edit', 'error'=>$error));

});

/*
 * Product delete
 */
$app->get('/admin/catalog/product/delete/:id', function ($id) use ($admin) {
    
    $produkt=Model::factory('Product')->find_one($id);
    
    if($product instanceof Product) {
        $product->delete();
        
        $_SESSION['status']='0';
        $_SESSION['msg']='Produkt został skasowany poprawnie';
        
    } else {
        $_SESSION['status']='1';
        $_SESSION['msg']='Coś poszło nie tak';
    }
    
    $admin->app->redirect('/admin/catalog/product/all');
});



/*
 * ----------------------------------- CENY (PRODUKTY) ----------------------------------
 * Drzewka - lista produktów
 */
$app->get('/admin/drzewka/lista', function () use ($admin) {
    $tabCennik = array();
    $tabGrupy = array();
    $tabProdukty = array();
    $tabCeny = array();
    
    $grupy = Model::factory('CennikDrzewkaGrupa')->order_by_asc('pozycja')->find_many();
    
    foreach($grupy as $grupa) {
        
        if($grupa instanceof CennikDrzewkaGrupa) {

            $produkty = $grupa->produkt()->order_by_asc('pozycja')->find_many();
            
            foreach( $produkty as $produkt ) {
                if($produkt instanceof CennikDrzewkaProdukt) {
                            
                    $ceny = $produkt->cena()->order_by_asc('pozycja')->find_many();
                  //   print_r($tabProdukty['nazwa']);
                    foreach($ceny as $cena){
                        if($cena instanceof CennikDrzewkaCena) {
                          
                              $tabTemp['id_cena']=$cena->id_cennik_drzewka_ceny;
                              $tabTemp['wysokosc'] = $cena->wysokosc;
                              $tabTemp['rozmiar'] = $cena->rozmiar;
                              $tabTemp['cena'] = $cena->cena;
                              $tabTemp['nazwa_produktu']=$produkt->nazwa;
                              $tabTemp['pozycja_produktu']=$produkt->pozycja;
                              $tabTemp['pozycja_cena']=$cena->pozycja;
                              $tabTemp['id_prod']=$produkt->id_cennik_drzewka_produkty;
                              $tabTemp['nazwa_grupy'] = $grupa->nazwa;
                              $tabTemp['id_gr'] = $grupa->id_cennik_drzewka_grupy;
                              
                              $tabCennik[]=$tabTemp;
                              
                        }
                        
                    }
                   
                  
                }
                
            }
            
        }
    }



    $admin->render('/drzewka/cennik_lista.php',array('cennik'=>$tabCennik));
});
/*
 * Drzewka - edytuj produkt
 */
$app->get('/admin/drzewka/produkt/edytuj/:id', function ($id) use ($admin) {
    $cena=Model::factory('CennikDrzewkaCena')->find_one($id);
    $produkt=$cena->produkt()->find_one();
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();

    $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit'));
});


/*
 * Drzewka edycja POST
 */
$app->post('/admin/drzewka/produkt/edytuj/:id', function ($id) use ($admin) {

    $cena=Model::factory('CennikDrzewkaCena')->find_one($id);
    $produkt=$cena->produkt()->find_one();
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();
 
        
    
    if($cena instanceof CennikDrzewkaCena) {
        $cena->id_cennik_drzewka_produkty =  $admin->app->request()->post('idProd');
        $cena->wysokosc =  $admin->app->request()->post('wysokosc');
        $cena->rozmiar =  $admin->app->request()->post('rozmiar');
        $cena->cena =  $admin->app->request()->post('cena');
        $cena->pozycja =  $admin->app->request()->post('pozycja');
        
        if($produkt instanceof CennikDrzewkaProdukt) {
            
                $cena->save();

                $error['status']='0';
                $error['msg']='Produkt został wyedytowany poprawie';
            
        } else {
            $error['status']='1';
            $error['msg']='Coß poszło nie tak. Spróbuj ponownie.';
        }
        
    } else {
        $error['status']='1';
        $error['msg']='Coß poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit', 'error'=>$error));

});


/*
 * Drzewka dodawanie ceny do produktu (rodzaju)
 */
$app->get('/admin/drzewka/produkt/dodaj', function () use ($admin) {
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();

    $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'form'=>'add'));
});

$app->post('/admin/drzewka/produkt/dodaj', function () use ($admin) {
        
    $produkt=Model::factory('CennikDrzewkaProdukt')->find_one($admin->app->request()->post('idProd'));
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();
    
       
    if($produkt instanceof CennikDrzewkaProdukt) {
            $cena = Model::factory('CennikDrzewkaCena')->create();
            $cena->id_cennik_drzewka_produkty =  $admin->app->request()->post('idProd');
            $cena->wysokosc =  $admin->app->request()->post('wysokosc');
            $cena->rozmiar =  $admin->app->request()->post('rozmiar');
            $cena->cena =  $admin->app->request()->post('cena');
            $cena->pozycja =  $admin->app->request()->post('pozycja');
            
            $cena->save();
            $error['status']='0';
            $error['msg']='Produkt został dodany pomyślnie';
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
            
        $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'form'=>'add', 'error'=>$error));
        exit();
    }
    
    $cena->id_cennik_drzewka_ceny=$cena->id();
    

    $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit', 'error'=>$error));

});
/*
 * Drzewka usuwanie ceny produktu (rodzaju)
 */
$app->get('/admin/drzewka/produkt/usun/:id', function ($id) use ($admin) {
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();

    $cena=Model::factory('CennikDrzewkaCena')->find_one($id);
    
    if($cena instanceof CennikDrzewkaCena) {
        $cena->delete();
        
        $error['status']='0';
        $error['msg']='Cena zostało skasowana poprawnie';
        
        $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'form'=>'add', 'error'=>$error));
        exit();
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak';
    }
    
    $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'form'=>'add', 'error'=>$error));
});

/*
 * Cennik uslugi ......................................................................
 */

/*
 * Usługi - lista uslug
 */
$app->get('/admin/uslugi/lista', function () use ($admin) {
    
    $uslugi = Model::factory('UslugiRodzaj')->order_by_asc('pozycja')->find_many();

    $admin->render('/uslugi/cennik_lista.php',array('uslugi'=>$uslugi));
});

/*
 * Usługi - dodaj usluge
 */
$app->get('/admin/uslugi/dodaj', function () use ($admin) {
    
    $admin->render('/uslugi/cennik_edycja.php',array('form'=>'add'));
});

$app->post('/admin/uslugi/dodaj', function () use ($admin) {
   
    $usluga = Model::factory('UslugiRodzaj')->create();
    $usluga->pozycja   = $admin->app->request()->post('pozycja');
    $usluga->nazwa   = $admin->app->request()->post('nazwa');
    $usluga->cena  = $admin->app->request()->post('cena');
    
    $admin->render('/uslugi/cennik_edycja.php', array('usluga'=>$usluga, 'form'=>'add', 'error'=>$error));

});

/*
 * Usługi - edytuj usluge
 */
$app->get('/admin/uslugi/edytuj/:id', function ($id) use ($admin) {
    $usluga=Model::factory('UslugiRodzaj')->find_one($id);
    //edycja obrazkow
    $admin->render('/uslugi/cennik_edycja.php',array('usluga'=>$usluga, 'form'=>'edit'));
});

$app->post('/admin/uslugi/edytuj/:id', function ($id) use ($admin) {

    $usluga=Model::factory('UslugiRodzaj')->find_one($id);
    
    if($usluga instanceof UslugiRodzaj) {
    $usluga->pozycja   = $admin->app->request()->post('pozycja');
    $usluga->nazwa   = $admin->app->request()->post('nazwa');
    $usluga->cena  = $admin->app->request()->post('cena');
           
        $usluga->save();

        $error['status']='0';
        $error['msg']='Usługa została wyedytowana poprawnie';
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/uslugi/cennik_edycja.php', array('usluga'=>$usluga, 'form'=>'edit', 'error'=>$error));

});
/*
 * Usługi - usun usluge
 */
$app->get('/admin/uslugi/usun/:id', function ($id) use ($admin) {
    $usluga=Model::factory('UslugiRodzaj')->find_one($id);
    
    if($usluga instanceof UslugiRodzaj) {
        $usluga->delete();
        
        $error['status']='0';
        $error['msg']='Zdjęcie zostało wyedytowane poprawnie';
        
        $admin->render('/uslugi/cennik_edycja.php',array('form'=>'add'));
        exit();
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak';
    }
    $admin->render('/uslugi/cennik_edycja.php',array('form'=>'add', 'error'=>$error));
});

/*
 * Galeria ......................................................................
 */

/*
 * Galeria - lista zdjęć
 */
$app->get('/admin/galeria/lista', function () use ($admin) {
    
    $fotos = Model::factory('Foto')->order_by_asc('pozycja')->find_many();

    $admin->render('/foto/lista.php',array('fotos'=>$fotos));
});

/*
 * Galeria - dodaj foto
 */
$app->get('/admin/galeria/dodaj', function () use ($admin) {
    
    $admin->render('/foto/edycja.php',array('form'=>'add'));
});

$app->post('/admin/galeria/dodaj', function () use ($admin) {
   
    $foto = Model::factory('Foto')->create();
    $foto->pozycja   = $admin->app->request()->post('pozycja');
    $foto->alt  = $admin->app->request()->post('alt');
    
    if (isset($_FILES['file'])) {

        $error = Image::setImage($_FILES,$foto::$_workspace,true);

        if($error['status']==1) {
                $admin->render('/foto/edycja.php', array('foto'=>$foto, 'form'=>'add', 'error'=>$error));
            exit();
        } else {


        $foto->url  = $error['uploaded_file'];
        $foto->save();
        $error['status']='0';
        $error['msg']='Zdjęcie została dodana pomyślnie';
        
        }

    } else {

    $error['status']='1';
    $error['msg']='Zdjęcie nie została dodane';

    }
    

    $admin->render('/foto/edycja.php', array('foto'=>$foto, 'form'=>'add', 'error'=>$error));

});

/*
 * Galeria - edytuj zdjęcie
 */
$app->get('/admin/galeria/edytuj/:id', function ($id) use ($admin) {
    $foto=Model::factory('Foto')->find_one($id);
    
    $admin->render('/galeria/edycja.php',array('foto'=>$foto, 'form'=>'edit'));
});

$app->post('/admin/galeria/edytuj/:id', function ($id) use ($admin) {

    $foto=Model::factory('Foto')->find_one($id);
    
    if($foto instanceof Foto) {
    $foto->pozycja   = $admin->app->request()->post('pozycja');
    $foto->alt   = $admin->app->request()->post('alt');
   
    $foto->save();

        $error['status']='0';
        $error['msg']='Zdjęcie zostało wyedytowane poprawnie';
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/foto/edycja.php', array('foto'=>$foto, 'form'=>'edit', 'error'=>$error));

});
/*
 * Galeria - usuń zdjęcie
 */
$app->get('/admin/galeria/usun/:id', function ($id) use ($admin) {
    $foto=Model::factory('Foto')->find_one($id);
    
    if($foto instanceof Foto) {
        $remove = Image::remove($foto->url, $foto::$_workspace);
        if($remove) {
            $foto->delete();

            $error['status']='0';
            $error['msg']='Zdjęcie zostało usunięte';

        } else {
            $error['status']='1';
            $error['msg']=$remove;
        }
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak';
    }

    $admin->render('/foto/edycja.php',array('foto'=>$foto, 'form'=>'edit', 'error'=>$error));
});




