
<?php
  $archiveName = '';
  if (is_archive()) {
    switch (get_queried_object()->name) {
      case 'research':
        $archiveName = "Badania";
        break;
      case 'products':
        $archiveName = "Produkty";
        break;
    }
  }
?>

<section id="page-title">
    <div class="container">
        <div class="title">
            <h1><?php 
            if (is_archive()) {
              echo $archiveName;
            } else {
                echo get_the_title();
            } ?></h1>
            
            <div class="breadcrumb">
                <ul>
                    <li><a href="<?php print home_url(); ?>">Home</a></li>
                    <li><a href="
                    <?php
                        if (is_archive()) {
                            echo home_url($wp->request);
                        } else {
                            echo get_page_link(); 
                        }
                    ?>">
                    <?php 
                    if (is_archive()) {
                      echo $archiveName;
                    } else {
                      echo get_the_title();
                    } 
                    ?></a></li>
                </ul>
            </div>

        </div>
        
    </div>
    
</section>

<?php
/*
function roots_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      echo get_the_title(get_option('page_for_posts', true));
    } else {
      _e('Latest Posts', 'roots');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      echo $term->name;
    } elseif (is_post_type_archive()) {
      echo get_queried_object()->labels->name;
    } elseif (is_day()) {
      printf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      printf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      printf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      printf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      single_cat_title();
    }
  } elseif (is_search()) {
    printf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    _e('Not Found', 'roots');
  } else {
    the_title();
  }
}
*/