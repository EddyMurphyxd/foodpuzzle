  </main><!-- main -->

  <footer class="main-footer">
    <?php if (is_shop()): ?>
      <div class="container">
    <?php endif; ?>
    
    <div class="footer-wrapper clearfix">
      <div class="copyright">
        <p>© 2016 Foodpuzzle LLC. All rights reserved.</p>
      </div>
      
      <div class="social-links">
        <?php the_social_links();?>
      </div>
    </div>

    <?php if (is_shop()): ?>
      </div> <!-- close container -->
    <?php endif; ?>
  </footer><!-- .main-footer -->
</div><!-- #wrapper -->
<?php wp_footer(); ?>

<!-- <script src="/wp-content/themes/foodpuzzle_theme/lib/jquery.min.js"></script> -->
<script src="/wp-content/themes/foodpuzzle_theme/js/lib/bootstrap.min.js"></script>
<script src="/wp-content/themes/foodpuzzle_theme/js/lib/pandaFilter.js"></script>
<script src="/wp-content/themes/foodpuzzle_theme/js/main.js"></script>
</body>
</html>