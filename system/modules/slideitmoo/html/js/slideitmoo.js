/**
 * Class ExtendedSlideItMoo
 *
 * Provide methods to handle slideItMoo slider
 * @copyright  MEN AT WORK 2012
 * @package    Frontend
 */
var ExtendedSlideItMoo=new Class({Implements:[Options],options:{enabled:false,containerId:null,containerChildsId:null,sliderAttr:null,childAttr:null,containerAttr:{overallContainer:{elem:null,styles:{width:null,height:null}},elementScrolled:{elem:null,styles:{width:null,height:null}},thumbsContainer:{elem:null,styles:{width:null,height:null}}},slider:null,elemCount:null,navsSize:{width:0,height:0},responsive:{}},initialize:function(options){this.setOptions(options);if($(this.options.containerId)){this.options.enabled=true;document.documentElement.className+=" js-slider";this.options.sliderAttr.transition=eval(this.options.sliderAttr.transition);this.options.elemCount=$$(this.options.containerChildsId).length;this.setItemDimension().setNavSize().setControlsClass();this.options.containerAttr.overallContainer.elem=this.options.sliderAttr.overallContainer;this.options.containerAttr.elementScrolled.elem=this.options.sliderAttr.elementScrolled;this.options.containerAttr.thumbsContainer.elem=this.options.sliderAttr.thumbsContainer}},run:function(){var a=this;if(this.options.enabled){this.options.slider=new SlideItMoo(this.options.sliderAttr);if(!this.options.sliderAttr.skipInlineStyles&&!this.options.sliderAttr.isResponsive){this.setPixelStyles()}else{Object.each(this.options.childAttr,function(c,b){a.options.childAttr[b]=null}.bind(a))}if(this.options.sliderAttr.isResponsive){this.setPcentStyles()}this.setAllContainerStyles().addResizeEvent()}},setItemDimension:function(){if(this.options.sliderAttr.isResponsive){var b=$(this.options.sliderAttr.elementScrolled).getWidth();var a=$(this.options.sliderAttr.elementScrolled).getHeight();this.options.responsive.thumbsContainer={pcent:{width:((this.options.elemCount*100)/this.options.sliderAttr.itemsVisible),height:((this.options.elemCount*100)/this.options.sliderAttr.itemsVisible)},pixel:{width:((this.options.elemCount*b)/this.options.sliderAttr.itemsVisible),height:((this.options.elemCount*a)/this.options.sliderAttr.itemsVisible)}};this.options.responsive.child={pcent:{width:(100/this.options.elemCount),height:(100/this.options.elemCount)},pixel:{width:(this.options.responsive.thumbsContainer.pixel.width/this.options.elemCount),height:(this.options.responsive.thumbsContainer.pixel.height/this.options.elemCount)}};this.options.sliderAttr.itemWidth=this.options.responsive.child.pixel.width.round();this.options.sliderAttr.itemHeight=this.options.responsive.child.pixel.height.round()}else{if(!this.options.sliderAttr.itemWidth||this.options.sliderAttr.skipInlineStyles){this.options.sliderAttr.itemWidth=$$(this.options.containerChildsId)[0].getComputedSize().totalWidth;this.options.sliderAttr.itemHeight=$$(this.options.containerChildsId)[0].getComputedSize().totalHeight}}return this},setNavSize:function(){if(this.options.sliderAttr.showControls&&!this.options.sliderAttr.skipNavSize){var a=$(this.options.sliderAttr.overallContainer).getElement(this.options.sliderAttr.navs.fwd).getSize(),b=$(this.options.sliderAttr.overallContainer).getElement(this.options.sliderAttr.navs.bk).getSize();this.options.navsSize={width:a.x+b.x,height:a.y+b.y}}return this},setControlsClass:function(){if(this.options.elemCount<=this.options.itemsVisible&&this.options.sliderAttr.showControls){$(this.options.overallContainer).getElement(this.options.sliderAttr.navs.fwd).addClass("hidden");$(this.options.overallContainer).getElement(this.options.sliderAttr.navs.bk).addClass("hidden")}return this},setPixelStyles:function(){if(this.options.sliderAttr.slideVertical){this.options.containerAttr.overallContainer.styles.height=(this.options.sliderAttr.itemsVisible*this.options.sliderAttr.itemHeight+this.options.navsSize.height).round();this.options.containerAttr.elementScrolled.styles.height=(this.options.sliderAttr.itemsVisible*this.options.sliderAttr.itemHeight).round();this.options.containerAttr.thumbsContainer.styles.height=(this.options.elemCount*this.options.sliderAttr.itemHeight+10).round()}else{this.options.containerAttr.overallContainer.styles.width=(this.options.sliderAttr.itemsVisible*this.options.sliderAttr.itemWidth+this.options.navsSize.width).round();this.options.containerAttr.elementScrolled.styles.width=(this.options.sliderAttr.itemsVisible*this.options.sliderAttr.itemWidth).round();this.options.containerAttr.thumbsContainer.styles.width=(this.options.elemCount*this.options.sliderAttr.itemWidth+10).round()}return this},setPcentStyles:function(){var a=this;if(this.options.sliderAttr.slideVertical){this.options.containerAttr.thumbsContainer.styles.height=(this.options.responsive.thumbsContainer.pcent.height).round()+"%";Object.each(this.options.childAttr,function(c,b){a.options.childAttr.height=(this.options.responsive.child.pcent.height).round()+"%"}.bind(a))}else{this.options.containerAttr.thumbsContainer.styles.width=(this.options.responsive.thumbsContainer.pcent.width).round()+"%";Object.each(this.options.childAttr,function(c,b){a.options.childAttr.width=(this.options.responsive.child.pcent.width).round()+"%"}.bind(a))}},setAllContainerStyles:function(){Object.each(this.options.containerAttr,function(a){if($(a.elem)){Object.each(a.styles,function(c,b){$(a.elem).setStyle(b,c)})}});$$(this.options.containerChildsId).setStyles(this.options.childAttr);return this},setContainerStyles:function(a,b){if($(a)&&!!Object.getLength(b)){Object.each(b,function(d,c){$(a).setStyle(c,d)})}return this},addResizeEvent:function(){var a;window.addEvent("resize",function(){if(this.options.slider.options.autoSlide){this.options.slider.stopAutoSlide()}$clear(a);a=(function(){this.setItemDimension();this.options.slider.elementWidth=this.options.sliderAttr.itemWidth;this.options.slider.elementHeight=this.options.sliderAttr.itemHeight;if(this.options.slider.options.autoSlide){this.options.slider.startAutoSlide()}}.bind(this)).delay(50)}.bind(this))}});