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
            // Fix bug from json_encode Fx.Transitions is not a function
            this.options.sliderAttr.transition = eval(this.options.sliderAttr.transition);

            var objSlider = new SlideItMoo(this.options.sliderAttr);
            var optSlider = objSlider.options;
            
            var sliderAttr = this.options.sliderAttr;
            var container = $(optSlider.overallContainer);
            var elemCount = container.getElements(optSlider.itemsSelector).length;
            if(elemCount <= optSlider.itemsVisible && optSlider.showControls)
            {
                container.getElement(optSlider.navs.fwd).addClass('hidden');
                container.getElement(optSlider.navs.bk).addClass('hidden');
            }
            var navsSize = 0;
            if(optSlider.showControls && !sliderAttr.skipNavSize)
            {
                navsSize = container.getElement(optSlider.navs.fwd).getSize().x + container.getElement(optSlider.navs.bk).getSize().x
            }
			
            var objChildAttr = this.options.childAttr;
            if(!sliderAttr.skipInlineStyles) 
            {
                if(this.options.sliderAttr.slideVertical != 'true')
                {
                    container.set({
                        styles:{
                            width:optSlider.itemsVisible * optSlider.itemWidth + navsSize
                        }
                    });
                }
                
                if($(optSlider.elementScrolled)) $(optSlider.elementScrolled).set({
                    styles:{
                        width:optSlider.itemsVisible * optSlider.itemWidth
                    }
                });
                
                if($(optSlider.thumbsContainer)) $(optSlider.thumbsContainer).set({
                    styles:{
                        width:elemCount * optSlider.itemWidth + 10
                    }
                });
            }
            else
            {
                container.set({
                    styles:{
                        width:null
                    }
                });
                
                if($(optSlider.elementScrolled)) $(optSlider.elementScrolled).set({
                    styles:{
                        width:null
                    }
                });
                
                if($(optSlider.thumbsContainer)) $(optSlider.thumbsContainer).set({
                    styles:{
                        width:null
                    }
                });
                
                Object.each(objChildAttr, function(value, key){
                    objChildAttr[key] = null;
                });
                $(sliderAttr.elementScrolled).setStyle('width',null);
            }
            $$(this.options.containerChildsId).setStyles(objChildAttr);

        }
    }
});