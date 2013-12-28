<?php

Route::get('/',function(){
  App::render('layout.twig', array('title' => 'Hallo', 'subtitle' => 'Welt'));
});

