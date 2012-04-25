slideItMoo
==========

About
-----

Mootools continuous image and content carousel script


Screenshots
-----------

![Content configuration](http://img7.imagebanana.com/img/pc4j11uj/tl_content.jpg)


Other screenshots
https://github.com/menatwork/slideItMoo/wiki/Screenshots


System requirements
-------------------

* Contao 2.10.x or higher
* MultiColumnWizard 2.0.0 or higher
* slideItMooFramework 1.3.0 or higher


Installation & Configuration
----------------------------

* Unpack the archive on your server
* Open the installation directory in your web browser
* Update the database


Configuration for customer slider
----------------------------------

```php
<?php class customerSlider extends ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_customerSlider';

    /**
     * Generate module
     */
    protected function compile()
    {
        /**
         * Necessary values 
         */
        $arrNecessaryConf = array(
            /**
             * ID of the slider container
             */
            'containerId' => 'slider',

            /**
             * Set width and height for slider elements 
             */
            'itemsDimension' => array(500, 300),
        );

        /**
         * Possible values 
         */
        $arrPossibleConf = array(
            /**
             * Templates
             */

            // Set to take default template. If "cssTemplate" is not set take 
            // "/plugins/slideitmoo/css/slideitmoo_horizontal.css" as default
            'templateDefault' => TRUE,

            // Set template to take from "/plugins/slideitmoo/css/". If "templateDefault"
            // is false this option would not work. 
            'cssTemplate' => 'slideitmoo_horizontal',

            /**
             * Set the margin and the unit of the slidet elements
             */
            'itemsMargin' => array('top' => 10, 'right' => 10, 'bottom' => 10, 'left' => 10, 'unit' => 'px'),

            /**
             * Show boolean controls. Default is false 
             */
            'showControls' => TRUE,

            /**
             * Set duration in milliseconds. Default is 800 
             */
            'duration' => 500,

            /**
             * Set the class for the elements to slide. Default is block. 
             */
            'itemsSelector' => 'elementsToSlide',

            /**
             * Set visible items, default is one 
             */
            'itemsVisible' => 1,

            /**
             * Set elements to slide, default is one 
             */
            'elementsSlide' => 1,

            /**
             * Set the start index 
             */
            'startIndex' => 2,

            /**
             * Auto slide
             */

            // Set boolean autoSlideDefault functionality. This dosn't work if no 
            // autoSlide is set
            'autoSlideDefault' => TRUE,

            // Set autoSlide in milliseconds
            'autoSlide' => 1000,

            // Set sliding direction. Possible is -1 or 1
            'elementDirection' => -1,

            /**
             * Set boolean show bullits. If your "itemsVisible" and "elementsSlide"
             * are not one but the same number and the result of the division from this
             * and all elements to slide is an integer. The bullits whould be splittet.
             */
            'showBullets' => TRUE,

            /**
             * Set the possibility to slide with mousewheel 
             */
            'mouseWheelNav' => TRUE,

            /**
             * Set to slide vertical 
             */
            'slideVertical' => TRUE,

            /**
             * Set sliding effects 
             */

            // Set boolean to enable effects. If 'effectTransition' and 'effectEase'
            // is not set this has no effect
            'autoEffectTransition' => '',

            // Set effect transition. Possible options are 'Quad', 'Cubic', 'Quart', 
            // 'Quint', 'Sine', 'Expo', 'Circ', 'Bounce', 'Back', 'Elastic'
            'effectTransition' => 'Quad',

            // Set effect ease. Possible options are 'In', 'Out', 'InOut'
            'effectEase' => '',
        );

        $arrConf = array_merge($arrNecessaryConf, $arrPossibleConf);

        $objSlider = new slideItMoo($arrConf);
        $this->Template->script = $objSlider->parse();
        $this->Template->showControls = $arrPossibleConf['showControls'];
        $this->Template->containerId = $arrNecessaryConf['containerId'];
        $this->Template->itemsSelector = $arrPossibleConf['itemsSelector'];
    }

}?>
```

```php
<section>
    <?php echo $this->script; ?>
    
    <div id="<?php echo $this->containerId; ?>" class="slider">
        <?php if ($this->showControls) : ?>
        <!-- indexer::stop --> 
        <nav class="fwd <?php echo $this->containerId; ?>_fwd"> &gt; </nav>
        <nav class="bk <?php echo $this->containerId; ?>_bk"> &lt; </nav>
        <!-- indexer::continue -->
        <?php endif; ?>
        <div class="slider_inner" id="<?php echo $this->containerId; ?>_inner">
            <div class="slider_items" id="<?php echo $this->containerId; ?>_items">
                <div class="<?php echo $this->itemsSelector; ?> block">
                    <h3>First Elem</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="<?php echo $this->itemsSelector; ?> block">
                    <h3>Second Elem</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="<?php echo $this->itemsSelector; ?> block">
                    <h3>Third Elem</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="<?php echo $this->itemsSelector; ?> block">
                    <h3>Fourth Elem</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>                
            </div>
        </div>
    </div>
</section>
```


Troubleshooting
---------------

If you are having problems using the slideItMoo Extension, please visit the issue tracker at https://github.com/menatwork/slideItMoo/issues