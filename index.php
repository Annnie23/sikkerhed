<?php
get_header(); // Indlæser headeren
?>

<div class="hero-section" style="background-image: url('<?php echo esc_url(get_field('hero_image')); ?>');">
    <div class="hero-text">
        <h1><?php echo esc_html(get_field('hero_text')); ?></h1>
    </div>
</div>

<section class="content-section">
    <div class="content-block">
        <img src="<?php echo esc_url(get_field('image_1')); ?>" alt="Billede 1">
        <h2><?php echo esc_html(get_field('text_1_overskrift')); ?></h2>
        <p><?php echo esc_html(get_field('text_1')); ?></p>
        <a href="<?php echo esc_url(get_field('quiz_link_1')); ?>" class="btn"></a>
    </div>
</section>

<section class="weapons-section">
    <h2><?php echo esc_html(get_field('2_overskrift')); ?></h2>
    <div class="weapon-links">
        <a href="<?php echo esc_url(get_field('vaben_link_1')); ?>"></a>
        <a href="<?php echo esc_url(get_field('vaben_link_2')); ?>"></a>
        <a href="<?php echo esc_url(get_field('vaben_link_3')); ?>"></a>
        <a href="<?php echo esc_url(get_field('vaben_link_4')); ?>"></a>
        <a href="<?php echo esc_url(get_field('vaben_link_5')); ?>"></a>
    </div>
</section>

<section class="additional-content">
    <h2><?php echo esc_html(get_field('text_2_overskrift')); ?></h2>
    <img src="<?php echo esc_url(get_field('image_2')); ?>" alt="Billede 2">
</section>

<?php
get_footer(); // Indlæser footeren
?>
