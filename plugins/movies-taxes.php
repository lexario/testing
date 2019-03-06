<?php
/*
 * Plugin Name: Movie plugin
 * Description: Плагин вывода таксомномий для фильма
 * Version: 1.1.1
 * License: GPLv2 or later
 */



//Функция формирования списка таксономий фильма (кастомной записи)

function get_tax_of_movie($tax_name)
{
  
  $tax_by_name = ''; //переменная для конкатенации таксономий

  $terms = get_the_terms( $post->ID , $tax_name ); //получаем таксономию текущей записи по ее имени



                    foreach ( $terms as $term ) {   
                        $term_link = get_term_link( $term, $tax_name ); //получаем ссылку на таксономию
                        
                        if( is_wp_error( $term_link ) )
                        		continue;  // если не найдена ссылка - продолжаем цикл
                    	
                    	// записываем все значения таксономии в переменную
                    	$tax_by_name = '<a href="' . $term_link . '">' . $term->name . '</a> ' . $tax_by_name . ' ';
                    
                    }


     return $tax_by_name; // возвращаем список значений таксономии
                    
}



//Функция хука - добавление в блок контента
function movies_content_hook($content)
{

//проверям пост на принадлежность к типу "Фильмы" или архивным записям
if ( is_archive() || is_singular('movies')   ){   


  //формируем список таксономий, вызывая ранее описанную функцию 
	$issin =  'Жанр: ' . get_tax_of_movie('genres') . '</br>Страна: ' . get_tax_of_movie('countries') ; 
  return $content . $issin; 
}

else
  return $content;

}

//добавляем хук на добавление изменений в блок контента
add_filter('the_content', 'movies_content_hook');


?>