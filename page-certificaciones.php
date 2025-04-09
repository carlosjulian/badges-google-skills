<?php
/*
Template Name: Certificaciones
*/
get_header();

// Cargar los datos desde el JSON
$badges_json = file_get_contents(get_stylesheet_directory() . '/assets/data/badges.json');
$badges = json_decode($badges_json, true);

?>

<main class="certifications-container" style="padding: 2rem; background: #171717; color: white;">
  <h1> Certificaciones y Badges 🥇 </h1>
  
  <div class="badges-grid">
    <?php foreach($badges as $badge): ?>
      <article class="badge-card">
        <a href="<?php echo esc_url($badge['enlace_badge']); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo esc_url($badge['imagen_badge']); ?>" 
               alt="<?php echo esc_attr($badge['nombre']); ?>" 
               loading="lazy"
               class="badge-image">
          
          <div class="badge-content">
            <h3 class="badge-title"><?php echo esc_html($badge['nombre']); ?></h3>
            <time datetime="<?php echo date('Y-m-d', strtotime($badge['fecha_obtencion'])); ?>" 
                  class="badge-date">
              <?php echo esc_html($badge['fecha_obtencion']); ?>
            </time>
          </div>
        </a>
      </article>
    <?php endforeach; ?>
  </div>
</main>

<?php get_footer(); ?>
