/**
 * Changes from version 1.0
 * - added continuous navigation
 * - changed the navigation from Fx.Scroll to Fx.Morph
 * - added new parameters: itemsSelector: pass the CSS class for divs
 * - itemWidth: for elements with margin/padding pass their width including margin/padding
 *
 * Updates ( August 4th 2009 )
 * - added new parameter 'elemsSlide'. When this is set to a value lower that the actual number of elements in HTML, it will slide at once that number of elements when navigation clicked. Default: null
 * - added onChange event that returns the index of the current element
 *
 * Updates ( January 12th 2010 )
 * - vertical sliding available. First, set your HTML to display vertically and set itemHeight:height of individual items ( including padding, border and so on ) and slideVertical:true
 * - navigators ( forward/back ) no longer added by script. Instead, add them into overallContainer making their display from CSS and after add the CSS selector class to navs parameter
 *     IE: navs:{
 *         fwd:'.SlideItMoo_forward',
 *         bk:'.SlideItMoo_back'
 *     }
 * - new method available resetAll(). When called, this will reset the previous settings and restart the script. Useful if you change slider content on-the-fly
 * - new method available to stop autoSlide ( stopAutoSlide() ). To start autoslide back, use startAutoSlide()
 *
 * Updates ( March 24th 2011 )
 * - compatibility with MooTools 1.3
 *
 * Updates ( November 7th 2011 )
 * - MooTools 1.3 compat/no-compat errors solved
 *
 *
 * Updates ( March 5th 2012 ) (c.schiffler)
 * - added bullet lists.
 *     configure via:
 *         showBullets: 1 (default: 0, no bullets for backwards compat)
 *         bulletContainer: id of the container where the bullet list shall get injected to (defaults to overallContainer)
 *
 * More details on: http://www.php-help.ro/php-tutorials/slideitmoo-v11-image-slider/
 */
