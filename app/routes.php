<?php

use Star\Route;
use Star\App;

Route::get('/',function(){
  App::render('layout.twig', array('title' => 'Hallo', 'subtitle' => 'Welt'));
});

