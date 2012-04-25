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
    Implements: [Options],
    
    /**
     * Options
     */
    options: {
        containerId: null,
        containerChildsId: null,
        sliderAttr: null,
        childAttr: null
    },
    
    /**
     * Initialize the object
     */
    initialize: function(options)
    {
       this.setOptions(options);
    },
    
    /**
     * Create real slider and set additional attributes
     */
    run: function()
    {
        document.documentElement.className += " js-slider";
        
        if($(this.options.containerId))
        {
            var objSlider = new SlideItMoo(this.options.sliderAttr);
            var optSlider = objSlider.options;
            
            var container = $(optSlider.overallContainer);
            var elemCount = container.getElements(optSlider.itemsSelector).length;
            if(elemCount <= optSlider.itemsVisible)
            {
                var navsSize = 0;
                if(optSlider.showControls)
                {
                    navSize = container.getElement(optSlider.navs.fwd).getSize().x + container.getElement(optSlider.navs.bk).getSize().x
                    container.getElement(optSlider.navs.fwd).addClass('hidden');
                    container.getElement(optSlider.navs.bk).addClass('hidden');
                }
                
                container.set({
                    styles:{
                        width:optSlider.itemsVisible * optSlider.itemWidth + navsSize
                    }
                });
                
                container.getElement('.' + optSlider.elementScrolled).set({
                    styles:{
                        width:optSlider.itemsVisible * optSlider.itemWidth
                    }
                });
                
                container.getElement('.' + optSlider.thumbsContainer).set({
                    styles:{
                        width:elemCount * optSlider.itemWidth + 10
                    }
                });               
            }
            
            $$(this.options.containerChildsId).setStyles(this.options.childAttr);
        }
    }
});