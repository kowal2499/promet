
<section id="page-title">
    <div class="container">
        <div class="title">
            <h1><?php echo get_the_title(); ?></h1>
            
            <div class="breadcrumb">
                <ul>
                    <li><a href="<?php print home_url(); ?>">Home</a></li>
                    <li><a href="<?php print get_page_link(); ?>"><?php echo get_the_title(); ?></a></li>
                </ul>
            </div>

        </div>
        
    </div>
    
</section>