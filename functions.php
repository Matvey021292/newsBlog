<?php
/**
 * LittNews functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LittNews
 */

if ( ! function_exists( 'littnews_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function littnews_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on LittNews, use a find and replace
		 * to change 'littnews' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'littnews', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'littnews' ),
			'menu-2' => esc_html__( 'header', 'littnews' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'littnews_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'littnews_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

class True_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output
     * @param object $item Объект элемента меню, подробнее ниже.
     * @param int $depth Уровень вложенности элемента меню.
     * @param object $args Параметры функции wp_nav_menu
     */
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        /*
         * Некоторые из параметров объекта $item
         * ID - ID самого элемента меню, а не объекта на который он ссылается
         * menu_item_parent - ID родительского элемента меню
         * classes - массив классов элемента меню
         * post_date - дата добавления
         * post_modified - дата последнего изменения
         * post_author - ID пользователя, добавившего этот элемент меню
         * title - заголовок элемента меню
         * url - ссылка
         * attr_title - HTML-атрибут title ссылки
         * xfn - атрибут rel
         * target - атрибут target
         * current - равен 1, если является текущим элементов
         * current_item_ancestor - равен 1, если текущим является вложенный элемент
         * current_item_parent - равен 1, если текущим является вложенный элемент
         * menu_order - порядок в меню
         * object_id - ID объекта меню
         * type - тип объекта меню (таксономия, пост, произвольно)
         * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
         * type_label - название данного типа с локализацией (Рубрика, Страница)
         * post_parent - ID родительского поста / категории
         * post_title - заголовок, который был у поста, когда он был добавлен в меню
         * post_name - ярлык, который был у поста при его добавлении в меню
         */
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /*
         * Генерируем строку с CSS-классами элемента меню
         */
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // функция join превращает массив в строку
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        /*
         * Генерируем ID элемента
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        /*
         * Генерируем элемент меню
         */
        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        // атрибуты элемента, title="", rel="", target="" и href=""
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // ссылка и околоссылочный текст
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
function littnews_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'littnews_content_width', 640 );
}
add_action( 'after_setup_theme', 'littnews_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function littnews_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar-left', 'littnews' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'littnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar-right', 'littnews' ),
        'id'            => 'sidebar-2',
        'description'   => esc_html__( 'Add widgets here.', 'littnews' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'littnews_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function littnews_scripts() {
//    wp_enqueue_style( 'littnews-style', get_stylesheet_uri() );
    wp_enqueue_style( 'littnews-style-hover',get_template_directory_uri() . '/css/hover.css','', '' );
    wp_enqueue_style( 'littnews-style-dev',get_template_directory_uri() . '/css/style.css','', '' );
    wp_enqueue_style( 'littnews-video-dev',get_template_directory_uri() . '/css/video-js.min.css','', '' );
    wp_enqueue_style( 'littnews-animation',get_template_directory_uri() . '/css/animate.css','', '' );
    wp_enqueue_style( 'littnews-base',get_template_directory_uri() . '/css/base.css','', '' );

//	wp_enqueue_script( 'littnews-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
//    wp_enqueue_script( 'littnews-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/libs.min.js', array(),"", true );
    wp_enqueue_script( 'animationjs', get_template_directory_uri() . '/js/jquery.viewportchecker.min.js', array(),"", true );
    wp_enqueue_script( 'constructorLibs', get_template_directory_uri() . '/js/constructorLibs.js', array(),"", true );
    wp_enqueue_script( 'video', get_template_directory_uri() . '/js/video/video.min.js', array(),"", true );
    wp_enqueue_script( 'video-controls', get_template_directory_uri() . '/js/video/videojs-contrib-hls.min.js', array(),"", true );

    wp_enqueue_script( 'components', get_template_directory_uri() . '/js/components.js', array(),"", true );
    wp_enqueue_script( 'common', get_template_directory_uri() . '/js/common.js', array(),"", true );
    wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/libs.min.js', array(),"", true );
    // wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/slider/imagesloaded.pkgd.min.js', array(),"", true );
    // wp_enqueue_script( 'TweenMax', get_template_directory_uri() . '/js/slider/TweenMax.min.js', array(),"", true );
    wp_enqueue_script( 'demo', get_template_directory_uri() . '/js/slider/demo.js', array(),"", true );
    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array(),"", true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'littnews_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




//remove_filter( 'the_content', 'wpautop' );


/**
 * Выводит на экрна список последних записей.
 *
 * @param  integer [$post_num = 5]   Количество ссылок
 * @param  string [$format = '']     {avatar} {author}: {date:j.M.Y} - {a}{title}{/a} ({comments})
 * @param  string [$cat = '']        Категории из которых нужно выводить (5,15) или которые нужно исключить (-5,-15),
 *                                   через запятую (одновременно включение и исключение не работает (не имеет смысла) )
 * @param  string [$list_tag = 'li'] Тег списка
 * @param  boolean [$echo = true]    Выводить на экран или возвращать
 *
 * @return string  HTML.
 * @version: 0.1.2
 */
//function kama_recent_posts( $post_num = 5, $format = '', $cat = '', $list_tag = 'li', $echo = true ){
//    global $post, $wpdb;
//
//    $cur_postID = $post->ID;
//
//    // исключим посты главного запроса (wp_query)
//    $IDs = '';
//    foreach( $GLOBALS['wp_query']->posts as $post ) $IDs .= $post->ID .',';
//    $AND_NOT_IN = ' AND p.ID NOT IN ('. rtrim($IDs, ',') .')';
//
//    $DISTINCT = $SEL = $JOIN = $AND_category = $AND_taxonomy = '';
//
//    if( $cat ){
//        $JOIN = "LEFT JOIN $wpdb->term_relationships rel ON ( p.ID = rel.object_id )
//            LEFT JOIN $wpdb->term_taxonomy tax ON ( tax.term_taxonomy_id = rel.term_taxonomy_id  ) ";
//        $DISTINCT = "DISTINCT";
//        $AND_taxonomy = "AND tax.taxonomy = 'category'";
//        $AND_category = "AND tax.term_id IN ($cat)";
//
//        // Проверка на исключение категорий
//        if( strpos($cat, '-')!==false )
//            $AND_category = 'AND tax.term_id NOT IN ('. str_replace( '-','', $cat ) .')';
//
//    }
//    // если нужно показать автора
//    if( false !== strpos($format, '{author}') ){
//        $JOIN .= " LEFT JOIN $wpdb->users u ON ( p.post_author = u.ID )";
//        $SEL = ", u.user_nicename AS author, u.user_email, u.user_url";
//
//        // если нужно показать аватар (gavatar)
//        if( strpos($format, '{avatar}')!==false )
//            $av = "<img src='http://www.gravatar.com/avatar/%1\$s?s=25' alt='' />";
//    }
//
//    $sql = "SELECT $DISTINCT p.ID, post_title, post_date, comment_count, guid $SEL
//    FROM $wpdb->posts p $JOIN
//    WHERE post_type = 'post' AND post_status = 'publish' $AND_category $AND_taxonomy $AND_NOT_IN
//    ORDER BY post_date DESC LIMIT $post_num";
//    $results = $wpdb->get_results($sql);
//
//    if( ! $results )
//        return false;
//
//    $out = '';
//    $x = '';
//    preg_match( '~\{date:(.*?)\}~', $format, $date_m );
//    foreach( $results as $pst ){
//        $x = ( $x == 'li1' ) ? 'li2' : 'li1';
//        if ( $pst->ID == $cur_postID ) $x .= " current-item";
//
//        $a = '<a href="'. get_permalink($pst->ID) .'" title="'. esc_attr($pst->post_title) .'">';
//
//        if( $format ){
//            $avatar = isset($av) ? sprintf( $av, md5($pst->user_email) ) : '';
//            $date = apply_filters('the_time', mysql2date($date_m[1], $pst->post_date));
//            $Sformat = str_replace( $date_m[0], $date, $format);
//            $Sformat = str_replace(
//                array('{title}',                   '{a}', '{/a}', '{author}',             '{comments}',         '{avatar}'),
//                array( esc_html($pst->post_title), $a,    '</a>', esc_html($pst->post_author), $pst->comment_count,  $avatar   ),
//                $Sformat
//            );
//        }
//        else
//            $Sformat = $a . esc_html($pst->post_title) .'</a>';
//
//        $out .= "\n<$list_tag class='$x'>{$Sformat}</$list_tag>";
//    }
//
//    if( $echo ) echo $out;
//    return $out;
//}

function do_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
        array_pop($words);
    echo implode(' ', $words).' ...';
}


