<?php
get_header(); // Indlæser headeren
?>

<div class="content">

    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('<?php echo esc_url(get_field('hero_image')); ?>');">
        <div class="hero-text">
            <h1><?php echo esc_html(get_field('hero_text')); ?></h1>
        </div>
    </div>

<div class="content-section">
    <div class="content-block">
        <img src="<?php echo esc_url(get_field('image_1')); ?>" alt="Billede 1">

        <div class="text-content">
            <h2><?php echo esc_html(get_field('text_1_overskrift')); ?></h2>
            <p><?php echo esc_html(get_field('text_1')); ?></p>
            <a href="http://sikkerhedunderskydning.local/quiz/" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text')); ?></a>
        </div>
    </div>
</div>

<div class="link-section">
    <h2><?php echo esc_html(get_field('new_section_header')); ?></h2>
    <div class="button-container">
        <a href="<?php echo get_permalink(186); ?>#kapitel-1" class="button" id="link_knap_1">Kapitel 1</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-2" class="button" id="link_knap_2">Kapitel 2</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-3" class="button" id="link_knap_3">Kapitel 3</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-4" class="button" id="link_knap_4">Kapitel 4</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-5" class="button" id="link_knap_5">Kapitel 5</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-6" class="button" id="link_knap_6">Kapitel 6</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-7" class="button" id="link_knap_7">Kapitel 7</a>
        <a href="<?php echo get_permalink(186); ?>#kapitel-8" class="button" id="link_knap_8">Kapitel 8</a>
    </div>
</div>






<div class="content-section">
    <div class="content-block">
        <div class="text-content">
            <h2><?php echo esc_html(get_field('text_2_overskrift')); ?></h2>
            <p><?php echo esc_html(get_field('text_2')); ?></p>
        </div>
        <img src="<?php echo esc_url(get_field('image_2')); ?>" alt="Billede 1">
    </div>
</div>


<div class="content-section">
    <div class="content-block">
        <img src="<?php echo esc_url(get_field('image_3')); ?>" alt="Billede 3">

        <div class="text-content">
            <a href="http://sikkerhedunderskydning.local/skydebaner/" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_1')); ?></a>
            <a href="http://sikkerhedunderskydning.local/skydebaner/" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_2')); ?></a>
            <a href="http://sikkerhedunderskydning.local/skydebaner/" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_3')); ?></a>
        </div>
    </div>
</div>


<!-- New Section with Header, Line, and Two Columns -->
<div class="new-section">
        <h2><?php echo esc_html(get_field('text_3_overskrift')); ?></h2>
        <hr>
        <div class="columns">
            <div class="column">
                <h3><?php echo esc_html(get_field('column_1_header')); ?></h3>
                <p><?php echo esc_html(get_field('column_1_text')); ?></p>
            </div>
            <div class="column">
                <h3><?php echo esc_html(get_field('column_2_header')); ?></h3>
                <p><?php echo esc_html(get_field('column_2_text')); ?></p>
            </div>
        </div>
        <hr>
        <div class="columns">
            <div class="column">
                <h3><?php echo esc_html(get_field('column_3_header')); ?></h3>
                <p><?php echo esc_html(get_field('column_3_text')); ?></p>
            </div>
            <div class="column">
                <h3><?php echo esc_html(get_field('column_4_header')); ?></h3>
                <p><?php echo esc_html(get_field('column_4_text')); ?></p>
            </div>
        </div>
</div>


<div class="link-section-2">
        <h2><?php echo esc_html(get_field('test_section_header')); ?></h2>
        <p><?php echo esc_html(get_field('test_section_text')); ?></p>
        <a href="http://sikkerhedunderskydning.local/quiz/" class="button" id="link_knap_1">Tag testen om skydesikkerhed her</a>
</div>



</div>
<?php
get_footer(); // Indlæser footeren
?>
