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
            <a href="https://example.com" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text')); ?></a>
        </div>
    </div>
</div>

<div class="link-section">
        <h2><?php echo esc_html(get_field('new_section_header')); ?></h2>
        <a href="https://link1.com" class="button" id="link_knap_1">Skydevåben</a>
        <a href="https://link2.com" class="button" id="link_knap_2">Skydevåben</a>
        <a href="https://link3.com" class="button" id="link_knap_3">Skydevåben</a>
        <a href="https://link4.com" class="button" id="link_knap_4">Skydevåben</a>
        <a href="https://link5.com" class="button" id="link_knap_5">Skydevåben</a>
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
            <a href="https://example.com" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_1')); ?></a>
            <a href="https://example.com" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_2')); ?></a>
            <a href="https://example.com" class="button" id="quiz_knap_1"><?php echo esc_html(get_field('button_text_3')); ?></a>
        </div>
    </div>
</div>

</div>

<?php
get_footer(); // Indlæser footeren
?>
