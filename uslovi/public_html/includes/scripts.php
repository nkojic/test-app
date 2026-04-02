<script>
// Safety: prevent reverse-tabnabbing for any target=_blank links
document.querySelectorAll('a[target="_blank"]').forEach(function (link) {
  var rel = (link.getAttribute('rel') || '');
  if (rel.indexOf('noopener') === -1) {
    link.setAttribute('rel', (rel + ' noopener noreferrer').trim());
  }
});
</script>

<!-- jQuery (required by almost everything below) -->
<script src="/js/vendor/jquery/jquery.js"></script>
<script src="/js/vendor/jquery/jquery-migrate.min.js"></script>

<!-- Essential Grid / Lightbox (keep before TP tools/essential if your pages use ESG) -->
<script src="/js/vendor/essgrid/lightbox.js"></script>
<script src="/js/vendor/essgrid/jquery.themepunch.tools.min.js"></script>
<script src="/js/vendor/essgrid/jquery.themepunch.essential.min.js"></script>

<!-- Revolution Slider core + extensions -->
<script src="/js/vendor/revslider/jquery.themepunch.revolution.min.js"></script>
<script src="/js/vendor/revslider/extensions/revolution.extension.slideanims.min.js"></script>
<script src="/js/vendor/revslider/extensions/revolution.extension.actions.min.js"></script>
<script src="/js/vendor/revslider/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="/js/vendor/revslider/extensions/revolution.extension.navigation.min.js"></script>

<!-- Modernizr (this template uses it; ideally in <head>, but safe here too) -->
<script src="/js/vendor/modernizr.min.js"></script>

<!-- Navigation / menus -->
<script src="/js/vendor/superfish.js"></script>
<script src="/js/vendor/jquery.slidemenu.js"></script>

<!-- Template core (order matters) -->
<script src="/js/custom/core.utils.js"></script>
<script src="/js/custom/core.messages.js"></script>
<script src="/js/custom/core.init.js"></script>

<!-- Theme -->
<script src="/js/custom/theme.init.js"></script>
<script src="/js/custom/theme.shortcodes.js"></script>
<script src="/js/custom/custom.js"></script>

<!-- Misc -->
<script src="/js/vendor/social-share.js"></script>
<script src="/js/vendor/grid.layout/grid.layout.min.js"></script>
<script src="/js/vendor/swiper/swiper.js"></script>
<script src="/js/vendor/isotope/isotope.min.js"></script>
