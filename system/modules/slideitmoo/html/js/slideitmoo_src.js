/**
 * Class ExtendedSlideItMoo
 *
 * Provide methods to handle slideItMoo slider
 * @copyright  MEN AT WORK 2012
 * @package    Frontend
 */
var ExtendedSlideItMoo = new Class({
    
  /**
   * Implementations
   */ 
  Implements: [Events,Options],
    
  /**
   * Options
   */
  options: {
    enabled: false,
    containerId: null,
    containerChildsId: null,
    sliderAttr: null,
    childAttr: null,
    containerAttr: {
      overallContainer: {
        elem: null,
        styles: {
          width: null,
          height: null
        }
      },
      elementScrolled: {
        elem: null,
        styles: {
          width: null,
          height: null
        }
      },
      thumbsContainer: {
        elem: null,
        styles: {
          width: null,
          height: null
        }
      }
    },
    slider: null,
    elemCount: null,
    navsSize: {
      width:0,
      height:0
    },
    responsive: {}  
  },
    
  /**
   * Initialize the object
   */
  initialize: function(options)
  {    
    this.setOptions(options);
    if($(this.options.containerId))
    {
      this.options.enabled = true;
      
      document.documentElement.className += " js-slider";
      
      // Fix bug from json_encode Fx.Transitions is not a function
      this.options.sliderAttr.transition = eval(this.options.sliderAttr.transition);

      this.options.elemCount = $$(this.options.containerChildsId).length;
      
      this.setItemDimension().setNavSize().setControlsClass();
      
      this.options.containerAttr.overallContainer.elem = this.options.sliderAttr.overallContainer;
      this.options.containerAttr.elementScrolled.elem = this.options.sliderAttr.elementScrolled;
      this.options.containerAttr.thumbsContainer.elem = this.options.sliderAttr.thumbsContainer;
    }
  },
    
  /**
   * Create real slider and set additional attributes
   */
  run: function()
  {
    var self = this;
    if(this.options.enabled)
    {
      // Create real slider
      this.options.slider = new SlideItMoo(this.options.sliderAttr);

      // Set or remove styles
      if(!this.options.sliderAttr.skipInlineStyles && !this.options.sliderAttr.isResponsive)
      {
        this.setPixelStyles();
      }
      else {
        Object.each(this.options.childAttr, function(value, key){
          self.options.childAttr[key] = null;
        }.bind(self));
      }
      
      // Set responsive styles
      if(this.options.sliderAttr.isResponsive) this.setPcentStyles();

      this.setAllContainerStyles().addResizeEvent();
    }
  },
  
  addEvent: function(type, fn, internal)
  {
    this.options.slider.addEvent(type, fn, internal);
  },
  
  // HELPER --------------------------------------------------------------------
  
  /**
   * Define the dimension of one slider item
   */
  setItemDimension: function()
  {
    if(this.options.sliderAttr.isResponsive)
    {
      var elementScrolledPxWidth = $(this.options.sliderAttr.elementScrolled).getWidth();
      var elementScrolledPxHeight = $(this.options.sliderAttr.elementScrolled).getHeight();
      
      this.options.responsive.thumbsContainer = {
        pcent: {
          width: ((this.options.elemCount * 100) / this.options.sliderAttr.itemsVisible), 
          height: ((this.options.elemCount * 100) / this.options.sliderAttr.itemsVisible)
        },
        pixel: {
          width: ((this.options.elemCount * elementScrolledPxWidth) / this.options.sliderAttr.itemsVisible),
          height: ((this.options.elemCount * elementScrolledPxHeight) / this.options.sliderAttr.itemsVisible)
        }
      };
      
      this.options.responsive.child = {
        pcent: {
          width: (100 / this.options.elemCount),
          height: (100 / this.options.elemCount)
        },
        pixel: {
          width: (this.options.responsive.thumbsContainer.pixel.width / this.options.elemCount),
          height: (this.options.responsive.thumbsContainer.pixel.height / this.options.elemCount)
        }
      }
      
      this.options.sliderAttr.itemWidth = this.options.responsive.child.pixel.width.round(2);
      this.options.sliderAttr.itemHeight = this.options.responsive.child.pixel.height.round(2);
    }
    // Fix bug missed itemDimensions
    else if(!this.options.sliderAttr.itemWidth || this.options.sliderAttr.skipInlineStyles) {
      this.options.sliderAttr.itemWidth = $$(this.options.containerChildsId)[0].getComputedSize().totalWidth;
      this.options.sliderAttr.itemHeight = $$(this.options.containerChildsId)[0].getComputedSize().totalHeight;
    }
    
    return this;
  },
  
  /**
   * Define the navigation size
   */
  setNavSize: function()
  {
    if(this.options.sliderAttr.showControls && !this.options.sliderAttr.skipNavSize)
    {
      var fwdSize = $(this.options.sliderAttr.overallContainer).getElement(this.options.sliderAttr.navs.fwd).getSize(),
      bkSize = $(this.options.sliderAttr.overallContainer).getElement(this.options.sliderAttr.navs.bk).getSize();
          
      this.options.navsSize = {
        width: fwdSize.x + bkSize.x,
        height: fwdSize.y + bkSize.y
      }
    }
    
    return this;
  },
  
  /**
   * Set the controls class
   */
  setControlsClass: function()
  {
    if(this.options.elemCount <= this.options.itemsVisible && this.options.sliderAttr.showControls)
    {
      $(this.options.overallContainer).getElement(this.options.sliderAttr.navs.fwd).addClass('hidden');
      $(this.options.overallContainer).getElement(this.options.sliderAttr.navs.bk).addClass('hidden');
    }
    
    return this;
  },
  
  /**
   * Define the styles for all container objects in pixel
   */
  setPixelStyles: function()
  {
    if(this.options.sliderAttr.slideVertical)
    {
      this.options.containerAttr.overallContainer.styles.height = (this.options.sliderAttr.itemsVisible * this.options.sliderAttr.itemHeight + this.options.navsSize.height).round(2);
      this.options.containerAttr.elementScrolled.styles.height = (this.options.sliderAttr.itemsVisible * this.options.sliderAttr.itemHeight).round(2);
      this.options.containerAttr.thumbsContainer.styles.height = (this.options.elemCount * this.options.sliderAttr.itemHeight + 10).round(2);
    }
    else
    {
      this.options.containerAttr.overallContainer.styles.width = (this.options.sliderAttr.itemsVisible * this.options.sliderAttr.itemWidth + this.options.navsSize.width).round(2);
      this.options.containerAttr.elementScrolled.styles.width = (this.options.sliderAttr.itemsVisible * this.options.sliderAttr.itemWidth).round(2);
      this.options.containerAttr.thumbsContainer.styles.width = (this.options.elemCount * this.options.sliderAttr.itemWidth + 10).round(2);
    }

    return this;
  },
  
  /**
   * Define the styles for special objects in percent
   */
  setPcentStyles: function()
  {
    var self = this;
    if(this.options.sliderAttr.slideVertical) {
      this.options.containerAttr.thumbsContainer.styles.height = (this.options.responsive.thumbsContainer.pcent.height).round(2) + '%';
      Object.each(this.options.childAttr, function(value, key){
        self.options.childAttr['height'] = (this.options.responsive.child.pcent.height).round(2) + '%';
      }.bind(self));
    }
    else
    {
      this.options.containerAttr.thumbsContainer.styles.width = (this.options.responsive.thumbsContainer.pcent.width).round(2) + '%';
      Object.each(this.options.childAttr, function(value, key){
        self.options.childAttr['width'] = (this.options.responsive.child.pcent.width).round(2) + '%';
      }.bind(self));
    }
  },
  
  /**
   * Set all styles
   */
  setAllContainerStyles: function()
  {    
    Object.each(this.options.containerAttr, function(e) {
      if($(e.elem))
      {
        $(e.elem).setStyles(e.styles);       
        if($(e.elem).get('style') == '') {
          $(e.elem).removeAttribute('style');
        }
      }
    });
    
    // Set styles to childs container
    $$(this.options.containerChildsId).setStyles(this.options.childAttr);
    
    return this;
  },
  
  /*
   * Set the given styles for the given element
   */
  setContainerStyles: function(container, objStyles)
  {
    if($(container) && !!Object.getLength(objStyles)) {      
      Object.each(objStyles, function(value, key) {
        $(container).setStyle(key, value);
      });
    }
    
    return this;
  },
  
  /*
   * Add on resize event
   */
  addResizeEvent: function()
  {
    var timer;
    window.addEvent('resize', function(){
      
      // Stop autoslide if enabled
      if(this.options.slider.options.autoSlide)
        this.options.slider.stopAutoSlide();

      $clear(timer);

      // Set timer function
      timer = (function(){
      
        // Update slider element dimension
        this.setItemDimension();      
        this.options.slider.elementWidth = this.options.sliderAttr.itemWidth;
        this.options.slider.elementHeight = this.options.sliderAttr.itemHeight;
      
        // Start autoslide if enabled
        if(this.options.slider.options.autoSlide)
          this.options.slider.startAutoSlide();
      
      }.bind(this)).delay(50);
    }.bind(this));
  }
});