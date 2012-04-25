/**
 * Class ExtendedSlideItMoo
 *
 * Provide methods to handle slideItMoo slider
 * @copyright  MEN AT WORK 2012
 * @package    Frontend
 */
var ExtendedSlideItMoo=new Class({Implements:[Options],options:{containerId:null,containerChildsId:null,sliderAttr:null,childAttr:null},initialize:function(a){this.setOptions(a)},run:function(){document.documentElement.className+=" js-slider";if($(this.options.containerId)){var e=new SlideItMoo(this.options.sliderAttr);var d=e.options;var a=$(d.overallContainer);var b=a.getElements(d.itemsSelector).length;if(b<=d.itemsVisible){var c=0;if(d.showControls){navSize=a.getElement(d.navs.fwd).getSize().x+a.getElement(d.navs.bk).getSize().x;a.getElement(d.navs.fwd).addClass("hidden");a.getElement(d.navs.bk).addClass("hidden")}a.set({styles:{width:d.itemsVisible*d.itemWidth+c}});a.getElement("."+d.elementScrolled).set({styles:{width:d.itemsVisible*d.itemWidth}});a.getElement("."+d.thumbsContainer).set({styles:{width:b*d.itemWidth+10}})}$$(this.options.containerChildsId).setStyles(this.options.childAttr)}}});