<?php
/**
* Function for Advance Custom Fields
*/ 
//create new block category
function guten_block_category( $categories, $post ) {
  global $domain;

  return array_merge(
		$categories,
		array(
			array(
				'slug' => 'guten-block',
				'title' => __( 'Guten Block', $domain ),
			),
		)
	);
}
add_filter( 'block_categories', 'guten_block_category', 10, 2);


add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {
  global $domain;
    $supports = array(
      'align'  => array( 'wide', 'full' ),
      'anchor' => true,
    );

    // check function exists.
    if( function_exists('acf_register_block_type') ) {
        $block_path = get_stylesheet_directory() . '/template-parts/blocks';
        $dir = get_stylesheet_directory() . '/template-parts/blocks';
        
        $files= scandir($dir); 
        $file_headers = array(
            'block_name'        => 'Block Name',
        );

        foreach( $files as $block ) : 
            if ($block != '.' && $block != '..'){
            
            $filepath = $dir.'/'.$block.'/'.$block;
            $blockFile = $block_path.'/'.$block.'/'.$block;
            

              $block_file_data = get_file_data($filepath.'.php',$file_headers);

              if ($block_file_data['block_name']){
                $blockname = $block_file_data['block_name']  ;
              }else{
                $blockname = $block;
              }

              $arg = array (
                'name'              =>  $blockname,
                'title'             => __($blockname),
                'render_template'   => $filepath.'.php',
                'category'          => 'guten-block',
                'supports'          => $supports,
                'keywords'			=> array( 'Guten block', $domain ),
              );


              //serch file js
              if (file_exists($filepath.'.js')){
                $arg['enqueue_script'] = $blockFile.'.js';
              }
              //search file css
              if(file_exists($filepath.'.css')){
                $arg['enqueue_style'] = $blockFile.'.css';
              } 
              
                //register block
                acf_register_block_type($arg);
            }
        endforeach;

    }
}



//remove guten blocks
// add_filter( 'allowed_block_types', 'misha_allowed_block_types', 10, 2 );
 
function misha_allowed_block_types( $allowed_blocks, $post ) {
 
	$allowed_blocks = array(
		'core/image',
		'core/paragraph',
		'core/heading',
    'core/list',
    'core/embed',
    'core/media-text',
    'core/spacer',
    'core/table',
    'core/code',
    'core/quote',
    'core/block',
    'core/columns',
    'core/separator',

    'acf/suggestion',
    'acf/snipped',
    'acf/list-content',
    'acf/feature-download'

	);
 
	if( $post->post_type === 'pillar' ) {
		$allowed_blocks[] = 'core/shortcode';
	}
 
	return $allowed_blocks;
 
}

//set guten color
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Blue', $domain ),
		'slug'  => 'blue',
		'color'	=> '#22099E',
	),
	array(
		'name'  => __( 'Red', $domain ),
		'slug'  => 'red',
		'color' => '#FF0448',
  ),
  array(
		'name'  => __( 'Sky', $domain ),
		'slug'  => 'sky',
		'color' => '#6582FF',
  ),
  array(
		'name'  => __( 'Gray', $domain ),
		'slug'  => 'gray',
		'color' => '#E9E9E9',
  ),
  array(
		'name'  => __( 'Blue Light', $domain ),
		'slug'  => 'blue-light',
		'color' => '#A6A6C3',
	),
) );