function trim_title_words($count, $after) {
    $title = get_the_title();
    $words = split(' ', $title);
    if (count($words) > $count) {
        array_splice($words, $count);
        $title = implode(' ', $words);
    }
    else $after = '';
    echo $title . $after;
}


add_theme_support( 'post-formats', array( 'video') );
add_post_type_support( 'page', 'post-formats' );


function wp_get_cat_postnum($id) {
    $cat = get_category($id);
    $count = (int) $cat->count;
    $taxonomy = 'category';
    $args = array(
        'child_of' => $id,
    );
    $tax_terms = get_terms($taxonomy,$args);
    foreach ($tax_terms as $tax_term) {
        $count +=$tax_term->count;
    }
    return $count;
}

add_action( 'genesis_after_comments', 'single_cpt_post_reviews' );
function single_cpt_post_reviews() {
    if ( 'portfolio' == get_post_type() && is_single() ) {
        echo do_shortcode('[ratings id="1"]');

    }

}




/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
    $kb = new Kama_Breadcrumbs;
    echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

    public $arg;

    // Локализация
    static $l10n = array(
        'home'       => 'Главная',
        'paged'      => 'Страница %d',
        '_404'       => 'Ошибка 404',
        'search'     => 'Результаты поиска по запросу - <b>%s</b>',
        'author'     => 'Архив автора: <b>%s</b>',
        'year'       => 'Архив за <b>%d</b> год',
        'month'      => 'Архив за: <b>%s</b>',
        'day'        => '',
        'attachment' => 'Медиа: %s',
        'tag'        => 'Записи по метке: <b>%s</b>',
        'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
        // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
        // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
    );

    // Параметры по умолчанию
    static $args = array(
        'on_front_page'   => true,  // выводить крошки на главной странице
        'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
        'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
        'title_patt'      => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
        'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
        'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
        // или можно указать свой массив разметки:
        // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
        'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
        'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
        // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
        // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
        // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
        'nofollow' => false, // добавлять rel=nofollow к ссылкам?

        // служебные
        'sep'             => '',
        'linkpatt'        => '',
        'pg_end'          => '',
    );

    function get_crumbs( $sep, $l10n, $args ){
        global $post, $wp_query, $wp_post_types;

        self::$args['sep'] = $sep;

        // Фильтрует дефолты и сливает
        $loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
        $arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

        $arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

        // упростим
        $sep = & $arg->sep;
        $this->arg = & $arg;

        // микроразметка ---
        if(1){
            $mark = & $arg->markup;

            // Разметка по умолчанию
            if( ! $mark ) $mark = array(
                'wrappatt'  => '<div class="kama_breadcrumbs">%s</div>',
                'linkpatt'  => '<a href="%s">%s</a>',
                'sep_after' => '',
            );
            // rdf
            elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
                'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
                'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
                'sep_after'  => '</span>', // закрываем span после разделителя!
            );
            // schema.org
            elseif( $mark === 'schema.org' ) $mark = array(
                'wrappatt'   => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
                'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
                'sep_after'  => '',
            );

            elseif( ! is_array($mark) )
                die( __CLASS__ .': "markup" parameter must be array...');

            $wrappatt  = $mark['wrappatt'];
            $arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
            $arg->sep      .= $mark['sep_after']."\n";
        }

        $linkpatt = $arg->linkpatt; // упростим

        $q_obj = get_queried_object();

        // может это архив пустой таксы?
        $ptype = null;
        if( empty($post) ){
            if( isset($q_obj->taxonomy) )
                $ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
        }
        else $ptype = & $wp_post_types[ $post->post_type ];

        // paged
        $arg->pg_end = '';
        if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
            $arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

        $pg_end = $arg->pg_end; // упростим

        // ну, с богом...
        $out = '';

        if( is_front_page() ){
            return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
        }
        // страница записей, когда для главной установлена отдельная страница.
        elseif( is_home() ) {
            $out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
        }
        elseif( is_404() ){
            $out = $loc->_404;
        }
        elseif( is_search() ){
            $out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
        }
        elseif( is_author() ){
            $tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
            $out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
        }
        elseif( is_year() || is_month() || is_day() ){
            $y_url  = get_year_link( $year = get_the_time('Y') );

            if( is_year() ){
                $tit = sprintf( $loc->year, $year );
                $out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
            }
            // month day
            else {
                $y_link = sprintf( $linkpatt, $y_url, $year);
                $m_url  = get_month_link( $year, get_the_time('m') );

                if( is_month() ){
                    $tit = sprintf( $loc->month, get_the_time('F') );
                    $out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
                }
                elseif( is_day() ){
                    $m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
                    $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
                }
            }
        }
        // Древовидные записи
        elseif( is_singular() && $ptype->hierarchical ){
            $out = $this->_add_title( $this->_page_crumbs($post), $post );
        }
        // Таксы, плоские записи и вложения
        else {
            $term = $q_obj; // таксономии

            // определяем термин для записей (включая вложения attachments)
            if( is_singular() ){
                // изменим $post, чтобы определить термин родителя вложения
                if( is_attachment() && $post->post_parent ){
                    $save_post = $post; // сохраним
                    $post = get_post($post->post_parent);
                }

                // учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
                $taxonomies = get_object_taxonomies( $post->post_type );
                // оставим только древовидные и публичные, мало ли...
                $taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

                if( $taxonomies ){
                    // сортируем по приоритету
                    if( ! empty($arg->priority_tax) ){
                        usort( $taxonomies, function($a,$b)use($arg){
                            $a_index = array_search($a, $arg->priority_tax);
                            if( $a_index === false ) $a_index = 9999999;

                            $b_index = array_search($b, $arg->priority_tax);
                            if( $b_index === false ) $b_index = 9999999;

                            return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
                        } );
                    }

                    // пробуем получить термины, в порядке приоритета такс
                    foreach( $taxonomies as $taxname ){
                        if( $terms = get_the_terms( $post->ID, $taxname ) ){
                            // проверим приоритетные термины для таксы
                            $prior_terms = & $arg->priority_terms[ $taxname ];
                            if( $prior_terms && count($terms) > 2 ){
                                foreach( (array) $prior_terms as $term_id ){
                                    $filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
                                    $_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

                                    if( $_terms ){
                                        $term = array_shift( $_terms );
                                        break;
                                    }
                                }
                            }
                            else
                                $term = array_shift( $terms );

                            break;
                        }
                    }
                }

                if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
            }

            // вывод

            // все виды записей с терминами или термины
            if( $term && isset($term->term_id) ){
                $term = apply_filters('kama_breadcrumbs_term', $term );

                // attachment
                if( is_attachment() ){
                    if( ! $post->post_parent )
                        $out = sprintf( $loc->attachment, esc_html($post->post_title) );
                    else {
                        if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
                            $_crumbs    = $this->_tax_crumbs( $term, 'self' );
                            $parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
                            $_out = implode( $sep, array($_crumbs, $parent_tit) );
                            $out = $this->_add_title( $_out, $post );
                        }
                    }
                }
                // single
                elseif( is_single() ){
                    if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'self' );
                        $out = $this->_add_title( $_crumbs, $post );
                    }
                }
                // не древовидная такса (метки)
                elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
                    // метка
                    if( is_tag() )
                        $out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
                    // такса
                    elseif( is_tax() ){
                        $post_label = $ptype->labels->name;
                        $tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
                        $out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
                    }
                }
                // древовидная такса (рибрики)
                else {
                    if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'parent' );
                        $out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
                    }
                }
            }
            // влоежния от записи без терминов
            elseif( is_attachment() ){
                $parent = get_post($post->post_parent);
                $parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
                $_out = $parent_link;

                // вложение от записи древовидного типа записи
                if( is_post_type_hierarchical($parent->post_type) ){
                    $parent_crumbs = $this->_page_crumbs($parent);
                    $_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
                }

                $out = $this->_add_title( $_out, $post );
            }
            // записи без терминов
            elseif( is_singular() ){
                $out = $this->_add_title( '', $post );
            }
        }

        // замена ссылки на архивную страницу для типа записи
        $home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

        if( '' === $home_after ){
            // Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
            if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
                && ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
            ){
                $pt_title = $ptype->labels->name;

                // первая страница архива типа записи
                if( is_post_type_archive() && ! $paged_num )
                    $home_after = sprintf( $this->arg->title_patt, $pt_title );
                // singular, paged post_type_archive, tax
                else{
                    $home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

                    $home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
                }
            }
        }

        $before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

        $out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

        $out = sprintf( $wrappatt, $before_out . $out );

        return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
    }

    function _page_crumbs( $post ){
        $parent = $post->post_parent;

        $crumbs = array();
        while( $parent ){
            $page = get_post( $parent );
            $crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
            $parent = $page->post_parent;
        }

        return implode( $this->arg->sep, array_reverse($crumbs) );
    }

    function _tax_crumbs( $term, $start_from = 'self' ){
        $termlinks = array();
        $term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
        while( $term_id ){
            $term       = get_term( $term_id, $term->taxonomy );
            $termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
            $term_id    = $term->parent;
        }

        if( $termlinks )
            return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
        return '';
    }

    // добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
    function _add_title( $add_to, $obj, $term_title = '' ){
        $arg = & $this->arg; // упростим...
        $title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
        $show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

        // пагинация
        if( $arg->pg_end ){
            $link = $term_title ? get_term_link($obj) : get_permalink($obj);
            $add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
        }
        // дополняем - ставим sep
        elseif( $add_to ){
            if( $show_title )
                $add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
            elseif( $arg->last_sep )
                $add_to .= $arg->sep;
        }
        // sep будет потом...
        elseif( $show_title )
            $add_to = sprintf( $arg->title_patt, $title );

        return $add_to;
    }

}

/**
 * Изменения:
 * 3.3 - новые хуки: attachment_tax_crumbs, post_tax_crumbs, term_tax_crumbs. Позволяют дополнить крошки таксономий.
 * 3.2 - баг с разделителем, с отключенным 'show_term_title'. Стабилизировал логику.
 * 3.1 - баг с esc_html() для заголовка терминов - с тегами получалось криво...
 * 3.0 - Обернул в класс. Добавил опции: 'title_patt', 'last_sep'. Доработал код. Добавил пагинацию для постов.
 * 2.5 - ADD: Опция 'show_term_title'
 * 2.4 - Мелкие правки кода
 * 2.3 - ADD: Страница записей, когда для главной установлена отделенная страница.
 * 2.2 - ADD: Link to post type archive on taxonomies page
 * 2.1 - ADD: $sep, $loc, $args params to hooks
 * 2.0 - ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 * 1.9 - ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 * 1.8 - FIX: заметки, когда в рубрике нет записей
 * 1.7 - Улучшена работа с приоритетными таксономиями.
 */

function wpbeginner_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}
function custom_nav_class($classes, $item){
        $classes[] = "header-navigation__item";
        return $classes;
}
add_filter('nav_menu_css_class' , 'custom_nav_class' , 10 , 2);