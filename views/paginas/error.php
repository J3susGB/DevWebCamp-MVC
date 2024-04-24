<main class="pagina_404">
    <h2 class="pagina_404__heading"><?php echo $titulo; ?></h2>

    <div class="pagina_404__imagen">
            <picture>
                <source srcset="build/img/404.avif" type="image/avif">
                <source srcset="build/img/404.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/404.jpg" alt="Imagen error página no encontrada">
            </picture>
    </div>

    <div class="pagina_404__contenedor">
        <p class="pagina_404__texto">Tal vez quieras volver al inicio</p>
        <a href="/" class="pagina_404__enlace">Ir al inicio</a>
    </div>
</main>