<div class="<?php echo $this->class; ?> "<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	document.documentElement.className += " js-slider";
	window.addEvent('domready', function() {
		if ($('<?php echo $this->si_containerId; ?>')) {
			slide_<?php echo $this->si_containerId; ?> = new SlideItMoo({
				itemWidth: <?php echo $this->si_itemsOverallWidth; ?>,
				itemHeight: <?php echo $this->si_itemsHeight; ?>,
				showControls:<?php echo ($this->si_showControls) ? 1: 0 ; ?>,
				<?php if ($this->si_autoSlideDefault) echo "autoSlide: ".$this->si_autoSlide.",\n"; 
				if ($this->si_showControls) : ?>
				navs:{ 
					fwd:'.<?php echo $this->si_containerId; ?>_fwd', 
					bk:'.<?php echo $this->si_containerId; ?>_bk' 
				},
				<?php endif; 
				if ($this->si_mouseWheelNav) echo "mouseWheelNav: true,\n"; ?>
				overallContainer: '<?php echo $this->si_containerId; ?>',
				elementScrolled: '<?php echo $this->si_containerId; ?>_inner',
				thumbsContainer: '<?php echo $this->si_containerId; ?>_items',		
				itemsVisible: <?php echo $this->si_itemsVisible; ?>,
				elemsSlide: <?php echo $this->si_elementsSlide; ?>,
				duration: <?php echo $this->si_duration; ?>,
				itemsSelector:<?php if ($this->si_itemsSelector): echo "'.".$this->si_itemsSelector."'\n"; else: echo "'.block'\n"; endif; ?>
			});

			var elements = $('<?php echo $this->si_containerId; ?>').getElements(<?php if ($this->si_itemsSelector): echo "'.".$this->si_itemsSelector."'\n"; else: echo "'.block'"; endif; ?>);
			var totalElements = elements.length;
			if( totalElements <= <?php echo $this->si_itemsVisible; ?> ){
			
				var overallSize = {};
				var scrollSize = {};
				var thumbsSize = {};
				var navsSize = 0;
				
				<?php if ($this->si_showControls): ?>
				var fwd = $('<?php echo $this->si_containerId; ?>').getElement('.<?php echo $this->si_containerId; ?>_fwd');
				var bkwd = $('<?php echo $this->si_containerId; ?>').getElement('.<?php echo $this->si_containerId; ?>_bk');
				var s1 = fwd.getSize();
				var s2 = bkwd.getSize();
				var navsSize = s1.x+s2.x;
				fwd.addClass('hidden');
				bkwd.addClass('hidden');
				<?php endif; ?>
				overallSize.width = <?php echo $this->si_itemsVisible; ?> * <?php echo $this->si_itemsOverallWidth; ?> + navsSize;
				scrollSize.width = <?php echo $this->si_itemsVisible; ?> * <?php echo $this->si_itemsOverallWidth; ?>;
				thumbsSize.width = totalElements * (<?php echo $this->si_itemsOverallWidth; ?> + 10);
			
				$('<?php echo $this->si_containerId; ?>').set({
						styles : overallSize
				});
				$('<?php echo $this->si_containerId; ?>_inner').set({
						styles : scrollSize
				});
				$('<?php echo $this->si_containerId; ?>_items').set({
						styles : thumbsSize
				});
			
			}
		}
		
		$$('#<?php echo $this->si_containerId; if ($this->si_itemsSelector): echo ' .'.$this->si_itemsSelector; else: echo ' .block'; endif; ?>').setStyles({
			<?php if ($this->si_itemsMarginLeft != '') echo "marginLeft: '". $this->si_itemsMarginLeft ."px',\n"; ?>
			<?php if ($this->si_itemsMarginRight != '') echo "marginRight: '". $this->si_itemsMarginRight ."px',\n"; ?>
			width: '<?php echo $this->si_itemsWidth; ?>px'
		});
	});
	//--><!]]>
	</script>

	<div id="<?php echo $this->si_containerId; ?>" class="slider">
	<?php if ($this->si_showControls) : ?>
		<!-- indexer::stop --> 
		<div class="fwd <?php echo $this->si_containerId; ?>_fwd"> &gt; </div>
		<div class="bk <?php echo $this->si_containerId; ?>_bk"> &lt; </div>
		<!-- indexer::continue -->
	<?php endif; ?>
		<div class="slider_inner" id="<?php echo $this->si_containerId; ?>_inner">
			<div class="slider_items" id="<?php echo $this->si_containerId; ?>_items">