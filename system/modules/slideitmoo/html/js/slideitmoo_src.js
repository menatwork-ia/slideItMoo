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
            // Fix bug missed itemDimensions [START]
            if (! this.options.sliderAttr.itemWidth)
            {
            	var elementItem = $(this.options.sliderAttr.elementScrolled).getElements(this.options.sliderAttr.itemsSelector)[0];
            	var arrMargin = elementItem.getStyle('margin').split(' ');
            	var strItemWidth = elementItem.getStyle('width');
            	var strItemHeight = elementItem.getStyle('height');
           
            	if (strItemWidth.contains('px') && arrMargin[1].contains('px') && arrMargin[3].contains('px')) {
            		var intWidth = strItemWidth.substring(0,strItemWidth.length-2);
            		var intMarginLeft = arrMargin[3].substring(0,arrMargin[3].length-2);
            		var intMarginRight = arrMargin[1].substring(0,arrMargin[1].length-2);
            		this.options.sliderAttr.itemWidth = intWidth.toInt()+intMarginLeft.toInt()+intMarginRight.toInt()
            	}
            	
				if (strItemHeight.contains('px') && arrMargin[0].contains('px') && arrMargin[2].contains('px')) {
            		var intHeight = strItemWidth.substring(0,strItemWidth.length-2);
            		var intMarginTop = arrMargin[0].substring(0,arrMargin[0].length-2);
            		var intMarginBottom = arrMargin[2].substring(0,arrMargin[2].length-2);
            		this.options.sliderAttr.itemHeight = intHeight.toInt()+intMarginTop.toInt()+intMarginBottom.toInt()
            	}
            }
            // Fix bug missed itemDimensions [END]#
           	
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
	        	container.set({
	             	styles:{
	                 	width:optSlider.itemsVisible * optSlider.itemWidth + navsSize
	                 }
	             });
                
	             if(container.getElement('.' + optSlider.elementScrolled)) container.getElement('.' + optSlider.elementScrolled).set({
	             		styles:{
	                 		width:optSlider.itemsVisible * optSlider.itemWidth
	                 	}
	            	});
                
	             if(container.getElement('.' + optSlider.thumbsContainer)) container.getElement('.' + optSlider.thumbsContainer).set({
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
                
	             if(container.getElement('.' + optSlider.elementScrolled)) container.getElement('.' + optSlider.elementScrolled).set({
	             		styles:{
	                 		width:null
	                 	}
	            	 });
                
	             if(container.getElement('.' + optSlider.thumbsContainer)) container.getElement('.' + optSlider.thumbsContainer).set({
	             		styles:{
	             			width:null
	             		}
	             });
	            Object.each(objChildAttr, function(value, key){
				    objChildAttr[key] = null;
				});
            }
            $$(this.options.containerChildsId).setStyles(objChildAttr);

        }
    }
});