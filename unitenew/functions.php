<?php

function show_last_movies($atts){
	$params = array(
		'post_type' => 'movies', // параметр поиска по типу - фильмы
		'numberposts' => 5, // получить 5 постов, можно также использовать posts_per_page
	);


	$recent_posts_array = get_posts($params); // получаем массив постов-фильмов
		foreach( $recent_posts_array as $recent_post_single ) : // для каждого поста из массива
			echo '<h2><a href="' . get_permalink( $recent_post_single ) . '">' . $recent_post_single->post_title . '</a></h2></br>'; // выводим ссылку
		endforeach; // конец цикла
}

//Добавляем шорткод для вывода на странице фильмов
add_shortcode ('lastfive','show_last_movies');

?>