(function($){
    /**
     * Class SlideItMoo
     *
     * Image slider for MooTools
     * @copyright  Constantin Boiangiu 2007-2010
     * @copyright  MEN AT WORK 2012
     * @copyright  c.schiffler 2012
     * @license    MIT-style
     */
    this.SlideItMoo = new Class({

        Implements: [Events,Options],
        options: {
            overallContainer: null,/* outer container, contains fwd/back buttons and container for thumbnails */
            elementScrolled: null, /* has a set width/height with overflow hidden to allow sliding of elements */
            thumbsContainer: null,	/* actual thumbnails container */
            itemsSelector: null, /* css class for inner elements ( ie: .SlideItMoo_element ) */
            itemsVisible:5, /* number of elements visible at once */
            elemsSlide: null, /* number of elements that slide at once */
            itemWidth: null, /* single element width */
            itemHeight: null, /* single element height */
            navs:{ /* starting this version, you'll need to put your back/forward navigators in your HTML */
                fwd:'.SlideItMoo_forward', /* forward button CSS selector */
                bk:'.SlideItMoo_back' /* back button CSS selector */
            },
            slideVertical: false, /* vertical sliding enabled */
            showControls:1, /* show forward/back controls */
            transition: Fx.Transitions.linear, /* transition */
            duration: 800, /* transition duration */
            direction: 1, /* sliding direction ( 1: enter from left/top; -1:enter from right/bottom ) */
            autoSlide: false, /* auto slide - as milliseconds ( ie: 10000 = 10 seconds ) */
            mouseWheelNav: false, /* enable mouse wheel nav */
            startIndex: null,
            showBullets: false, /* show clickable bullet list to slide to a certain slide. */
            bulletContainer: null, /* container element to where the bullet list shall be appended in. */
            bulletNumbers: false
            /*onChange: $empty*/
        },

        initialize: function(options){
            this.setOptions(options);
            /* all elements are identified on CSS selector (itemsSelector) */
            this.elements = $(this.options.thumbsContainer).getElements(this.options.itemsSelector);
            this.totalElements = this.elements.length;
            if( this.totalElements <= this.options.itemsVisible ) return;
            // width of thumbsContainer children
            var defaultSize = this.elements[0].getSize();
            this.elementWidth = this.options.itemWidth || defaultSize.x;
            this.elementHeight = this.options.itemHeight || defaultSize.y;
            this.currentElement = 0;
            this.direction = this.options.direction;
            this.autoSlideTotal = this.options.autoSlide + this.options.duration;
            if( this.options.elemsSlide == 1 ) this.options.elemsSlide = null;
            this.bulletContainer = $(this.options.bulletContainer || this.options.overallContainer);
            this.begin();
        },

        begin: function(){
            /* if navigation is needed and enabled, add it */
            this.addControls();

            // resizes the container div's according to the number of itemsVisible thumbnails
            this.setContainersSize();

            this.myFx = new Fx.Tween(this.options.thumbsContainer, {
                property: (this.options.slideVertical ? 'margin-top':'margin-left'),
                link: 'ignore',
                transition: this.options.transition,
                duration: this.options.duration
            });

            /* if autoSlide is not set, scoll on mouse wheel */
            if( this.options.mouseWheelNav ){
                $(this.options.thumbsContainer).addEvent('mousewheel', function(ev){
                    new Event(ev).stop();
                    this.slide(-ev.wheel);
                }.bind(this));
            }

            /* start index element */
            if( this.options.startIndex && this.options.startIndex > 0 && this.options.startIndex < this.elements.length ){
                for( var t = 1; t <= this.options.startIndex; t++ )
                    this.rearange();
            }

            if( this.options.showBullets){
                this.buildBullets();
                this.updateBullets();
            }

            if( this.options.autoSlide && this.elements.length > this.options.itemsVisible )
                this.startAutoSlide();
        },

        /* resets the whole slider in case content changes */
        resetAll: function(){
            $(this.options.overallContainer).removeProperty('style');
            $(this.options.elementScrolled).removeProperty('style');
            $(this.options.thumbsContainer).removeProperty('style');
            this.stopAutoSlide();
            if( typeOf( this.fwd ) !== null ){
                this.fwd.dispose();
                this.bkwd.dispose();
            }
            if( typeOf( this.bulletlist ) !== null ){
                this.bulletlist.dispose();
                this.bullets.each(function(e){
                    e.dispose();
                });
                delete(this.bullets);
            }
            this.initialize();
        },

        /* sets the containers width to leave visible only the specified number of elements */
        setContainersSize: function(){
            var overallSize = {};
            var scrollSize = {};
            var thumbsSize = {};

            if( this.options.slideVertical ){
                //overallSize.height = this.options.itemsVisible * this.elementHeight + 50 * this.options.showControls;
                scrollSize.height = this.options.itemsVisible * this.elementHeight;
                thumbsSize.height = this.totalElements * (parseInt(this.elementHeight) + 10);
            }else{
                /* if navigation is enabled, add the width to the overall size */
                var navsSize = 0;
                if( this.options.showControls ){
                    var s1 = this.fwd.getSize();
                    var s2 = this.bkwd.getSize();
                    navsSize = s1.x+s2.x;
                }
                overallSize.width = this.options.itemsVisible * this.elementWidth + navsSize;
                scrollSize.width = this.options.itemsVisible * this.elementWidth;
                thumbsSize.width = this.totalElements * (this.elementWidth + 10);
            }
            $(this.options.overallContainer).set({
                styles : overallSize
            });
            $(this.options.elementScrolled).set({
                styles : scrollSize
            });
            $(this.options.thumbsContainer).set({
                styles : thumbsSize
            });
        },

        /* adds forward/back buttons */
        addControls: function(){
            if( !this.options.showControls || this.elements.length <= this.options.itemsVisible ) return;

            this.fwd = $(this.options.overallContainer).getElement(this.options.navs.fwd);
            this.bkwd = $(this.options.overallContainer).getElement(this.options.navs.bk);

            if( this.fwd )
                this.fwd.addEvent('click', this.slide.pass(1, this));
            if( this.bkwd )
                this.bkwd.addEvent('click', this.slide.pass(-1, this));
        },

        /* slides elements */
        slide: function( direction ){
            if(this.started) return;
            this.direction = direction ? direction : this.direction;
            var currentIndex = this.currentIndex();
            /* if multiple elements are to be skipped (elemsSlide > 1 or we want to skip multiple by bullets), calculate the ending element */
            if( ((this.options.elemsSlide && this.options.elemsSlide>1) || this.moveBy) && this.endingElem==null ){
                this.endingElem = this.currentElement;
                var moveBy=this.moveBy?this.moveBy:this.options.elemsSlide;
                for(var i = 0; i < moveBy; i++ ){
                    this.endingElem += direction;
                    if( this.endingElem >= this.totalElements ) this.endingElem = 0;
                    if( this.endingElem < 0 ) this.endingElem = this.totalElements-1;
                }
            }

            var s = {};
            var from = 0;
            var to = 0;
            var fxDist = 0;
            if( this.options.slideVertical ){
                s['margin-top'] = -this.elementHeight;
                fxDist = -this.elementHeight;
            }else{
                s['margin-left'] = -this.elementWidth;
                fxDist = -this.elementWidth;
            }

            if(this.direction == 1)
            {
                to = fxDist;
                from = 0;
            }
            else
            {
                to = 0;
                from = fxDist;
            }

            if( this.direction == -1 ){
                this.rearange();
                $(this.options.thumbsContainer).setStyles(s);
            }
            this.started = true;

            if(!typeOf(this.endingElem))
                this.endingElem = null;
            this.myFx.start(from, to).chain( function(){
                this.rearange(true);
                if(this.options.elemsSlide || this.moveBy){
                    // if one element slided at once
                    if( this.endingElem !== this.currentElement ){
                        if( this.options.autoSlide )
                            this.stopAutoSlide();
                        this.slide(this.direction);
                    }
                    // else if multiple elems are slided at once
                    else {
                        if( this.options.autoSlide ){
                            this.startAutoSlide();
                        }
                        this.endingElem = null;
                        delete(this.moveBy);
                    }
                }
            }.bind(this));

            this.fireEvent('onChange', currentIndex);
            if(this.options.showBullets)
            {
                this.updateBullets(currentIndex);
            }
        },

        /* rearanges elements for continuous navigation */
        rearange: function( rerun ){

            if(rerun) this.started = false;
            if( rerun && this.direction == -1 ) return;

            this.currentElement = this.currentIndex( this.direction );

            var s = {};
            if( this.options.slideVertical ) s['margin-top'] = 0;
            else s['margin-left'] = 0;

            $(this.options.thumbsContainer).setStyles(s);

            if( this.currentElement == 1 && this.direction == 1 ){
                this.elements[0].inject(this.elements[this.totalElements-1], 'after');
                return;
            }
            if( (this.currentElement == 0 && this.direction ==1) || (this.direction==-1 && this.currentElement == this.totalElements-1) ){
                this.rearrangeElement( this.elements.getLast(), this.direction == 1 ? this.elements[this.totalElements-2] : this.elements[0]);
                return;
            }

            if( this.direction == 1 ) this.rearrangeElement( this.elements[this.currentElement-1], this.elements[this.currentElement-2]);
            else this.rearrangeElement( this.elements[this.currentElement], this.elements[this.currentElement+1]);
        },

        /* rearanges a single element for continuous navigation */
        rearrangeElement: function( element , indicator ){
            this.direction == 1 ? element.inject(indicator, 'after') : element.inject(indicator, 'before');
        },

        /* determines the current index in element list */
        currentIndex: function(){
            var elemIndex = null;
            switch( this.direction ){
                /* forward */
                case 1:
                    elemIndex = this.currentElement >= this.totalElements-1 ? 0 : this.currentElement + this.direction;
                    break;
                /* backwards */
                case -1:
                    elemIndex = this.currentElement == 0 ? this.totalElements - 1 : this.currentElement + this.direction;
                    break;
            }
            return elemIndex;
        },

        /* starts auto sliding */
        startAutoSlide: function(){
            this.startIt = this.slide.bind(this).pass(this.options.direction|1);
            this.autoSlide = this.startIt.periodical(this.autoSlideTotal, this);
            this.isRunning = true;
            this.elements.addEvents({
                'mouseenter':function(){
                    clearInterval(this.autoSlide);
                    this.isRunning = false;
                }.bind(this),
                'mouseleave':function(){
                    this.autoSlide = this.startIt.periodical(this.autoSlideTotal, this);
                    this.isRunning = true;
                }.bind(this)
            });
        },

        /**
         * Stops auto sliding
         */
        stopAutoSlide: function(){
            clearInterval(this.autoSlide);
            clearInterval(this.startIt);
            this.isRunning = false;
            this.elements.removeEvents();
        },

        /**
         * Create Bullet list
         */
        buildBullets: function()
        {
            var slider = this;
            this.bulletlist = new Element('ul', {
                'class': 'bulletlist'
            }).inject(this.bulletContainer);
            this.bullets = [];
            var me = this;

            if(this.options.elemsSlide == this.options.itemsVisible && this.isInt(this.totalElements / this.options.elemsSlide))
            {
                this.options.bulletCount = this.totalElements / this.options.elemsSlide;
                this.options.multiply = this.options.elemsSlide;
            }
            else
            {
                this.options.bulletCount = this.totalElements;
                this.options.multiply = 1;
            }

            for(var i = 0; i < this.options.bulletCount; i++)
            {
                var li = new Element('li', {
                    'class': 'bullet item'+((i + 1) * this.options.multiply)
                })
                .inject(this.bulletlist, 'bottom')
                .store('idx', i * this.options.multiply)
                .store('list', me);
                li.addEvent('click', this.clicked.pass(li, this));

                if(this.options.bulletNumbers) {
                  if(this.currentElement == i) {
                    li.adopt(new Element('span', {'html': i + 1}))
                  } else {
                    li.adopt(new Element('a', {'html': i + 1}))
                  }
                }

                this.bullets.push(li);
            }
            this.bullets[this.currentElement].addClass('active');
        },

        /**
         * On click event
         *
         * @param element el
         */
        clicked: function(el)
        {
            // already scrolling, get out.
            if(this.started || this.targetSlide)
                return;

            clearInterval(this.autoSlide);

            var idx = el.retrieve('idx'),
            diff = idx - this.currentElement,
            dir =(diff > 0 ? 1 : -1);

            // nothing to do if already on right slide.
            if(diff == 0)
                return;
            this.moveBy = diff * dir;
            this.slide(dir);
        },

        /**
         * Update the bullets
         *
         * @param integer current
         */
        updateBullets: function(current)
        {
            var idx = ((typeof current != 'undefined') ? current : this.currentElement);

            if(this.options.multiply != 1 && idx != 0)
            {
                idx = idx / this.options.multiply;
            }

            this.bullets.each(function(e, i){
                if(i == idx){
                    if(this.options.bulletNumbers) {
                      new Element('span', {
                        html: e.getChildren()[0].get('html')
                      }).replaces(e.getChildren()[0]);
                    }

                    e.addClass('active');
                }else{
                    if(this.options.bulletNumbers) {
                      new Element('a', {
                        html: e.getChildren()[0].get('html')
                      }).replaces(e.getChildren()[0]);
                    }

                    e.removeClass('active');
                }
            }.bind(this));
        },



        /**
         *  Check if value is int or not and return it as boolean
         *
         *  @param mixed value
         */
        isInt: function(value){
            if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
                return true;
            } else {
                return false;
            }
        }

    });

})(document.id);